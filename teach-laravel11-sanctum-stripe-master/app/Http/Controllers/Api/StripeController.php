<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\User;
use App\Models\Subscription;
//import email 
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionCreatedEmail;
use App\Mail\SubscriptionUpdatedEmail;
use App\Mail\SubscriptionCanceledEmail;

class StripeController extends Controller
{
    public function checkout(Request $request) {
        $request->validate([
            'product' => 'required|integer'
        ]);

        $product = Product::findOrFail($request->product);

        $user = $request->user();

        // Vérifier si l'utilisateur a déjà un abonnement actif
        if ($user->stripe_customer_id) {
            return response()->json(['error' => 'Vous avez déjà un abonnement en cours'], 400);
        }

        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

        try {
            $stripeCheckoutSession = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    'price' => $product->stripe_price_id,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'allow_promotion_codes' => true,
                'metadata' => [
                    'user_id' => $request->user()->id,
                    'product_id' => $product->id
                ],
                'success_url' => 'http://localhost:5173/paymentsuccess', 
                'cancel_url' => 'http://localhost:5173/paymentcancel', 
            ]);

            return response()->json(['url' => $stripeCheckoutSession->url]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la session de paiement Stripe', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Erreur lors de la création de la session de paiement Stripe'], 500);
        }
    }

    //webhook function
    public function webhook(Request $request) {
        Log::info('Réception d\'un webhook Stripe');

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $endpoint_secret = env("STRIPE_WEBHOOK_SECRET");

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
            Log::info('Webhook Stripe construit avec succès', ['event' => $event]);
        } catch (\UnexpectedValueException $e) {
            Log::error('Charge utile invalide', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Charge utile invalide'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Signature invalide', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Signature invalide'], 400);
        }

        $eventType = $event->type;
        $eventData = $event->data->object;

        Log::debug('Type d\'événement Stripe', ['eventType' => $eventType]);

        switch ($eventType) {
            //appel de la bonne fonction en fonction de l'event 
            case "checkout.session.completed":
                $this->handleCheckoutSessionCompleted($eventData);
                break;
            case "invoice.payment_succeeded":
                $this->handleInvoicePaymentSucceeded($eventData);
                break;
            case "invoice.payment_failed":
                $this->handleInvoicePaymentFailed($eventData);
                break;
            case "customer.subscription.updated":
                $this->handleSubscriptionUpdated($eventData);
                break;
            default:
                Log::info('Événement non traité', ['eventType' => $eventType]);
                break;
        }

        Log::debug('Événement Stripe traité', ['event' => $event]);

        return response()->json(['status' => 'success']);
    }

    private function handleCheckoutSessionCompleted($eventData) {
        $userId = $eventData->metadata->user_id;
        $productId = $eventData->metadata->product_id;
        $stripeCustomerId = $eventData->customer;
        $stripeSubscriptionId = $eventData->subscription;

        Log::debug('Données de session de paiement complétée', [
            'user_id' => $userId,
            'product_id' => $productId,
            'stripe_customer_id' => $stripeCustomerId,
            'stripe_subscription_id' => $stripeSubscriptionId
        ]);

        $user = User::find($userId);
        $user->update(['stripe_customer_id' => $stripeCustomerId]);

        $subscription = Subscription::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'stripe_subscription_id' => $stripeSubscriptionId,
            'current_period_start' => now(),
            'current_period_end' => now()->addMonth(),
            'status' => 'active'
        ]);
        // email abonnement sucess
        Mail::to($user->email)->send(new SubscriptionCreatedEmail($user, $subscription));
        Log::info('Mise à jour du stripe_customer_id pour l\'utilisateur et création d\'abonnement', [
            'user_id' => $userId,
            'stripe_customer_id' => $stripeCustomerId,
            'subscription_id' => $subscription->id
        ]);
    }

    private function handleInvoicePaymentSucceeded($eventData) {
        $stripeSubscriptionId = $eventData->subscription;
        $subscription = Subscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();

        if ($subscription) {
            $subscription->update([
                'status' => 'active',
                'current_period_start' => now(),
                'current_period_end' => now()->addMonth()
            ]);
            // mail update subscription
            Mail::to($subscription->user->email)->send(new SubscriptionUpdatedEmail($subscription->user, $subscription));
            Log::info('Abonnement mis à jour après paiement réussi', ['subscription_id' => $subscription->id]);
        }

    }

    private function handleInvoicePaymentFailed($eventData) {
        $stripeSubscriptionId = $eventData->subscription;
        $subscription = Subscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();

        if ($subscription) {
            $subscription->update(['status' => 'past_due']);
            Log::warning('Paiement échoué pour l\'abonnement', ['subscription_id' => $subscription->id]);
        }
    }

    private function handleSubscriptionUpdated($eventData) {
        $stripeSubscriptionId = $eventData->id;
        $stripePriceId = $eventData->items->data[0]->price->id; // Récupération du stripe_price_id
        $subscription = Subscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();
    
        if ($subscription) {
            $status = $eventData->status;
            
            // Si l'abonnement est annulé
            if ($eventData->canceled_at) {
                $status = 'canceled';
                // mail abonnement mis en pause
                Mail::to($subscription->user->email)->send(new SubscriptionCanceledEmail($subscription->user, $subscription));
            } else {
                // mail abonnement update
                Mail::to($subscription->user->email)->send(new SubscriptionUpdatedEmail($subscription->user, $subscription));
            }
    
            // Récupérer l'ID du produit dans votre base de données
            $product = Product::where('stripe_price_id', $stripePriceId)->first();
            if ($product) {
                $subscription->update([
                    'status' => $status,
                    'product_id' => $product->id, // Mise à jour du product_id avec l'ID trouvé dans votre base de données
                    'current_period_start' => \Carbon\Carbon::createFromTimestamp($eventData->current_period_start),
                    'current_period_end' => \Carbon\Carbon::createFromTimestamp($eventData->current_period_end)
                ]);
                
                Log::info('Abonnement mis à jour', [
                    'subscription_id' => $subscription->id,
                    'status' => $status,
                    'product_id' => $product->id // Ajout du product_id dans les logs
                ]);
            } else {
                Log::warning('Produit non trouvé pour le product_id fourni', [
                    'stripe_subscription_id' => $stripeSubscriptionId,
                    'stripe_price_id' => $stripePriceId
                ]);
            }
        } else {
            Log::warning('Aucune correspondance d\'abonnement trouvée pour l\'ID de souscription Stripe', [
                'stripe_subscription_id' => $stripeSubscriptionId,
                'event_data' => $eventData
            ]);
        }
    }


    public function customer(Request $request) {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $stripeCustomerId = $request->user()->stripe_customer_id;

        if (!$stripeCustomerId) {
            Log::warning('Utilisateur sans abonnement tente d\'accéder au portail client', ['user_id' => $request->user()->id]);
            return response()->json(['error' => "L'utilisateur n'a pas d'abonnement"], 400);
        }

        try {
            $customerPortal = $stripe->billingPortal->sessions->create([
                'customer' => $stripeCustomerId,
                'return_url' => 'http://localhost:5173/account', 
            ]);

            return response()->json(['url' => $customerPortal->url]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du portail client Stripe', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Erreur lors de la création du portail client Stripe'], 500);
        }
    }
}
