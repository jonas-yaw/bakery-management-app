@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Reports &nbsp;&nbsp;</h2> 
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ $report->route }}">{{ $report->name }}</a>
                    </li> 
                </ol>
            </div>
        </div>
    </div>
    <br>
    <br>

    

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body" >

                    <br>
                    <br>

                    <div class="table-responsive">
                        <table id="salesTable" class="table table-hover-animation  dataex-html5-selectors table-striped mb-0 font-small-2 text-center">
                          <thead>
                            <tr>
                              <th> #</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                             @foreach ($data as $key =>  $item)
                             <tr>
                                <td>{{ ++$key  }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->customer_mobile_number }}</td>
                                 
                             @endforeach
                          </tbody>
                        </table>
                      </div>
                    

                </div>
            </div>
        </div>


</div>
@stop


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>



<style>
    .dataTable > thead > tr > th[class*="sort"]:before,
.dataTable > thead > tr > th[class*="sort"]:after {
    content: "" !important;
}
</style>
