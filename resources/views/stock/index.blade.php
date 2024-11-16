@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong class="tw-font-semibold">Stock</strong></h1>

    <div class="card" style="height: auto;">
        <div class="card-content">
            <div class="card-body">
                <div>
                    <livewire:stock-listing /> 
                </div>
            </div>
        </div>
    </div>


</div>


@stop


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
