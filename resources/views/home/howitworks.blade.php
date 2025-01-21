@extends('home.index')

@section('content')

<section id="service-detail" class="appear">

    <div class="main-text">
        <div class="subtitle">
            <img class="star" src="{{ asset('images/blue-star.svg') }}" alt="star">
            <h6 class="blue-mini-title">SERVICES</h6>
        </div>
    
        <h1 class="bold-title">See How It Works!</h1>
        <p class="grey-text">Order our Cuci Lipat, Cuci Saja, or Cuci Setrika services with ease from home! Here's how :</p>
    </div>

    <div class="service-list">
        
        @foreach($hiw as $hiw)
        <div class="service-card">
            <div class="number">{{ $hiw['number'] }}</div>
            <div class="service-name"> {{ $hiw['name'] }}</div>
            <hr class="divider-dotted">
            <p><i class="fa-solid fa-circle-chevron-right" style="color: #1C98ED;"></i> {{ $hiw['desc'] }}</p>
        </div>
        @endforeach
    </div>

</section>

@endsection