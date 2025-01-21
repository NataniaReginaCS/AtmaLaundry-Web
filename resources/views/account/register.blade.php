@extends('account.index')

@section('content')

<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<section class="register">
    <div id="blue-line"></div>

    <div class="container d-flex  align-items-center min-vh-100">
        <div class="col-lg-6 register-form">
            <h2>Get Started</h2>
            <p>Already have an Account ? <a href="{{{ url('login') }}}">Login</a></p>
            <form action="{{ url('/register') }}" method="POST" id="register">
            @csrf
                <div class="mb-4">
                    <p class="mb-1">Username</p>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="username" name="username" id="username" class="form-control" placeholder="Insert Username" required>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="mb-1">Name</p>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                        <input type="name" name="nama" id="name" class="form-control" placeholder="Insert Your Name" required>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="mb-1">Address</p>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-map-pin"></i></span>
                        <input type="Address" name="alamat" id="Address" class="form-control" placeholder="Insert Address" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <p class="mb-1">Date of Birth</p>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            <input type="date" name="tanggal_lahir" id="date" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <p class="mb-1">Phone Number</p>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                            <input type="tel" name="telepon" id="phone" class="form-control" placeholder="Insert Phone Number" required>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="mb-1">Password</p>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="*Password length(10-32)" required>
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                    </div>
                </div>
                <div class="login-button">
                    <button type="submit" class="btn btn-primary rounded-pill"><a href="{{{ url('dashboard') }}}"></a>Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</section>
    

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('bi-eye');
    });

    document.getElementById('register').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;

        if (password.length < 10 || password.length > 32) {
            e.preventDefault(); 
            alert('Password must be between 10 to 32 characters!');
        }
    });
</script>

@endsection