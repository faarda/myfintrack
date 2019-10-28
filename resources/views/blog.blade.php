@extends('app')

@section('title', 'Blog - Fintrack')

@section('body_class', 'landing blog')

@section('main')
        <div class="container">
            <section class="content">
                <h1 class="text-danger text-center">Welcome to our blog</h1>
                <div>
                    <h2 class="feat text-success"> Latest Posts</h2>
                </div>
            </section>
        </div>
        <section id="blog">

            <div class="container">
                <div class="container" style="padding:0 10%;">
                    <div class="row no-gutters ">

                        <div class="col-lg-6 col-sm-12 col-md-12">
                            <div class="img-responsive-blog"><img src="{{asset('images/blog/shopping.jpg')}}" height="300"
                                    width="400">
                            </div>
                            <div class="pt-4" style="width:400px">
                                <h4>5 steps to managing student finances</h4>
                                <p><em>Posted on the 13th August,2019</em></p>
                                <p class="text-justify">
                                    Managing finances can be tricky for young adults. The good news is you can educate
                                    yourself about responsibly managing your finances and avoid potential mistakes from
                                    which it could take years to recover...<br><span><a
                                            href="https://www.risla.com/financial-literacy/managing-finances"
                                            target=_blank>see more</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-12">
                            <div class="img-responsive-blog"><img src="{{asset('images/blog/ai.jpg')}}" height="300" width="400">
                            </div>
                            <div class="pt-4" style="width:400px">
                                <h4>How AI will change the way you manage your money</h4>
                                <p><em>Posted on the 13th August,2019</em></p>
                                <p class="text-justify">
                                    Data science is increasingly being used to compare products, find deals and give
                                    tailored guidance...<br><span><a
                                            href="https://www.ft.com/content/37ca12d8-b90a-11e9-8a88-aa6628ac896c"
                                            target=_blank>see more</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-12 center">
                            <div class="img-responsive-blog"><img src="{{asset('images/blog/vacation.jpg')}}" height="300"
                                    width="400">
                            </div>
                            <div class="pt-4" style="width:400px">
                                <h4>Basic budgeting tips everyone should know</h4>
                                <p><em>Posted on the 13th August,2019</em></p>
                                <p class="text-justify">
                                    Budgeting lies at the foundation of every financial plan. It doesn’t matter if
                                    you’re living paycheck to paycheck or earning six-figures a year, you need to know
                                    where your money is going if you want to have a handle on your
                                    finances...<br><span><a href="https://www.thebalance.com/budgeting-101-1289589"
                                            target=_blank>see more</a></span>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-md-12 center">
                            <div class="img-responsive-blog"><img src="{{asset('images/blog/track.jpg')}}" height="300"
                                    width="400"></div>
                            <div class="pt-4" style="width:400px">
                                <h4>Track your spendings using myfintrack app</h4>
                                <p><em>Posted on the 13th August,2019</em></p>
                                <p class="text-justifyt">
                                    Spending is highly individual. Beyond the golden rule—spend less than you earn. So,
                                    rather than instructing you “spend on this” or “don’t spend on that,” today we are
                                    challenging you to get in the habit of tracking your outflow...<br><span><a
                                            href="http://myfintrack.000webhostapp.com/" target=_blank>see
                                            more</a></span>
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="row text-center no-gutters">
                <div class="col-lg-12 col-sm-12 col-md-12 more center ">
                    <a class="btn btn-lg btn-outline " href="#" role="button">More posts</a>
                </div>
            </div>
        </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
@endpush
