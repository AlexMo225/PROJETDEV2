# Laravel 11 Sanctum Stripe Checkout demo

Features:

* Mobile token authentication using Laravel Sanctum (API)
* Subscriptions using Stripe checkout (API & web)

## Demo

The demo is running in test mode -- use `4242424242424242` as a test card number with any CVC + future expiration date.

Use the `4000002500003155` test card number to trigger a 3D Secure challenge flow.

Read more about testing on Stripe at https://stripe.com/docs/testing.

## How to run locally

### 1. Clone and configure the sample

Copy the `.env.example` file into a file named `.env` in the folder of the server you want to use. For example:

```sh
$ cp .env.example .env
```

You will need a Stripe account in order to run the demo. Once you set up your account, go to the Stripe [developer dashboard](https://stripe.com/docs/development/quickstart#api-keys) to find your API keys.

```sh
STRIPE_KEY=<replace-with-your-publishable-key>
STRIPE_SECRET=<replace-with-your-secret-key>
```

### 2. Create a user to obtain a authentication token

Create a user using `/api/register` endpoint to obtain a authentication token.

Stripe API endpoints (only on the API, not on the web version) are protected, so you have to be authenticated using a valid token (with Bearer authentication) to access Stripe API endpoints.

### 3. Create Products and Prices on Stripe

This sample requires [Price](https://stripe.com/docs/api/prices/object) IDs to create the Checkout page. Products and Prices are objects on Stripe that let you model a subscription.

You can create Products and Prices [in the dashboard](https://dashboard.stripe.com/products).

Then, add these products in database:

```php
use App\Models\Plan;

Plan::create([
    "name" => "Monthly subscription",
    "stripe_price_id" => "price_XXXXXXXXXXXXXXXXX", // Stripe price id
    "price" => 990, // e.g. 9,90 €
    "repeat" => 1 // 1 : monthly | 2 : yearly
]);
```

Change Stripe return success and cancel urls in `app/Http/Controllers/Api/StripeController.php`.

### 4. Confirm that you have set the account name

In order to use Checkout, you must set an account or business name at https://dashboard.stripe.com/account

### 5. Follow the server instructions on how to run:

Install Laravel dependencies:

```sh
$ composer install
```

Launch Laravel server:

```sh
$ php artisan serve
```

**Customize your branding**

To customize your icon, logo and colors for Checkout and the Customer Portal, go to [Branding settings](https://dashboard.stripe.com/account/branding) in the Dashboard.

**Run a webhook locally:**

You can use the Stripe CLI to easily spin up a local webhook.

First [install the CLI](https://stripe.com/docs/stripe-cli) and [link your Stripe account](https://stripe.com/docs/stripe-cli#link-account).

```sh
$ stripe listen --forward-to "localhost:8000/api/stripe/webhook"
```

The CLI will print a webhook secret key to the console. Set `STRIPE_WEBHOOK_SECRET` to this value in your `.env` file.

You should see events logged in the console where the CLI is running.

When you are ready to create a live webhook endpoint, follow our guide in the docs on [configuring a webhook endpoint in the dashboard](https://stripe.com/docs/webhooks/setup#configure-webhook-settings).

Stripe webhooks events are logged to help you. Logs are located in `storage/logs/laravel.log`.
