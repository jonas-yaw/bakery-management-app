
@extends('layouts.default')
@section('content')
<section id="content">
         <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
          <div class="content-header row">
            
          </div>
          <div class="content-body">
              <!-- users edit start -->



              <section class="users-edit">
                  <div class="card">
                      <div class="card-content">
                          <div class="card-body">
                              <ul class="nav nav-tabs mb-3" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                          <i class="feather icon-briefcase mr-25"></i><span class="d-none d-sm-block">Exchange Rate Manager </span> 
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                          <i class="feather icon-share-2 mr-25"></i><span class="d-none d-sm-block">Bank Of Ghana Rates </span>
                                      </a>
                                  </li>
                                


					 <div style="margin: 0 auto;"></div>

                                    <!-- Inputs Group with Buttons -->
   					 <div class="col-md-3">
                                      <form action="/find-exchange-rates" method="GET">
                                        <fieldset>
                                            <div class="input-group">
                                              
                                                <input type="date" class="form-control" id="search_member" name="search" placeholder="search ..." required>
                                                <div class="input-group-append">
                                                  <button type="submit" class="btn btn-primary" type="button"><i class="feather icon-search"></i></button>
                                                </div>
                                            </div>       
                                        </fieldset>
                                    </form>
                                  </div>                                
                               
                              </ul>

                             
                              <div class="tab-content">
                                  <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                      <!-- users edit media object start -->
                                      <div class="row" id="table-hover-animation">
                                        <div class="col-12">
                                            <div class="card">
                                             
                                              <div class="alert alert-primary mt-1 p-1">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                  @permission('update-exchange-rate')
                                                  <a href="#merge-debit" data-toggle="modal" class="bootstrap-modal-form-open"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>&nbsp; New Currency </button></a>
                                                  @endpermission
                                               
                                                </div>
                                              </div>
                                                <div class="card-content">
                                                    <div class="card-body">


                                                      @permission('update-exchange-rate')
                                                      <section id="multiple-column-form">
                                                        <div class="row match-height">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                 
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                           
                                                                                <div class="form-body" id="paymentform" name='paymentform'>
                                                                                    <div class="row">
                                                      
                                                                                    
                                                      
                                                                                        <div class="col-md-6 col-12">
                                                                                          <div class="form-label-group">
                                                                                            <input type="text" rows="3" class="form-control" placeholder="Currency" readonly="true" id="exchange_currency" name="exchange_currency" value="{{ Request::old('exchange_currency') ?: '' }}">         
                                                                                              <label for="email-id-column">Currency</label>
                                                                                          </div>
                                                                                        </div>
                                                      
                                                      
                                                      
                                                                                      <div class="col-md-6 col-12">
                                                                                        <div class="form-label-group">
                                                                                          <input type="number" min="0.00" step="0.01" placeholder="Rate" rows="3" class="form-control" required="true" id="exchange_rate" name="exchange_rate" value="{{ Request::old('exchange_rate') ?: '' }}">      
                                                                                            <label for="email-id-column">Rate</label>
                                                                                        </div>
                                                                                    </div>
                                                      
                                                      
                                                                                  
                                                                                 
                                                                                    </div>
                                                                                </div>
                                                      
                                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                                 
                                                                                  @permission('update-exchange-rate')
                                                                                  <button type="button" onclick="addRate()" class="btn btn-success btn-s-xs">Save</button>
                                                                                  @endpermission
                                                                                 
                                                                                </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      </section> 
                                                      @endpermission


                                                    
                                                     
                                                       
                                                        <div class="table-responsive">
                                                          
                                                           
                                                              <table id="exchangeRateTable" class="table table-hover-animation table-striped mb-0 font-small-2 text-center">
                                                                <thead>
                                                                  <tr>
                                                                     
                                                                      <th>Currency</th>
                                                                      <th>Rate</th>
                                                                      <th>Updated On</th>
                                                                      <th>Updated By</th>
                                                                      <th></th>
                                                                      
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                            		   <!-- @foreach( $items as $key => $item )
                                                                <tr>
                                                                  <td class="text-center">{{ $item->type }}</td>
                                                                  <td class="text-center">{{ $item->rate }}</td>
                                                                  <td class="text-center">{{ $item->created_on }}</td>
                                                                  <td class="text-center">{{ $item->created_by }}</td>
                                                                </tr>
                                                                  @endforeach  -->
                                                                </tbody>
                                                              </table>
                                                           
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                      <!-- users edit account form start -->
                                      
                                      
                                  </div>
                                  <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                     
                                    <div class="alert alert-primary mt-1 p-1">
                                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                        <a href="https://www.bog.gov.gh/treasury-and-the-markets/daily-interbank-fx-rates/" target="_blank"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>&nbsp; BOG Rates </button></a>
                                     
                                     
                                      </div>
                                    </div>
				                          </div>

                                <div class="tab-pane" id="extra" aria-labelledby="extra-tab" role="tabpanel">
                                   
                              
                              </div>
                                  <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                      <!-- users edit socail form start -->
                                    
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
              <!-- users edit ends -->

          </div>
      </div>
  </div>
  <!-- END: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  @role(['System Admin'])
  <div class="modal fade" id="merge-debit" tabindex="-1" role="dialog" aria-labelledby="merge-debit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Currency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form>
                <input type="text" required class="form-control" width="1000px" height="40px" placeholder="YEN" name="exchange_currency_new" id="exchange_currency_new" placeholder="Currency" /><br>
                <input type="text" required class="form-control" width="1000px" height="40px" placeholder="0.9" name="exchange_rate_new" id="exchange_rate_new" placeholder="Rate" /><br>
                <input type="button" name="submit" onclick="addRateNew()"  class="btn btn-success btn-s-xs" value="Add" />
                <input type="hidden" name="_token" value="{{ Session::token() }}">
              
              </form>
            </div>
        </div>
    </div>
  </div>
  @endrole

@stop



<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">



$(document).ready(function () {
   
    
     
   loadRate();

   

       //$('#nature_of_loss_reinsurer').select2();

    
  });
</script>
<script type="text/javascript">

function addRate()
{
if($('#exchange_currency').val() != "" && $('#exchange_rate').val() != "")
{

    
    $.get('/add-exchange-rate',
        {
          "id":        $('#ratekey').val(),
          "currency":  $('#exchange_currency').val(),
          "rate":      $('#exchange_rate').val()
                       
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          location.reload(true);
        
        }
        else
        {
          sweetAlert("Rate failed to add!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please ensure all fields are filled!");}
}


function addRateNew()
{
if($('#exchange_currency_new').val() != "" && $('#exchange_rate_new').val() != "")
{

    
    $.get('/add-exchange-rate',
        {
          "id":        $('#ratekey').val(),
          "currency":  $('#exchange_currency_new').val(),
          "rate":      $('#exchange_rate_new').val()
                       
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadRate();
        
        }
        else
        {
          sweetAlert("Rate failed to add!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please ensure all fields are filled!");}
}



function editRate(id)
   {
     
          $.get("/edit-exchange-rate",
          {"id":id},
          function(json)
          {

                $('#paymentform input[name="ratekey"]').val(json.ratekey);
                $('#paymentform input[name="exchange_rate"]').val(json.rate);
                $('#paymentform input[name="exchange_currency"]').val(json.currency);


              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });
    
   }
  
   function loadRate()
   {
         
        
        $.get('/get-exchange-rate',
          {
            "id": 'id'
          },
          function(data)
          { 

            $('#exchangeRateTable tbody').empty();
            $.each(data, function (key, value) 
            {           
              $('#exchangeRateTable tbody').append('<tr><td>'+ value['type'] +'</td><td>'+ value['rate'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="editRate('+value['id']+')" class="fa fa-pencil"></i></a></td></tr>');
            });
                                          
         },'json');      
    }
</script>
