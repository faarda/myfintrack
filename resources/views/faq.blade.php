@extends('app')

@section('title', 'Frequently asked questions - Fintrack')

@section('body_class', '')

@section('main')
            <div class="container">
            <section class="faq--section">
                <br>
                <h2 class="auth-heading">Frequently asked questions</h2>
                <br>
                <div class="accordion">
                    <button class="accordion--btn" data-question >What is myFinTracker
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <div class="accordion--content" data-answer>
                        <p class="text-content">
                            myFinTracker is a finance tracking application that help users control and
                             understand their spending limit. With this app, you can minimize your 
                             resource usage as well as making sure you don't spend above your monthly 
                             or yearly allowance (or as the case may be).
                        </p>
                    </div>
                    <button class="accordion--btn" data-question>How can I add Spendings?
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <div class="accordion--content" data-answer>
                        <p class="text-content">
                            From your Dashboard, navigate to Spendings >> Click on 
                            "ADD SPENDINGS", fill out the description and amount fields. 
                            Click the "marked button" to save your entries.

                        </p>
                    </div>
                    <button class="accordion--btn" data-question>How can I add Earnings?
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <div class="accordion--content" data-answer>
                        <p class="text-content">
                            Similarly, from your Dashboard, navigate to Earnings >> Click on 
                            "ADD EARNINGS", fill out the description and amount fields. 
                            Click the "marked button" to save your entries.
                        </p>
                    </div>
                    <button class="accordion--btn" data-question>Is it secure?
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <div class="accordion--content" data-answer>
                        <p class="text-content">
                            MyFinTracker tracks your spending limit so as to notify you when you're
                            running into debt or gain. Any information gathered by myFinTracker is only 
                            cached in your device and are not in any way processed to any third-party 
                            ownership.
                        </p>
                    </div>
                </div>
            </section>
        </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/faq.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
@endpush

@push('scripts')
    <script src="{{'scripts/faq.js'}}"></script>
@endpush