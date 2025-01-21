@extends('home.index')

@section('content')

<section id="review-detail" class="appear">

    <div class="main-text">
        <div class="subtitle">
            <img class="star" src="{{ asset('images/blue-star.svg') }}" alt="star">
            <h6 class="blue-mini-title">TESTIMONIAL</h6>
        </div>
    
        <h1 class="bold-title">Hear What Our Clients Say</h1>
        <p class="grey-text">Your satisfaction is our priority! We try our best to provide only the best services for everyone</p>
    </div>

    <div class="horizontal-scrollable user-review">

        @foreach($reviews as $review)
        <div class="review-card" style="min-width: 20rem;">
            <div class="review-card-body text-secondary">
                <div class="stars">
                    @for($i = 0 ; $i < $review['star'] ; $i++)
                    <i class="fa-solid fa-star orange-star"></i>
                    @endfor
                </div>
                <p class="comment">{{ $review['comment'] }}</p>
            </div>
            <hr class="divider">
            <div class="review-card-footer bg-transparent">
                <div class="user-profile">
                    <img src="{{ $review['profpic'] }}" alt="" class="profile-picture">
                    <p class="username">{{ $review['username'] }}</p>
                    <p class="role">{{ $review['role'] }}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="close-text">
        <h5 class="bold-title">Trusted by 50k+ customers</h5>
        <p>
            <i class="fa-solid fa-star orange-star"></i>
            <i class="fa-solid fa-star orange-star"></i>
            <i class="fa-solid fa-star orange-star"></i>
            <i class="fa-solid fa-star orange-star"></i>
            <i class="fa-solid fa-star orange-star"></i>
            4.9/5
            •
            1,111 Reviews
        </p>
    </div>

</section>

@endsection