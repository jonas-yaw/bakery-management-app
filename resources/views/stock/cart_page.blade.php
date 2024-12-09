@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">
 
    <h1 class="h3 mb-2"><strong>POS</strong></h1>


    @livewire('add-cart-items',[])




</div>


@stop



<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

