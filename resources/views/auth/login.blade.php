@extends('layouts.app')

@section('content')
<div id="App">
    <div class="row">
        <div class="col-lg-6 left">
            <div class="header-form">
                <h2>Sign In</h2>
                <p>Enter your username and password here !</p>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email">Username</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                    <label for="password">Password</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                <button type="submit" class="form-control btn btn-primary">Sign In</button>
            </form>
        </div>
        <div class="col-lg-6 right">
            <img src="{{ asset('assets/img/login-img.png') }}" alt="Login Image">
            <h5>Manage your work more easily and quickly.</h5>
        </div>
    </div>
</div>
@endsection
