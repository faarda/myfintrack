@extends('app')

@section('title', 'Reset password - Fintrack')

@section('body_class', 'auth')

@section('main')
    <div class="auth-main">
        <h2 class="auth-heading">Reset password</h2>
        <div class="auth-img">
            <img src="../images/user-icon.png" alt="">
        </div>
        <p class="auth-subheading">
            Choose a new password
        </p>

        <form action="{{ route('password.update') }}" method="POST" class="form">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" required class="form-input @error('email') error @enderror" name="email" value="{{ $email ?? old('email')}}" placeholder="Enter your email address">

                @error('email')
                    <span class="error-text">{{$message}} </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" required class="form-input @error('password') error @enderror" name="password"  placeholder="Choose a password">

                @error('password')
                    <span class="error-text">{{$message}} </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Repeat password</label>
                <input type="password" required class="form-input @error('password_confirmation') error @enderror" name="password_confirmation"
                    placeholder="Repeat the password">

                    @error('password_confirmation')
                        <span class="error-text">{{$message}} </span>
                    @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-ascent btn-lg">Reset password</button>
            </div>
        </form>
    </div>
@endsection
