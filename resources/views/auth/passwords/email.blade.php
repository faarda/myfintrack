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
            Enter your email address, we'll send an email to verify it's you
        </p>
        @if (session('status'))
            <div class="notification notification-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" required class="form-input @error('email') error @enderror" value="{{ old('email') }}" name="email" placeholder="Enter your email address">

                @error('email')
                    <span class="error-text">{{$message}}</span>                
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-ascent btn-lg">Send password reset link</button>
            </div>
        </form>

    </div>
@endsection
