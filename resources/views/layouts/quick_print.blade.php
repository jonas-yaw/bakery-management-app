@extends('layouts.print')
@section('content')



          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <a href="#" onClick="window.print();"  class="btn btn-sm btn-info pull-right">Print</a>
	         @if($bills->account_number == "Proforma Invoice")
                <p>PROFORMA INVOICE </p>
                @else
                <p>QUOTATION</p>
                @endif
		
              </header>
  



              
              <section class="scrollable wrapper">
               
                  <div class="page" bgcolor="red">
                  
                 
                   <img src="/images/{{ $company->document_logo }}" width="15%" />
                  <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG($bills->invoice_number, 'QRCODE')}}" alt="barcode" />
                
                 
                 <br>
                 <br>
             
               
             
                 <div id="hr"></div>
                 <br>
                
                 <div class="row">
                  <div class="col-xs-6">
               
                    
                 
                
                     <h4 class="font-thin"> <strong> Reference # : </strong> {{ $bills->invoice_number }} </h4>
                     <h4 class="font-thin">  <strong> Processed On : </strong> {{ date("g:ia\, jS M Y", strtotime($bills->created_on )) }}</h4>
                    <br>                 
                    </p>
                  </div>
                  <div class="col-xs-6 text-right">
                 
                   
                     
                       
                  </div>
                </div>
                   
 
                <h4 class="font-thin">
                 Dear Sir/Madam,
                </h4>
                <h4 class="font-thin">
		  We thank you for your request. Please find below the 
		@if($bills->account_number == "Proforma Invoice")
                  proforma invoice
                  @else
                  quotation
                  @endif.
                </h4>
                 <div id="hr"></div> 
		  <h4 align="center"> 
	        @if($bills->account_number == "Proforma Invoice")
                <strong>PROFORMA INVOICE </strong>
                @else
                <strong>QUOTATION</strong>
		@endif

		</h4>
 
                 <div class="panel-body">
  
                           
                          <div class="table-responsive">
                         <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                            <thead>
                              <tr>
                              
                                <th></th>
                                <th></th>
                               
                               
                              </tr>
                            </thead>
                            <tbody>
  
                               <tr>
                                   <td width="20%"> <h5> <strong> CUSTOMER NAME   </strong> </h5>  </td>
                                   <td>
                                   <input type="text" class="form-control" readonly="true" value="{{ strtoupper($bills->account_name) }}" id="company_offer" name="company_offer"> 
                                   </td>
                                   
                                   </tr>
 
                                   <tr>
                                       <td> <h5> <strong> PRODUCT / COVER TYPE  </strong> </h5>   </td>
                                       <td>
                                       <input type="text" class="form-control" readonly="true" value="{{ strtoupper($bills->business_class) }}" id="company_offer" name="company_offer"> 
                                       </td>
                                       
                                       </tr>
 
                                       <tr>
                                           <td> <h5> <strong> DESCRIPTION  </strong> </h5>   </td>
                                           <td>
                                           <textarea style="font-size:15px;line-height:25px;"  type="text" class="form-control" readonly="true" value="" id="company_offer" name="company_offer"> {{ strtoupper($bills->description) }}</textarea>
                                           </td>
                                           
                                           </tr>
 
 
                                     
 
                                       <tr>
                                           <td> <h5> <strong> CURRENCY  </strong> </h5></td>
                                           <td>
                                           <input type="text" class="form-control" readonly="true" value="{{ $bills->currency }}" id="company_offer" name="company_offer"> 
                                           </td>
                                           
                                           </tr>
 
                                       
                                           <tr>
                                               <td> <h5> <strong> PERIOD OF INSURANCE </strong> </h5></td>
                                               <td>
                                               <input type="text" class="form-control" readonly="true" value="{{ $bills->insurance_period_from }} to {{ $bills->insurance_period_to }}" id="company_offer" name="company_offer"> 
                                               </td>
                                               
                                               </tr>
  
                            <tr>
                            <td> <h5> <strong> SUM INSURED  </strong> </h5></td>
                            <td>
                            <input type="text" class="form-control" readonly="true" value="{{ number_format($bills->sum_insured , 2, '.', ',') }}" id="company_offer" name="company_offer"> 
                            </td>
                            
                            </tr>
  
  
                            <tr>
                            <td> <h5> <strong> PREMIUM  </strong> </h5> </td>
                            <td>
                             <input type="text" class="form-control" readonly="true" value="{{  number_format($bills->gross_premium , 2, '.', ',') }}" id="company_share" name="company_share"> 
                            </td>
                           
                          
                            </tr>
  
  
                             <tr>
                            <td> <h5> <strong> NO. OF UNITS  </strong> </h5></td>
                            <td>
                            <input type="text" class="form-control" readonly="true" id="facultaive_offer" name="facultaive_offer" value="{{ $bills->unit }}"> 
                            </td>
                           
                            </tr>
 
                            <tr>
                               <td> <h5> <strong> EXCESS  </strong> </h5> </td>
                               <td>
                               <input type="text" class="form-control" readonly="true" id="facultaive_offer" name="facultaive_offer" value="{{ $bills->status }}"> 
                               </td>
                              
                               </tr>
 
                          
                            </tbody>
                          </table>
                          
                          
                      </div>
                           <div id="hr"></div> 
                      <h3 class="font-thin pull-right"> Total Premium Due : {{ $bills->currency }} {{ number_format($bills->gross_premium, 2, '.', ',') }} </h3>
                      <div id="hr"></div> 
 
                      
                        </div>
                         <br>
                         <br>
            
                       
                     
                      
                    
                   
                                          <div class="quotation-signature col">
                          <div>
                            <img width='20%' src="/images/{{ $signatureSup->signature }}"> 
                          </div>
                            <div>
                              Account Manager : {{ $bills->account_manager }}
                            </div>
                            
                        </div>
 
                        
                       
                         <br>
                         <br>
                        <h4 class="text-center">Thank you for doing business with us! </h4><br><h4 class="text-center">Cheque(s) should be made payable to <b>{{ $company->legal_name }} </b> and please insist on a system generated receipt.</h4><br>
                        <h4 class="text-center">You can also pay via MTN Mobile Money by following the procedure below:</h4>
 
                        <div class="text-center"> 
                        <p>
                       
                           <li>Dail {{ $company->ussd_code }}</li>
                           <li>Select (2) Pay Bills</li>
                           <li>Select (6) General Payments and</li>
                           <li>Enter payment code - {{ $company->app_reference_name }}</li>
                           <li>Enter amount</li>
                           <li>Enter reference (e.g Car Number, Name or Cover Type)</li>
                        
                       </p>
                     </div>
                        
                  

                  </section>
                 

                  </section>
                  

                  
             
@stop

<link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap-extended.css')}}">

<style type="text/css">


      body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 13pt "Tahoma";
    }
    #hr {
  border: 1px solid black;
}

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 300mm;
        min-height: 200mm;
        padding: 20mm;
        margin: 5mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
       
        background-size: 100%;
        background-repeat: no-repeat, no-repeat;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
   /* .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }*/
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 300mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
           
        }
    }

</style>











