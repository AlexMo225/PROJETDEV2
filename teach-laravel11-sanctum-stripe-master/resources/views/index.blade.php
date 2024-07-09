@extends("layouts.default")

@section('content')

    <h1>Laravel 11 Sanctum + Stripe Checkout (subscriptions)</h1>

    <div class="wrapper">

        <div>
            <h2>Web</h2>

            <code>routes/web.php</code>

            <h3>Stripe</h3>

            <ul>
                <li><a href="/products">Products</a></li>
                <li><a href="/stripe/success">Stripe success page</a></li>
                <li><a href="/stripe/cancel">Stripe cancel page</a></li>
            </ul>
        </div>

        <div>
            <h2>API</h2>

            <code>routes/api.php</code>

            <h3>Auth</h3>

            <ul>
                <li>Register: <code>POST /api/register</code></li>
                <li>Login: <code>POST /api/login</code></li>
                <li>Logout: <code>POST /api/logout</code></li>
            </ul>

            <h3>User</h3>

            <ul>
                <li>Dashboard: <code>GET /api/dashboard</code></li>
                <li>User: <code>GET /api/user</code></li>
            </ul>

            <h3>Stripe</h3>

            <ul>
                <li>Checkout: <code>POST /api/stripe/checkout</code></li>
                <li>Webhook: <code>POST /api/stripe/webhook</code></li>
                <li>Customer portal: <code>GET /api/stripe/customer</code></li>
            </ul>

            <h3>Contact</h3>

            <ul>
                <li>Contact: <code>POST /api/contact</code></li>
            </ul>
        </div>

    </div>

@endsection
