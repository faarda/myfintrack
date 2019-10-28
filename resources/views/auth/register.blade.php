@extends('app')

@section('title', 'Register - Fintrack')

@section('body_class', 'auth')

@section('main')
    <div class="auth-main">
        <h2 class="auth-heading">Sign Up</h2>
        <div class="auth-img">
            <img src="../images/user-icon.png" alt="">
        </div>
        <p class="auth-subheading">
            Its free and only takes a minute
        </p>

        <form action="{{route('register')}}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="email">Fullname</label>
                <input type="text" required class="form-input @error('name') error @enderror" name="name" value="{{old('name')}}" placeholder="Enter your fullname">

                @error('name')
                    <span class="error-text">{{$message}} </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" required class="form-input @error('email') error @enderror" name="email" value="{{old('email')}}" placeholder="Enter your email address">

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
                <button class="btn btn-ascent btn-lg">Sign up</button>
            </div>
        </form>

        <p class="footer">Already have an account? <a href="/login" class="text-link">Login</a></p>
        
        @component('components.social')
        @endcomponent
    </div>
@endsection

@push('scripts')
    <script src="https://apis.google.com/js/platform.js" async defer></script>
@endpush