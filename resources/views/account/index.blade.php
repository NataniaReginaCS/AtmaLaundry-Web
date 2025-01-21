<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.svg">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">

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

    <div class="content-warp">
        @yield('content')
    </div>

    <!-- Script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>

    <!-- Script Navbar -->
    <script src="{{ asset('js/navbar.js') }}"></script>

    <!-- Script khusus navbar -->
    <script>
        if(localStorage.getItem('navbar-active-link') != 'myorder') localStorage.setItem('navbar-active-link','myorder');
    </script>

</body>
</html>
