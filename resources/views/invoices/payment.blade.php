@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong>Sales</strong></h1>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body">


                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center active" id="current-tab" data-toggle="tab" href="#current_payments" aria-controls="account" role="tab" aria-selected="true">
                                <i class="fa fa-cubes"></i>&nbsp;&nbsp;<span class="d-none d-sm-block">Today</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="previous-tab" data-toggle="tab" href="#previous_payments" aria-controls="information" role="tab" aria-selected="false">
                                <i class="fa fa-cogs"></i>&nbsp;&nbsp;<span class="d-none d-sm-block">Previous</span>
                            </a>
                        </li>
                    </ul>

                        <div class="col-md-12 col-12 mb-1 ">
                            <div class="justify-content-flex-end">

                            
                            <div class="input-group-wrap col-md-5">
                                <form action="/get-payments" method="GET">
                                    <fieldset>
                                        <div class="input-group">
    
                                            <input type="text" class="form-control" id="search by name , id , visit type ..." name="search" placeholder="Search By Receipt #, Name, Phone number">
    
    
    
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
    
                                    </fieldset>
    
                                </form>
                            </div>

                            </div>
                           
                        </div>
                    
                        {{-- current payments --}}
                        <div class="tab-content">
                            <div class="tab-pane active" id="current_payments" aria-labelledby="account-tab" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0 font-small-2 text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Receipt #</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Collection Mode</th>
                                                <th scope="col">Fullname</th>
                                                <th scope="col">Mobile #</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($current_payments) == 0)
                                            <tr>
                                                <td colspan="8">No data available</td>
                                            </tr>
                                            @else 
                                            @foreach( $current_payments as $key => $payment )
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $payment->receipt_number }}</td>
                                                <td>{{ $payment->debit_date }}</td>
                                                <td>{{ $payment->total_amount }}</td>
                                                <td>{{ $payment->collection_mode }}</td>
                                                <td>{{ $payment->customer_name }}</td>
                                                <td>{{ $payment->customer_mobile_number }}</td>
                                                <td>
                                                    @permission('print-sales-receipt')
                                                    <a data-toggle="tooltip" data-placement="top" title="Print receipt" data-original-title="Print" alt="Print" href="/print-receipt/{{ Crypt::encrypt($payment->receipt_number) }}"><i class="fa fa-print"></i></a>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif 
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                       

                            {{-- previous payments --}}
                        
                            <div class="tab-pane" id="previous_payments" aria-labelledby="account-tab" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0 font-small-2 text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Receipt #</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Collection Mode</th>
                                                <th scope="col">Fullname</th>
                                                <th scope="col">Mobile #</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($previous_payments) == 0)
                                            <tr>
                                                <td colspan="8">No data available</td>
                                            </tr>
                                            @else 
                                            @foreach( $previous_payments as $key => $payment )
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $payment->receipt_number }}</td>
                                                <td>{{ $payment->debit_date }}</td>
                                                <td>{{ $payment->total_amount }}</td>
                                                <td>{{ $payment->collection_mode }}</td>
                                                <td>{{ $payment->customer_name }}</td>
                                                <td>{{ $payment->customer_mobile_number }}</td>
                                                <td>
                                                    @permission('print-sales-receipt')
                                                    <a data-toggle="tooltip" data-placement="top" title="Print receipt" data-original-title="Print" alt="Print" href="/print-receipt/{{ Crypt::encrypt($payment->receipt_number) }}"><i class="fa fa-print"></i></a>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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


     });
   </script>


<script>
    function addToCart(code,item){
        swal({   
        title: "Are you sure?",   
        text: `Do you want to add ${item} to cart ?`,   
        type: "info",   
        showCancelButton: true,   
        confirmButtonColor: "green",   
        confirmButtonText: "Yes, add!",   
        cancelButtonText: "No, cancel please!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/add-item-to-cart',
          {
             "item_code": code 
          },
          function(json)
          { 
            
            if(json['status'] == "success")
            {
                swal({
                    title: "Added!", 
                    text: "Item was removed successfully", 
                    type: "success"
                    },
                function(){ 
                    location.reload();
                }
                );

            }
            else
            { 
              swal("Cancelled", "Failed to add item to cart.", "error");
              
            }
           
    
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to add item to cart.", "error");   
        } });
    }
</script>