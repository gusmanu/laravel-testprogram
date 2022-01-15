@extends('layout.master')
@push('module-css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .card.product .card-header {
	    padding: 0px 25px 0px 27px;
	    min-height: 50px!important;
    }

    .no-margin-bottom {
        margin-bottom: 0px!important;
    }
</style> 
@endpush
@section('section-header')

@endsection

@section('section-body')
<div class="row">
    <div class="col-12">
        <div class="card product">
            <div class="card-header">
                <h4>@yield('card-title')</h4>
            </div>
            @yield('card-body')
        </div>
    </div>
</div>
@endsection

@push('module-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endpush