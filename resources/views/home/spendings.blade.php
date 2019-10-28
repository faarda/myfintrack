@extends('app')

@section('title', 'Spendings - Fintrack')

@section('body_class', 'dashboard')

@section('main')
    <div class="add-entry animated fadeIn">
        <button id="add-entries" class="btn btn-lg btn-ascent">Add spendings</button>

        <div class="create-entries">
            <div>
                <h4>Add spendings</h4>
                <span class="text-link close-entries">close <span data-feather="x-circle"></span></span>
            </div>
            <div class="entry-forms">
                
            </div>
            <p class="new-entry">
                <a href="" class="text-link" id="add-item">+ Add New Item</a>
                <span style="float: right;">&nbsp; &nbsp; | &nbsp; &nbsp;</span>
                <a href="" class="text-link" id="use-presets">~ Use presets</a>
            </p>
        </div>
    </div>

    @component('components.spending-history', ['histories' => $data['sh'], 'total' => $data['sc']])
    @endcomponent
@endsection

@push('scripts')
	<script type="text/javascript">
		window.entryType = "s";
	</script>
    <script src="{{asset('scripts/entries.js')}}"></script>
    <script src="{{asset('scripts/pagination.js')}}"></script>
@endpush