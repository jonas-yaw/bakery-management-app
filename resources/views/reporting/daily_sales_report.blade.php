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
                    {{-- filters --}}
                    <div class="col-md-12 col-12 mb-1 "> 
                        <form action="/filter-daily-sales-report" method="GET">
                          <div class="row">
                    

                            <div class="col-sm-2">
                                <label for="policy_product">
                                Start Date <sup class="text-danger font-medium-1"> * </sup>
                                </label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="filter_start_date" id="filter_start_date" placeholder="Select your start date" value="" required>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <label for="policy_product">
                                End Date <sup class="text-danger font-medium-1"> * </sup>
                                </label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="filter_end_date" id="filter_end_date" placeholder="Select your end date" value="" required>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <label for="policy_product">
                                Collection Mode<sup class="text-danger font-medium-1"> * </sup>
                                </label>
                                <div class="form-group">
                                    <select class="select2-size-sm form-control" id="collection_mode" name="collection_mode">
                                     
                                      <option selected value="All">All</option>
                                     @foreach($paymentmodes as $mode)
                                         <option value="{{$mode->type}}">{{$mode->type}}</option>
                                     @endforeach
                                   </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="policy_product">
                                Category <sup class="text-danger font-medium-1"> * </sup>
                                </label>
                                <div class="form-group">
                                    <select class="select2-size-sm form-control" id="product_category"  name="product_category">
                                  
                                    <option selected value="All">All</option>
                                    @foreach($stock_category as $category)
                                            <option value="{{$category->type}}">{{$category->type}}</option>
                                        @endforeach
                                    </select>
                                </div>   
                            </div>

                            <div class="col-md-2">
                                <label for="" style="visibility: hidden;">Search</label>
                                <div class="form-group">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary" type="button">Filter</button>
                                    </div>
                                </div>
                            </div>

                          </div>
                        </form>
                    </div>

                    <br>

                    <div class="table-responsive">
                        <table id="salesTable" class="table table-hover-animation  dataex-html5-selectors table-striped mb-0 font-small-2 text-center">
                          <thead>
                            <tr>
                              <th>Receipt #</th>
                              <th>Receipt Date</th>
                              <th>Price Per Unit</th>
                              <th>Quantity</th>
                              <th>Total Price</th>
                              <th>Collection Mode</th>
                              <th>Created By</th>
                              <th>Item</th>
                              <th>Category</th>
                              <th>Customer Name</th>
                              <th>Customer Mobile Number</th>
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                             @foreach ($data as $item)
                             <tr>
                                <td>{{ $item->receipt_number }}</td>
                                <td>{{ $item->receipt_date }}</td>
                                <td>{{ $item->price_per_unit }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->sub_total_price }}</td>
                                <td>{{ $item->collection_mode }}</td>
                                <td>{{ $item->created_by }}</td>
                                <td>{{ $item->product }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->customer_mobile_number }}</td>
                             </tr>
                                 
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


<script type="text/javascript">
   $(document).ready(function () {
      //getOccupancyStatistics();
    $(function () {
    $('#filter_start_date').daterangepicker({
      "singleDatePicker":true,
      "autoApply": true,
      "showDropdowns": true,
      "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
      }
    });
  });


    $(function () {
    $('#filter_end_date').daterangepicker({
      "singleDatePicker":true,
      "autoApply": true,
      "showDropdowns": true,
      "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
      }
    });
  });

  $('#collection_mode').select2({
    tags: true
    });

    $('#product_category').select2({
    tags: true
    });


     });
   </script>


<style>
    .dataTable > thead > tr > th[class*="sort"]:before,
.dataTable > thead > tr > th[class*="sort"]:after {
    content: "" !important;
}
</style>


<style>
     table tr:last-child {
            font-weight: bold;
            color: black;
        }
</style>