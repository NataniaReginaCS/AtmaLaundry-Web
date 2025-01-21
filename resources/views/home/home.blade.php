@extends('home.index')

@section('content')

<section id="home" class="appear">
    <div class="paragraph">
        <img class="star" src="{{ asset('images/star.svg') }}" alt="star">
        <h6 class="mini-title">Atma laundry - laundry Services</h6>
        <h1 class="bold-title">Your Laundry, Our Priority.</h1>
        <p class="grey-text">At Atma Laundry, we understand that your time is valuable. That's why we prioritize giving your clothes the highest level of care, ensuring they're fresh, clean, and ready when you need them. With us, your laundry is always our top priority.</p>
        <a href="{{ url('login') }}"><button class="btn blue-btn">Order Now</button></a>
        <a href="{{ url('howitworks') }}"><button class="btn white-btn">How It Works?</button></a>
    </div>

    <div class="image">
        <img id="btop" src="{{ asset('images/Bubbles top.svg') }}" alt="bubble">
        <img id="diswasher" src="{{ asset('images/diswasher.svg') }}" alt="bubble">
        <img id="bbottom" src="{{ asset('images/Bubbles bottom.svg') }}" alt="bubble">
    </div>

    <div class="info">
        <div class="detail-info">
            <h2>10K +</h2>
            <p>Clothes Cleaned</p>
        </div>
        <div class="detail-info">
            <h2>126 +</h2>
            <p>Professional Tools</p>
        </div>
        <div class="detail-info">
            <h2>99 %</h2>
            <p>Satisfied Clients</p>
        </div>
    </div>

</section>

<section id="howitworks" class="appear">
    <h3>How it works</h3>
    <h1 class="bold-title">Get it done in 5 steps</h1>

    <div class="card-list">

        @foreach($hiw as $hiw)

        <div class="card text-center mb-3" style="width: 13rem;">
            <div class="card-body">
                <h5 class="card-title">Step {{ $hiw['id'] }}</h5>
                <h4>{{ $hiw['name'] }}</h4>
                <img src="{{ $hiw['image'] }}" alt="card img">
            </div>
        </div>

        @endforeach

    </div>
</section>

<section id="services" class="appear">

    <div class="sub-title">
        <img class="star" src="{{ asset('images/star.svg') }}" alt="star">
        <h6 class="mini-title">Our Services</h6>
        <h1 class="bold-title">Services We Provide</h1>
    </div>

    <div class="service-list">

        @foreach($services as $service)

        <div class="service-card" id="service1">
            <img src="{{ $service['image'] }}" alt="service icon">
            <h4 class="service-name">{{ $service['name'] }}</h4>
            @foreach($service['list'] as $servicelist)
            <p class="grey-text"><i class="fa-solid fa-circle-chevron-right"></i> {{ $servicelist }}</p>
            @endforeach
            <hr>
            <p style="font-weight: bold;">Rp {{ number_format($service['price'],0,",",".") }} / kg</p>
        </div>

        @endforeach

    </div>

    <a href="{{ url('howitworks') }}">
        <button class="btn btn-learn">Learn More</button>
    </a>

</section>

<section id="aboutus" class="appear">
    <div class="paragraph">
        <img class="star" src="{{ asset('images/star.svg') }}" alt="star">
        <h6 class="mini-title">ABOUT US</h6>
        <h1 class="bold-title">Laundry with Our Professional Cleaning Services</h1>
        <p class="grey-text">Our mission is to deliver exceptional laundry services that combine premium quality with affordable pricing, encapsulated in our tagline, “Affordable Luxury for Your Laundry Needs.”</p>
    </div>

    <div class="all-progress">
        <div class="a-progress">
            <div class="progress-text">
                <h5 class="name">Experienced</h5>
                <h5 class="percent">98%</h5>
            </div>
            <div class="progress-detail">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 98%; background-color: #84DAE7;"></div>
                </div>
            </div>
        </div>

        <div class="a-progress">
            <div class="progress-text">
                <h5 class="name">Reliable</h5>
                <h5 class="percent">86%</h5>
            </div>
            <div class="progress-detail">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 86%; background-color: #84DAE7;"></div>
                </div>
            </div>
        </div>

        <div class="a-progress">
            <div class="progress-text">
                <h5 class="name">Skilled & Capable</h5>
                <h5 class="percent">90%</h5>
            </div>
            <div class="progress-detail">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 90%; background-color: #84DAE7;"></div>
                </div>
            </div>
        </div>

        <div class="a-progress">
            <div class="progress-text">
                <h5 class="name">Flexible</h5>
                <h5 class="percent">80%</h5>
            </div>
            <div class="progress-detail">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 80%; background-color: #84DAE7;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="review" class="appear">
    <h1 class="bold-title">Rating 4,9 dari 1.111 Review di Google</h1>

    <div class="review-list">
        
        <div class="card">
            <div class="card-body">
                <p class="card-text">Amazing service! My clothes are always spotless and delivered on time. Highly recommend!</p>

                <div class="user-profile">
                    <img src="{{ asset('images/profpic.jpg') }}" alt="" class="profile-picture">
                    <p class="username">Tux</p>
                    <p class="role">Customer</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="card-text">Fast, affordable, and reliable. Atma Laundry never disappoints!</p>

                <div class="user-profile">
                    <img src="{{ asset('images/profpic.jpg') }}" alt="" class="profile-picture">
                    <p class="username">Tux</p>
                    <p class="role">Customer</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="card-text">Convenient pick-up and great results. My go-to for all my laundry needs!</p>

                <div class="user-profile">
                    <img src="{{ asset('images/profpic.jpg') }}" alt="" class="profile-picture">
                    <p class="username">Tux</p>
                    <p class="role">Customer</p>
                </div>
            </div>
        </div>
    </div>

    <a id="reviews-link" class="nav-link" href="{{ url('reviews') }}">See all reviews ></a>
</section>

<section id="locations" class="appear">
    <h1 class="bold-title">LOKASI OUTLET KAMI</h1>
    <div class="location-list">

        @foreach($location as $location)
        <div class="card" style="width: 18rem;">
            <img src="{{ $location['image'] }}" class="card-img-top" alt="icon lokasi">
            <div class="card-body">
                <h5 class="card-title cabang">{{ $location['place'] }}</h5>
                <p class="card-text">{{ $location['address'] }}</p>
                <a href="https://www.google.com/maps" class="btn btn-primary"><i class="fa-solid fa-map-location-dot"></i> Kunjungi Lokasi</a>
            </div>
        </div>
        @endforeach

    </div>
</section>
    
@endsection