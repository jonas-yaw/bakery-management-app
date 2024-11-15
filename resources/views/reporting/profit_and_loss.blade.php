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
                        <form action="/filter-profit-and-loss-report" method="GET">
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
                              <th>Receipt Date</th>
                              <th>Item</th>
                              <th>Cost Price Per Unit</th>
                              <th>Total Cost Price</th>
                              <th>Selling Per Unit</th>
                              <th>Total Selling Price</th>
                              <th>Profit/Loss</th>
                            </tr>
                          </thead>
                          <tbody>
                             @foreach ($data as $item)
                             <tr>
                                <td>{{ $item->receipt_date }}</td>
                                <td>{{ $item->product }}</td>
                                <td>{{ $item->cost_price_per_unit }}</td>
                                <td>{{ $item->total_cost_price }}</td>
                                <td>{{ $item->price_per_unit }}</td>
                                <td>{{ $item->total_selling_price }}</td>
                                <td>{{ $item->profit_and_loss }}</td>
                             </tr>
                             @endforeach
                             {{-- <tr>
                                <td>Total</td>
                                <td colspan="2"></td>
                                <td>{{ $total_cost_price }}</td>
                                <td></td>
                                <td>{{ $total_selling_price }}</td>
                                <td>{{ $total_profit_and_loss }}</td>
                             </tr> --}}
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


     });
   </script>


<style>
    .dataTable > thead > tr > th[class*="sort"]:before,
.dataTable > thead > tr > th[class*="sort"]:after {
    content: "" !important;
}
</style>
