@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong>Reports</strong></h1>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body" >

                    <br>
                    <div class="row" style="max-width: 95%;margin:0 auto;">
                        @foreach ($reports as $index => $item)
                        @if (Auth::user()->hasPermission($item->permission))
                            @if ($index % 3 == 0)
                                <div class="row"></div>
                            @endif
                            <div class="card report-card col-md-3 @if($index % 3 != 2) mr-md-3 @endif">
                                <a href="{{ $item->route }}">{{ $item->name }}</a>
                            </div>
                        @endif 
                        @endforeach
                    </div>

                </div>
            </div>
        </div>


</div>
@stop


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
