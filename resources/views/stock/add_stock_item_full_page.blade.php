@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <div class=" tw-font-semibold tw-text-2xl tw-text-black tw-mb-3">Add Item</div>
    <div>
        @livewire('add-stock-page')
    </div>


</div>
@stop


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
   $(document).ready(function () {

     });
</script>

 