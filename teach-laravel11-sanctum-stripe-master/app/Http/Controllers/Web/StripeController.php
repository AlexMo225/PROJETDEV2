<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StripeController extends Controller
{
    public function checkout(Request $request) {
        $request->validate([
            'product' => 'required|integer'
        ]);

        $product = Product::findOrFail($request->product);

        \Stripe\Stripe::setApiKey(getenv("STRIPE_SECRET"));

        $stripeCheckoutSession = \Stripe\Checkout\Session::create([
          'line_items' => [[
            'price' => $product->stripe_price_id,
            'quantity' => 1,
          ]],
          'mode' => 'subscription',
          'allow_promotion_codes' => true,
          'success_url' => route('stripe.success'),
          'cancel_url' => route('stripe.cancel')
        ]);

        return redirect($stripeCheckoutSession->url);
    }

    public function success() {
        return view("stripe.success");
    }

    public function cancel() {
        return view("stripe.cancel");
    }
}
