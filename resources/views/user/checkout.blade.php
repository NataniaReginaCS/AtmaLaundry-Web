@extends('user.dashboard')

@section('content')

<section id="checkout-page">

    <h1 class="title">Check Out</h1>

    <div class="checkout-bar">
        <h2>Order ID #0001</h2>
        <h2 id="priceInfo">Total Payment Rp 50.000</h2>
    </div>

    <div class="method-payment-container">

        <div class="payment-method">
            <i class="fa-solid fa-money-bill"></i>
            <p>Cash</p>
        </div>

        <div class="payment-method">
            <i class="fa-solid fa-wallet"></i>
            <p>E-wallet</p>
        </div>

        <div class="payment-method">
            <i class="fa-solid fa-building-columns"></i>
            <p>Bank Transfer</p>
        </div>

        <div class="payment-method">
            <i class="fa-solid fa-credit-card"></i>
            <p>Credit Card</p>
        </div>

    </div>

    <div class="point-bar">
        <form action="">
            <input type="checkbox" id="usePoint" name="usePoint" value="6">
            <label for="usePoint">Apakah ingin menggunakan point. Poin saat ini : 6 poin</label>
        </form>
    </div>

    <div class="btn-bar">
        <a href="{{ url('orderList') }}">
            <button type="button" class="cnl-btn">Cancel</button>
        </a>

        <a class="confirmLink" href="{{ url('orderList') }}">
            <button type="button" class="cfm-btn disable">Confirm</button>
        </a>
    </div>

</section>

<script src="{{ asset('js/checkout.js') }}"></script>

@endsection