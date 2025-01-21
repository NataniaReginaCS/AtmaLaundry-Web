@extends('user.dashboard')

@section('content')

<section id="summary-page">

    <div class="left">
        <h1>Order Summary</h1>
        <a href="{{ url('orderForm') }}">
            <button><i class="fa-solid fa-circle-chevron-left"></i> Back</button>
        </a>
    </div>

    <div class="right">

        <div class="summary">
            <div class="orderData">
                
                <i class="fa-solid fa-cart-plus"></i>
    
                <div class="text">
                    <p>{{ $_GET['customerName'] }}</p>
                    <p>{{ $_GET['phoneNumber'] }}</p>
                    <p>{{ $_GET['category'] }}</p>
                    <p>Paket {{ $_GET['service'] }}</p>
                    <p>{{ $_GET['weight'] }} kg</p>

                    <br>
                    <p>Alamat Pengantaran:</p>
                    <p>{{ $_GET['address'] }}</p>
                </div>
            </div>
    
            <div class="orderReq">
                <p>Request</p>
                <div class="req">{{ $_GET['request'] }}</div>
            </div>

            <div class="pay">
                <h3 style="color: #1678F3;">Total: 50.000</h3>
                <a href="{{ url('checkout') }}">
                    <button><i class="fa-solid fa-cart-plus"></i> Checkout</button>
                </a>
            </div>
        </div>

    </div>

</section>

@endsection