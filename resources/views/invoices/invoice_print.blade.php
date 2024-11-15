@extends('layouts.print')
@section('content')

<section class="vbox bg-white">
    <header class="header b-b b-light hidden-print">
        
        <a href="#" onClick="window.print();"  class="btn btn-sm btn-info pull-right">Print</a>
    </header>

    <section class="scrollable wrapper">
        
            <div class="page">

            <div class="print-head-row">
                <img src="/images/{{ $company->document_logo }}" width="10%" />
                <p class="text-center" style="font-size: 20px;"> @if($bills->type=="Credit") CREDIT @else DEBIT @endif NOTE </p>
                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG($bills->invoice_number, 'QRCODE')}}" alt="barcode" />
            
            </div>

        
        
        
            <div id="hr"></div>
            <br>
        
        <div class="row">
            <div class="col">

                <p><strong> @if($bills->type=="Credit") CREDIT @else  DEBIT @endif NO  : </strong>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $bills->invoice_number }} </p>
                <p><strong> CUSTOMER : </strong> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $bills->fullname }} </p>
                <p><strong> REFERENCE  : </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $bills->reference }} </p>
                <p><strong> PERIOD  : </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $bills->commence_date->format('Y-m-d')}} to {{ $bills->expiry_date->format('Y-m-d')  }} </p>
		<p><strong> BRANCH : </strong> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ strtoupper($bills->branch) }} </p>   
            </div>

            
            <div class="col text-right">
                
                <p colspan="13"><strong> @if($bills->type=="Credit") CREDIT @else  DEBIT @endif  DATE : </strong> {{ $bills->invoice_date }} </p>
                <p><strong> CURRENCY : </strong> {{ $bills->currency }} </p>
                <p><strong> TRANSACTION TYPE : </strong> {{ $bills->transaction_type }} </p>
                
                <p><strong> INTERMEDIARY CODE : </strong> {{ $bills->agency }} </p>
                
            </div>
        
            
        </div>  
        <div class="row">
            
            <div class="col">
                <p><strong> SUM OF : </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ ucwords(strtolower($amountinwords)) }} </p>
           </div>
        </div> 
        <div id="hr"></div>
        <br>
        <p class="pull-right"><strong> TOTAL AMOUNT : </strong>{{$bills->currency }} {{ number_format($bills_total->sum('amount'), 2, '.', ',') }} </p>
        <br>
        <br>
 
        <div id="hr"></div>
        <br>

        <div class="col">
            <div>
                @if($signatureSup != null ) <img width='20%' src="/images/{{ $signatureSup->signature }}">   @else .............................................................................  @endif
            </div>
            <br>
            <div>
                {{ $bills->created_by }} : {{ $bills->created_on }} 
            </div>
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
        color: black !important;
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
        color: black !important;
        font-size: 14px;
       
        background-size: 100%;
        background-repeat: no-repeat, no-repeat;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .print-head-row{
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3%
    }
    
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