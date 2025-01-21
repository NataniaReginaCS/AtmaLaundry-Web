@extends('account.index')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <section class="login">
        <div id="blue-line"></div>
    
        <div class="container d-flex  align-items-center min-vh-100">
            <div class="col-lg-5 login-form">
                <h2>Get Started</h2>
                <p>Don't have an Account ? <a href="{{ url('register') }}">Sign Up</a></p>
                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="mb-4">
                        <p class="mb-1">Username</p>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="username" name="username" id="username" class="form-control" placeholder="Insert Username" required>
                        </div>
                    </div>
    
                    <div class="mb-4">
                        <p class="mb-1">Password</p>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Insert Password" required>
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                    </div>
                    <div class="login-button">
                        
                    <button type="submit" class="btn btn-primary rounded-pill"><a href="{{{ url('/adminDashboard') }}}"></a>Login</button>
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
    </script>

@endsection