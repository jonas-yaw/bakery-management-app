
@extends('layouts.default')
@section('content')
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
                                          <i class="feather icon-user-check mr-25"></i><span class="d-none d-sm-block"> Current Bill </span>
                                      </a>
                                  </li>

                              </ul>

                              <div class="content-header-left col-md-9 col-12 mb-2">
                                <div class="row breadcrumbs-top">
                                    <div class="col-12">
                                     
                                     
                                      <h2 class="content-header-title float-left mb-0">{{ $billindex->fullname }}</h2>
                                        
                                         
                                        <div class="breadcrumb-wrapper col-12">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="#">{{ $billindex->account_number }}</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#">{{ $billindex->reference }}</a>
                                                </li>
                                                <li class="breadcrumb-item active"><i class="feather icon-phone-call"></i> {{ $customer->mobile_number }}
                                                </li>
                                                <li class="breadcrumb-item active"><i class="feather icon-user"></i>  {{ $billindex->agency }} - {{ $agency->agentname }}
                                                </li>
						
                                                
                                            </ol>
                  
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-primary mb-2" role="alert">
                                      
                            </div>
                  
                             
                              <div class="tab-content">
                                  <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">


                                    <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                  <div class="row match-height">
                      <div class="col-12">
                          <div class="card">
                             
                              <div class="card-content">
                                  <div class="card-body">
                                      <form class="form"  method="post" action="/do-payment">
                                          <div class="form-body">
                                              <div class="row">
                                                <div class="col-sm-6 col-12">
                                                  <label for="referencenumber">Type</label>
                                                  <div class="form-group">
                                                    <select id="receipt_type" name="receipt_type" data-required="true" rows="3" tabindex="1" placeholder="Receipt Type" class="form-control m-b">
                                                      @foreach($receipttypes as $receipttype)
                                                    <option value="{{ $receipttype->type }}">{{ $receipttype->type }}</option>
                                                    @endforeach
                                                    @permission('do-journal-entry')
                                                    <option value="Journal Offset">Journal Offset</option>
                                                    @endpermission
                                                    </select>
                                                  </div>
                                              </div>

                                              <div class="col-sm-6 col-12">
                                              <label for="referencenumber">Mode</label>
                                                <div class="form-group">
                                                  <select id="paymentmethod" name="paymentmethod" onchange="setFields();" data-required="true" rows="3" tabindex="1" placeholder="Payment Mode"  class="form-control m-b">
                                                    @foreach($paymenttypes as $receiptmode)
                                                     <option value="{{ $receiptmode->type }}">{{ $receiptmode->type }}</option>
                                                      @endforeach 
                                                      @permission('do-journal-entry')
                                                      <option value="Commission Offset">Commission Offset</option>
                                                      <option value="Claim Offset">Claim Offset</option>
                                                      <option value="Premium Refund">Premium Refund</option>
                                                      <option value="RI Premium Offset">RI Premium Offset</option>
                                                      <option value="Non-Cash">Non-Cash</option>
                                                      @endpermission
						                                      </select>
                                                </div>
                                            </div>

                                            </div>

                                            <br>
                                            <br>
                                           
                                            <div class="row">
                                              
                                                 
                                
				<div class="col-md-6 col-12">			
				<div id="reference_detail">       
			    <label id="referencenumber_lbl" name="referencenumber_lbl">Reference Number <sup class="text-danger font-medium-1"> * </sup></label>
                                                    <div class="form-label-group">
                                                          <input type="text" id="referencenumber" class="form-control" name="referencenumber">
                                                          
                                                      </div>
                                                  </div>
                                                  </div>

										 
                                 		  <!-- adding cheque input -->
                                                
						<div class="col-md-12 col-12">  
                                                    <div id="cheque_detail"> 
						 <label id="chequenumber_lbl" name="chequenumber_lbl">Cheque Number <sup class="text-danger font-medium-1"> * </sup></label>
                                                    
                                                    
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            
                                                            <select id="cheque_bank" name="cheque_bank" type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                              @foreach($banks as $bank)
                                                              <option value="{{ $bank->prefix }}">{{ $bank->name }} - {{ $bank->prefix }}</option>
                                                              @endforeach  
                                                            
                                                            </select>
                                                        </div>
                                                        <input type="text" minlength="6" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g,'');" id="chequenumber" class="form-control" name="chequenumber">
                                                          
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <!-- cheque input ends here -->

                                                  
                                                  <div class="col-md-6 col-12">
                                                    <div id="reference_detail_post_dated">
                                                    <label for="paid_date">Cheque Due Date <sup class="text-danger font-medium-1"> * </sup></label>
                                                    <div class="form-label-group">
                                                        <input type="text" id="paid_date" class="form-control" value="" name="paid_date" placeholder="">
                                                    </div>
                                                  </div>
                                                  </div>
                                                
					      </div>




                                                <br>
                                                <br>
                                               

                                                <div class="row">
                                                  <div class="col-md-6 col-12">
                                                    <label for="fullname_paid">Paid By <sup class="text-danger font-medium-1"> * </sup></label>
                                                      <div class="form-label-group">
                                                          <input type="text" id="fullname_paid" required class="form-control" value="{{ $billindex->fullname }}" name="fullname_paid" placeholder="Paid By">
                                                          
                                                      </div>
                                                  </div>


                                                  <div class="col-md-6 col-12">
                                                  <div class="form-group">
                                                  <div class="row">
                                                    <div class="col-md-8 col-12">
                                                      <label for="mobile_number">
                                                        Amount Received <sup class="text-danger font-medium-1"> * </sup>
                                                      </label>
                                                     
                                                      <div class="input-group">
                                                      <div class="input-group-prepend">
                                                        
                                                        <select id="mycurrency" name="mycurrency" onchange="convert_amount()" type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <option value="{{ $billindex->currency }}">{{ $billindex->currency }} </option> 
                                                          @foreach($exchange_available as $exchange_available)
                                                           <option value="{{ $exchange_available->type }}">{{ $exchange_available->type }}</option>
                                                          @endforeach 
                                                        
                                                        </select>
                                                    </div>


                                                    

                                                      <input type="text" required min="0" value="" step="0.01" id="amountreceived" class="form-control" placeholder="0" name="amountreceived">
                                                     </div>
                                                    </div>
                                                      
                                                      <div class="col-md-4 col-12">
                                                        <label for="mobile_number">
                                                           Exchange Rate
                                                        </label>
							<input type="text" required min="0" step="0.01" id="exchange_rate" 
              @if (Auth::user()->hasPermission('change-payment-exchange-rate'))
              @else 
              readonly
              @endif 
              class="form-control" value="{{ $exchange->rate }}" name="exchange_rate" onchange="changeExchangeRate();">
							<input type="hidden" required min="0" step="0.01" id="original_exchange_rate" class="form-control" value="{{ $exchange->rate }}" name="original_exchange_rate">
                                                        </div>

                                                        <input type="hidden" required min="0" step="0.01" id="applied_exchange" readonly  class="form-control" value="" name="applied_exchange">

                                                     

                                                    </div>
                                                    </div>
                                                  </div>
                                             
                                              </div>

                                              <br>

                                              <div class="row">
                                                <div class="col-md-12 col-12">
                                                  <div class="form-label-group">
                                                      <input type="text" id="narration" name="narration" class="form-control" placeholder="Narration">
                                                      <label for="narration">Narration</label>
                                                  </div>
                                              </div>
                                              </div>

                                                 
                                              @if($mycompany->accounting == 1)

                                              <div class="alert alert-danger mb-2" role="alert">
                                      
                                              </div>

                                              <div class="row">
                                              <div class="col-md-6 col-12">
                                                <label for="mobile_number">
                                                   Commission Deduc. From Source
                                                </label>
                                                <input type="text" required min="0" step="0.01" id="deduction_amount"  class="form-control" value="0" name="deduction_amount">
                                                </div>
                                              </div>

                                              <br>


                                              <div class="row">
                                              <div class="col-md-6 col-12">
                                                <label for="email-id-column">Bank <sup class="text-danger font-medium-1"> * </sup></label>
                                                <div class="form-label-group">
                                                  <select id="coa_bank" name="coa_bank" required rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                                                    
                                                    <option value=""> -- Please select bank -- </option>
                                                    @foreach($coa_banks as $bank)
                                                    <option value="{{ $bank->code }}">{{ $bank->code }} - {{ $bank->account }}</option>
                                                    @endforeach 
                                                    </select>  
                                                  
                                                </div>
                                              
                                            </div>
                                            <div class="col-md-6 col-12">
                                              <label for="email-id-column">Posting Option</label>
                                              <div class="form-label-group">
                                                <select id="posting_option" name="posting_option" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true" onchange="getJournalStatus(this.value);" >
                                                  <option value="General Ledger">General Ledger</option>
                                                  <option value="Cash Book">Cash Book</option>
                                                
                                                  </select>  
                                                
                                              </div>
                                            
                                          </div>
                                          </div>
                                              <div class="alert alert-danger mb-2" role="alert">
                                      
                                              </div>
                                              @else

                                              @endif

                                                  
                                                 
                                                  <div class="col-12">

                                                   
						   

							                                       <a href="#" id="master_save" name="master_save" onclick="doPayment();"  class="btn btn-primary mr-1 mb-1 float-right">Pay</a>
                                                    




                                                        <input type="hidden" name="payable" id="payable" value="{{ $outstanding }}">
                                                        <input type="hidden" name="mystickercharge" id="mystickercharge" value="{{ $bills->sum('sticker_charge') }}">
                                                        <input type="hidden" name="mycommissionrate" id="mycommissionrate" value="{{ $bills->sum('commission_rate')/$bills->count() }}"> 
                                                        <input type="hidden" id="mobile_number" name="mobile_number" value="{{ $customer->mobile_number }}">
                                                        <input type="hidden" id="tax_rate" name="tax_rate" value="{{ $billindex->tax }}">
						                                            
							                                         
                                                        <input type="hidden" name="_token" id="_token" value="{{ Session::token() }}">
                                                        <input type="hidden" name="billid" id="billid" value="{{ $billindex->id }}">
                                                        <input type="hidden" name="invoice_number" id="invoice_number" value="{{ $billindex->invoice_number }}">

                                                        
                                                  </div>
                                             

                                             
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>

             
              <!-- // Basic Floating Label Form section end -->
                                      <!-- users edit media object start -->
                                      <div class="row" id="table-hover-animation">
                                        <div class="col-12">
                                            <div class="card">
                                              <div class="alert alert-primary mb-2" role="alert">
                                      
                                              </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                      
                                                      <p>
                                                        <img src="/images/2691758.png" style="width: 5%;">
                                                        <img src="/images/2715833.png" style="width: 5%;">

							                                          <!-- @if($billindex->currency != 'GH¢')
                                                        <a href="#" class="btn btn-dark btn-lg pull-left"> Converted : GH¢ @ {{ $exchange->rate }} : {{ number_format(($outstanding * $exchange->rate), 2, '.', ',') }}</a>
                                                        @else
								                                        @endif	 -->

                                                        <input type="text" class="btn btn-danger btn-xs pull-right" readonly="true" value="{{ $billindex->currency }} {{ number_format($outstanding , 2, '.', ',') }}" id="outstanding" name="outstanding">     
                                                      </p>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                      

                                       
                                     
                                    </div>
                                   
                                      <!-- users edit media object ends -->
                                      <!-- users edit account form start -->
                                      
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


  @stop



<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {

                loadBills();
                totalPayable();
		setFields();
                $('#reference_detail').hide();
		$('#reference_detail_post_dated').hide();
		$('#amountreceived').number( true, 4 );
    $('#coa_bank').select2();
               

               
                       
  });

 

</script>


<script type="text/javascript">
  $(function () {
     $('#paid_date').daterangepicker({
      "minDate": moment(),
      "maxDate": moment().add(6, 'months'),
       "singleDatePicker":true,
      "showDropdowns": true,
      "autoApply": true,
      "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
      }
    });
  });
  </script>

  <script type="text/javascript">
  

  function changeExchangeRate(){
    $('#original_exchange_rate').val($('#exchange_rate').val());
  }

  function convert_amount()
    {


      var mycurrency       = $('#mycurrency').val();
      var applied_exchange = $('#original_exchange_rate').val();

      $.get('/get-exchange-rate-value',
      {
        "policy_currency" : mycurrency,
      },
      function(data)
      { 
        
        $.each(data, function (key, value) 
        { 
          
             applied_exchange = data.exchange_rate;
             //alert(applied_exchange);
            var convert = ($('#payable').val() * ($('#original_exchange_rate').val()/applied_exchange)).toFixed(4);

             $('#converted_amount').val(convert);
	     $('#applied_exchange').val(applied_exchange);
	     $('#exchange_rate').val(data.exchange_rate);
  		$('#outstanding').val($('#mycurrency').val()+" "+convert);

            swal("Converted Amount : \n" + $('#mycurrency').val() + " " + convert);

        });
                                      
      },'json');

    
    
    }



	  function doPayment()
	  {

	    if($('#amountreceived').val()=="")
	  
	    {document.getElementById('amountreceived').focus(); swal("Please enter amount ",'Fill all fields', "error");}

	    else if($('#chequenumber').val()=="" && ($('#paymentmethod').val()=="Cheque"  || $('#paymentmethod').val()=="Post Dated Cheque"  || $('#paymentmethod').val()== "Self Cheque Deposit" ))
	    {document.getElementById('referencenumber').focus(); swal("Please cheque number ",'Fill all fields', "error");}

	    else if($('#referencenumber').val()=="" && $('#paymentmethod').val()=="Mobile Money")
	    {document.getElementById('referencenumber').focus(); swal("Please transaction ID ",'Fill all fields', "error");}

      else if($('#coa_bank').val()=="")
	    {document.getElementById('coa_bank').focus(); swal("Please select account code ",'Fill all fields', "error");}

	      else
	      {
		    $('#master_save').hide();
		swal({   
		title: "Are you sure you want to pay \n\n " + $('#mycurrency').val() + " " + $('#amountreceived').val(),   
	       
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, pay it!",   
		cancelButtonText: "No, cancel !",   
		closeOnConfirm: true,   
		closeOnCancel: true }, 
		function(isConfirm){   
		  if (isConfirm) 
		  { 

		    
		    disablebutton();

		  $.get('/do-payment',
		  {
		  "payable"            :$('#payable').val(),
		  "mystickercharge"    :$('#mystickercharge').val(),
		  "mycommissionrate"   :$('#mycommissionrate').val(),
		  "mobile_number"      :$('#mobile_number').val(),
		  "tax_rate"           :$('#tax_rate').val(),
		  "billid"             :$('#billid').val(),
		  "invoice_number"     :$('#invoice_number').val(),
		  "amountreceived"     :$('#amountreceived').val(),
		  "fullname_paid"      :$('#fullname_paid').val(),
		  "paid_date"          :$('#paid_date').val(),
		  "exchange_rate"      :$('#original_exchange_rate').val(),
      "mycurrency"         :$('#mycurrency').val(),
		  "applied_exchange"   :$('#applied_exchange').val(),
		  "referencenumber"    :$('#referencenumber').val(),
		        "cheque_bank"         :$('#cheque_bank').val(),
      "chequenumber"       :$('#chequenumber').val(),
      "paymentmethod"      :$('#paymentmethod').val(),
      "receipt_type"       :$('#receipt_type').val(),
      "coa_bank"           :$('#coa_bank').val(),
      "deduction_amount"   :$('#deduction_amount').val(),
      "narration"          :$('#narration').val()

          },
          function(data)
          { 
            
            $.each(data, function (key, value) {
            if(data["OK"])
            {
              window.location = "/print-receipt/"+data["ReferenceNumber"];
              swal.close();
             }
            else
	    {
		
              swal("Cancelled","Failed to pay.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
             
		  else { 
		       $('#master_save').show();
          swal("Cancelled", "Failed to pay.", "error");   
        } });
        

      }
}







  function askToSave()
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want save this vehicle details?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#239B56",   
        cancelButtonText: "No, cancel plx!",  
        confirmButtonText: "Yes, save it!",    
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
             
                //addMotorDetails();

              
          } 
        
        else {     
          swal("Cancelled","Process cancelled.", "error");   
        } });

    
   }

	
  function setFields()
  {

    if($('#paymentmethod').val() == "Mobile Money")
    {
      $('#reference_detail').show();

      $("#referencenumber").attr('maxlength',11);
      $("#referencenumber").attr('minlength',11);
      
      $("#referencenumber_lbl").text("Transaction ID");
    $('#reference_detail_post_dated').hide();
    $('#cheque_detail').hide();
    }

    else if($('#paymentmethod').val() == "Cheque" || $('#paymentmethod').val() == "Self Cheque Deposit")
    {
	    $('#reference_detail').hide();
	     $('#reference_detail_post_dated').hide();
       $('#cheque_detail').show();
    } else if ($('#paymentmethod').val() == "Bancassurance Deposit") {
        $('#reference_detail').show();
        $("#referencenumber_lbl").text("Bank");
        $('#reference_detail_post_dated').hide();
        $('#cheque_detail').hide();    
    }
    else if($('#paymentmethod').val() == "Bank Transfer")
    {
	     $('#reference_detail_post_dated').hide();
      $('#reference_detail').show();
      $("#referencenumber_lbl").text("Transfer Code");
      $('#cheque_detail').hide();
    }

    else if($('#paymentmethod').val() == "Post Dated Cheque")
    {
	    $('#reference_detail').hide();
	     $('#reference_detail_post_dated').show();
       $('#cheque_detail').show();
    }

    else
    {
	 $('#reference_detail_post_dated').hide();
      $('#reference_detail').hide();
      $('#cheque_detail').hide();
    }


    if($('#paymentmethod').val() != "Mobile Money"){
      $("#referencenumber").removeAttr('maxlength');
      $("#referencenumber").removeAttr('minlength');
    }
  }




  /*
  function setFields()
  {

    // if($('#paymentmethod').val() != "Cash")
    // {
    //   $('#reference_detail').show();
    //   //$('#referencenumber_lbl').text('')
    // }
    if($('#paymentmethod').val() == "Mobile Money")
    {
      $('#reference_detail').show();
      $("#referencenumber_lbl").text("Transaction ID");
    $('#reference_detail_post_dated').hide();
    }

    else if($('#paymentmethod').val() == "Cheque")
    {
	    $('#reference_detail').show();
	     $('#reference_detail_post_dated').hide();
      $("#referencenumber_lbl").text("Cheque Number");
    }

    else if($('#paymentmethod').val() == "Bank Transfer")
    {
	     $('#reference_detail_post_dated').hide();
      $('#reference_detail').show();
      $("#referencenumber_lbl").text("Transfer Code");
    }

    else if($('#paymentmethod').val() == "Post Dated Cheque")
    {
	    $('#reference_detail').show();
	     $('#reference_detail_post_dated').show();
      $("#referencenumber_lbl").text("Cheque Number");
    }

    else
    {
	 $('#reference_detail_post_dated').hide();
      $('#reference_detail').hide();

    }


  }
*/
   function loadBills()
   {
         
        $.get('/invoice-list',
          {
            "opd_number": $('#visit_id').val()
          },
          function(data)
          { 

            $('#invoiceTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#invoiceTable tbody').append('<tr><td><input type="checkbox" name="drug['+value['id']+']" id="'+value['id']+'" value="'+value['id']+'"></td><td>.</td><td>'+ value['date'] +'</td><td>'+ value['item_name'] +'</td><td>'+ value['quantity'] +'</td><td>'+ value['amount'] +'</td><td>'+ value['category'] +'</td><td><input type="text" class="form-control form-control-sm" readonly item_code="'+ value['id'] +'" value="'+ value['discount'] +'" onchange="discount_invoice_item(this);"></td><td>'+ ((value['amount']*value['quantity'])-value['discount']) +'</td><td><a a href="#"><i onclick="excludefrombill(\''+value['id']+'\',\''+value['item_name']+'\')" class="fa fa-trash-o"></i></a></td></tr>');

           
            // 
            });
                                          
         },'json');      
    }


    function totalPayable()
    {
     
          $.get('/billing-total',
        {
          "opd_number": $('#visit_id').val()
        },
        function(data)
        { 
         // alert(data.outstanding);
          $.each(data, function (key, value) 
          { 
            
          $('#outstanding').val('Current Bill : GHS '+ data.outstanding);

           });
                                        
        },'json'); 
}


    function discount_invoice_item(obj)
    {

      var item_code=$(obj).attr('item_code');
      var new_qty=parseInt($(obj).val());
        //alert(item_code);

          $.get('/update-discount-value',
          {
             "invoice_id": item_code ,
             "discount_charge": new_qty
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              loadBills();
              totalPayable();
             }
            else
            { 
              loadBills();
              totalPayable();
              
            }
           
        });
                                          
          },'json');      
    }


  


</script> 






  

  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>




<script type="text/javascript">
$(document).ready(function () {
   
    $('#selected_item').select2();
    //$('#amountreceived').number( true, 2 );



    //loadInvestigation();
    

  });

  


function disablebutton()
{

  if($('#amountreceived').val() > 0)
  {
	  showLoader();
  //swal("Please wait...!", "info.", "warning"); 
  $('#payform').hide();
  $('#master_save').hide();
  $('#amountreceived').number( true, 4 );
  }
  else
  {
   // swal("Please wait...!", "info.", "warning"); 
  }
}

function getinthousands(value) 
{
    var number = this.value;
    this.value = number.toLocaleString('en');

    alert(this.value);

}

</script>





<style>
  .loading-overlay {
    display: none;
    background: white;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 5; 
    left:0;
    top:0;
    right:0;
    bottom:0;
    top: 0;
}

.loading-overlay-image-container {
    display: none;
    position: fixed;
    z-index: 7;
    top: 50%;
    left: 50%;
    transform: translate( -50%, -50% );
}

.loading-overlay-img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
}
</style>


<script>
  function showLoader(){
  var loader = {

    initialize : function () {
        var html =
            '<div class="loading-overlay"></div>' +
            '<div class="loading-overlay-image-container">' +
                '<img src="/images/loading.gif" class="loading-overlay-img"/>' +
            '</div>';

        $( 'body' ).append( html );
    },

    showLoader : function () {
        jQuery( '.loading-overlay' ).show();
        jQuery( '.loading-overlay-image-container' ).show();
    },

    hideLoader : function () {
        jQuery( '.loading-overlay' ).hide();
        jQuery( '.loading-overlay-image-container' ).hide();
    }
  }

  loader.initialize();
  loader.showLoader();
}
</script>
