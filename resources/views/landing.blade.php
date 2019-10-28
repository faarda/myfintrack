@extends('app')

@section('title', 'Welcome to fintrack')

@section('body_class', 'landing')

@section('main')
    <header>
        <h1 class="heading">
            <span>Track your spendings,</span> 
            <span>take control of your finance</span>
        </h1>
        <p class="subheading">We help you monintor how money leaves your pocket, so you can save and acheive more.</p>
        <div class="actions">               
            <a href="{{route('register')}}" class="btn btn-lg btn-ascent">Get started</a>
            <a href="https://easyasitis.com.ng/apk/fintrack.apk" download class="btn btn-outline btn-lg">Download the app</a>
        </div>
    </header>

    <div class="trust">
        <h4>Trusted by millions</h4>
        <div class="people">
            <div class="person"><img src="{{asset('images/people/p1.jpeg')}}" alt=""></div>
            <div class="person"><img src="{{asset('images/people/p2.jpeg')}}" alt=""></div>
            <div class="person"><img src="{{asset('images/people/p3.jpeg')}}" alt=""></div>
            <div class="person"><img src="{{asset('images/people/p4.jpeg')}}" alt=""></div>
            <div class="person"><img src="{{asset('images/people/p5.jpeg')}}" alt=""></div>
        </div>
    </div>
@endsection