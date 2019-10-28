@extends('app')

@section('title', 'Login - Fintrack')

@section('body_class', 'auth')

@section('main')
    <div class="auth-main">
        <h2 class="auth-heading">Login</h2>
        <div class="auth-img">
            <img src="../images/user-icon.png" alt="">
        </div>
        <p class="auth-subheading">
            Welcome back, Enter your account details
        </p>

        <form action="{{route('login')}}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" required class="form-input @error('email') error @enderror" value="{{ old('email') }}" name="email" placeholder="Enter your email address">

                @error('email')
                    <span class="error-text">{{$message}}</span>                
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" required class="form-input @error('password') error @enderror" name="password" placeholder="Enter your password">

                @error('password')
                    <span class="error-text">{{$message}}</span>  
                @enderror
            </div>

            <div class="form-group">
                <a class="text-link" href="{{ route('password.request') }}">Forgot password?</a>
                <button class="btn btn-ascent btn-lg">Login</button>
            </div>
        </form>

        <p class="footer">Don't have an account? <a href="/register" class="text-link">Create your account</a></p>

        @component('components.social')
        @endcomponent
    </div>

    <style type="text/css">
        
    </style>
@endsection
