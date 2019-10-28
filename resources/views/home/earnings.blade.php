@extends('app')

@section('title', 'Earnings - Fintrack')

@section('body_class', 'dashboard')

@section('main')
    <div class="add-entry animated fadeIn">
        <button id="add-entries" class="btn btn-lg btn-ascent">Add earnings</button>

        <div class="create-entries">
            <div>
                <h4>Add earnings</h4>
                <span class="text-link close-entries">close <span data-feather="x-circle"></span></span>
            </div>
            <div class="entry-forms">
                
            </div>
            <p class="new-entry"><a href="" class="text-link" id="add-item">+ Add New Item</a></p>
        </div>
    </div>

    @component('components.spending-history', ['histories' => $data['eh'], 'total' => $data['ec']])
    @endcomponent
@endsection

@push('scripts')
	<script type="text/javascript">
		window.entryType = "e";
	</script>
    <script src="{{asset('scripts/entries.js')}}"></script>
    <script src="{{asset('scripts/pagination.js')}}"></script>
@endpush