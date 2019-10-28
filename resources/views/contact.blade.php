@extends('app')

@section('title', 'Contact Us - Fintrack')

@section('body_class', 'auth')

@section('main')
    <div class="auth-main">
        <h2 class="auth-heading">Contact Us</h2>
        <div class="auth-img">
            <img src="../images/email.png" alt="">
        </div>
        <p class="auth-subheading">
            Drop your message, we'll get back to you shortly
        </p>

        @if (session('status'))
            <div class="notification notification-success">
                {{ session('status') }}
            </div> <br>
        @endif

        <form action="{{route('contact')}}" method="POST" class="form">
            @csrf

            <div class="form-group">
                <label for="email">Name</label>
                <input type="text" required class="form-input @error('name') error @enderror" name="name" value="{{old('name')}}" placeholder="What's your name?">

                @error('name')
                    <span class="error-text">{{$message}} </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" required class="form-input @error('email') error @enderror" value="{{ old('email') }}" name="email" placeholder="whats your email address?">

                @error('email')
                    <span class="error-text">{{$message}}</span>                
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Message</label>
                <textarea name="message" required="" class="form-input @error('message') error @enderror" placeholder="Your mesage"></textarea>

                @error('message')
                    <span class="error-text">{{$message}}</span>  
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-ascent btn-lg">Contact us</button>
            </div>
        </form>
    </div>
@endsection
