<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.svg">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fadein.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('home') }}">
                <img class="icon" src="{{ asset('images/logo.svg') }}" alt="icon">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="home-link" class="nav-link" aria-current="page" href="{{ url('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a id="hiw-link" class="nav-link" href="{{ url('howitworks') }}">How it works</a>
                    </li>
                    <li class="nav-item">
                        <a id="location-link" class="nav-link" href="{{ url('home#locations') }}">Locations</a>
                    </li>
                    <li class="nav-item">
                        <a id="myorder-link" class="nav-link active" href="{{ url('login') }}">My Orders</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        @yield('content')
    </div>
    
    <footer class="footer-container">
        <a class="brand-name" href="{{ url('home') }}">
            <img class="icon" src="{{ asset('images/icon footer.svg') }}" alt="icon">
        </a>
        <section class="contact-info">
            <h3 class="section-title">Contact Us</h3>
            <p class="contact-details"><i class="fa-solid fa-phone"></i> +6989618492967</p>
            <p class="address"><i class="fa-solid fa-location-dot"></i> Kampus 3 Universitas Atma Jaya Yogyakarta</p>
        </section>
        <section class="business-hours">
            <h3 class="section-title">Business Hours</h3>
            <p class="hours">Everyday: 8 am - 8 pm</p>
        </section>
        <section class="social-media section-title">
            <h5 class="social-title">Check us out</h5>
            <div class="social-icons">
                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </section>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Script Navbar -->
    <script src="{{ asset('js/navbar.js') }}"></script>

    <!-- Script home -->
     <script src="{{ asset('js/fadein.js') }}"></script>

</body>
</html>