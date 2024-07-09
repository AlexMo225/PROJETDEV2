@extends("layouts.default")

@section('content')

    @include("includes.menu")

    <h1>Products</h1>

    <p>Select a product (plan) to subscribe using Stripe Checkout:</p>

    <form action="" method="post">
        @csrf

        @if ($products)
            @foreach ($products as $product)
                <input type="radio" name="product" id="{{ $product->id }}" value="{{ $product->id }}" required>
                <label for="{{ $product->id }}">{{ $product->name }}</label>
            @endforeach
        @else
            <p><em>Please create at least one product in database</em></p>
        @endif

        <button type="submit">Pay with Stripe</button>
    </form>

@endsection
