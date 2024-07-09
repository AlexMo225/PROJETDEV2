<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmationEmail;
use App\Mail\SubscriptionCancellationEmail;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function getSubscription(Request $request)
    {
        $user = Auth::user();
    
        // Récupère l'abonnement de l'utilisateur
        $subscription = Subscription::where('user_id', $user->id)->with('product')->first();
    
        if (!$subscription) {
            return response()->json(['error' => 'Subscription not found'], 404);
        }
    
        return response()->json([
            'subscription' => $subscription,
            'product' => $subscription->product,
        ]);
    }
    

    public function subscribe(Request $request)
    {
        $user = $request->user();

        // Logique d'abonnement...
        // Par exemple, créer une nouvelle entrée d'abonnement dans la base de données

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'stripe_subscription_id' => 'sub_' . uniqid(),
            'current_period_start' => Carbon::now(),
            'current_period_end' => Carbon::now()->addMonth(),
            'status' => 'activé'
        ]);

        // Envoyer un email de confirmation d'abonnement
        Mail::to($user->email)->send(new SubscriptionConfirmationEmail($user, $subscription));

        return response()->json(['message' => 'Abonnement confirmé.'], 200);
    }

    public function cancelSubscription(Request $request)
    {
        $user = $request->user();

        // Logique d'annulation d'abonnement...
        // Par exemple, mettre à jour le statut de l'abonnement dans la base de données

        $subscription = Subscription::where('user_id', $user->id)->first();

        if ($subscription) {
            $subscription->status = 'Annulé';
            $subscription->save();

            // Envoyer un email de confirmation d'annulation
            Mail::to($user->email)->send(new SubscriptionCancellationEmail($user, $subscription));

            return response()->json(['message' => 'Abonnement annulé.'], 200);
        }

        return response()->json(['error' => 'Subscription not found'], 404);
    }
    public function success(Request $request)
        {
            $session_id = $request->session_id;
            // Récupérer les détails de la session Stripe pour afficher les détails de l'abonnement
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            $subscription = Subscription::where('stripe_subscription_id', $session->subscription)->first();

            return view('checkout.success', ['subscription' => $subscription]);
        }
}
