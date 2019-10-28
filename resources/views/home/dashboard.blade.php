@extends('app')

@section('title', 'Dashboard - Fintrack')

@section('body_class', 'dashboard')

@section('main')
    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon icon-1">
                <span data-feather="archive"></span>
            </div>
            <h3 class="stat-value">₦{{number_format($data['ab'])}}</h3>
            <p class="stat-title">Available Balance</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-2">
                <span data-feather="credit-card"></span>
            </div>
            <h3 class="stat-value">₦{{number_format($data['stm'])}}</h3>
            <p class="stat-title">Spent this month</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-3">
                <span data-feather="gift"></span>
            </div>
            <h3 class="stat-value">₦{{number_format($data['etm'])}}</h3>
            <p class="stat-title">Earned this month</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-4">
                <span data-feather="trending-up"></span>
            </div>
            <h3 class="stat-value">{{round($data['si'], 2)}}%</h3>
            <p class="stat-title">Spending Increase</p>
        </div>
    </div>

    <div class="spending-summary">
        <div class="text">
            <h5>Spending summary</h5>
            <p class="spending-text">{{$data['ss']['text']}}</p>
        </div>
        <div class="icon">
            <span data-feather="{{$data['ss']['icon']}}" class="summary-icon {{$data['ss']['class']}}"></span>
        </div>
    </div>

    @component('components.spending-history', ['histories' => $data['sh'], 'total' => $data['sc']])
    @endcomponent
@endsection

@push('scripts')
    <script type="text/javascript">
        window.entryType = "s";
    </script>
    <script src="{{asset('scripts/pagination.js')}}"></script>
@endpush
