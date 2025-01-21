<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.svg">
    
     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    
    <style>
        
    </style>
</head>
<body >
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

    <section id="content">
        <aside class="sidebar">

            <div class="icon-menu icon-bar">
                <a class="icon-link hamburger-link" href="{{ url('#') }}" onclick="openSidebar()">
                    <div class="hamburger-icon icon">
                        <i class="bi bi-list"></i>
                    </div>
                    <p class="text-icon" style="font-weight: bold;">Menu</p>
                </a>
            </div>

            <div class="icon-feature-menu icon-bar">

                <a class="icon-link dashboard-link" href="{{ url('adminDashboard') }}">
                    <div class="dashboard-icon icon">
                        <i class="bi bi-grid-1x2-fill"></i>
                    </div>
                    <p class="text-icon dashboard-text">Dashboard</p>
                </a>

                <a class="icon-link profile-link" href="{{ url('customerList') }}">
                    <div class="profile-icon icon">
                        <i class="bi bi-person-circle "></i>
                    </div>
                    <p class="text-icon account-text">Customer</p>
                </a>

                <a class="icon-link order-link" href="{{ url('adminOrderList') }}">
                    <div class="form-icon icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <p class="text-icon order-text">Orders</p>
                </a>

                <a class="icon-link service-link" href="{{ route('admin.serviceList') }}">
                    <div class="cart-icon icon">
                        <i class="bi bi-cart-fill"></i>
                    </div>
                    <p class="text-icon service-text">Services</p>
                </a>

                
            </div>
    
            <div class="icon-user-menu icon-bar">

                <button type="button" class="icon-link logout-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <div class="logout-icon icon">
                        <i class="bi bi-box-arrow-right "></i>
                    </div>
                    <p class="text-icon logout-text">Logout</p>
                </button>
                
            </div>
            
        </aside> 
    
        <div class="content-warp">
            @yield('content')

            <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        Once you’re logged out, you can’t go back
                    </div>
                    <div class="modal-footer" style="display=flex; justify-content: center;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 30px;">Back</button>
                        <form method="POST" action="{{ route ('logout') }}" >
                            @csrf
                            <button type="submit" class="btn btn-primary" style="border-radius: 30px;">Logout</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Script Navbar -->
    <script src="{{ asset('js/navbar.js') }}"></script>

    <!-- Script Sidebar -->
    <script src="{{ asset('js/adminSidebar.js') }}"></script>

    <!-- Script khusus navbar -->
    <script>
        if(localStorage.getItem('navbar-active-link') != 'myorder') localStorage.setItem('navbar-active-link','myorder');
    </script>

</body>
</html>