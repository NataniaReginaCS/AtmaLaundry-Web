@extends('user.dashboard')

@section('content')

<section id="profile-page">

    <h1 class="title">Account Settings</h1>

    <div class="form-container">
        <h4 class="form-title">Edit User</h4>
        <form method="POST" action="{{ route ('profile.update') }}" id="editProfileForm">
            @csrf
            <div class="username question">
                <label for="nama">Nama</label> <br>
                <input id="nama" name="nama" type="text" value="{{ $user->nama}}" required>
            </div>

            <div class="address question">
                <label for="alamat">Address</label> <br>
                <input id="address" name="alamat" type="text" value="{{ $user->alamat}}" required>
            </div>

            <div class="phone question">
                <label for="telepon">Phone Number</label> <br>
                <input id="phone" name="telepon" type="tel" value="{{ $user->telepon}}" required>
            </div>

            <div class="button">
                <button type="submit" class="btn btn-primary" id="saveProfileBtn">Accept</button>
            </div>

        </form>
    </div>

</section>

<script>
    
</script>

@endsection