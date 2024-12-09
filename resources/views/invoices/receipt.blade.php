<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>{{ $company->legal_name }}</title>
    </head>
    <body>
        <div class="ticket">
            <div class="inner-div">
                
            @if($mycompany->document_logo != null) 
            <br>
            <div class="col-md-6 text-center align-self-center logo-img-div">
                <div>
                    <img src="/images/{{ $mycompany->document_logo }}" style="width:100%" alt="branding logo">
                </div> 
            </div>
            <br>
            <br>
            @else 
                <h3 class="centered">{{ $company->legal_name }}</h3>
            @endif  
        
            <p class="centered">{{ $company->motto }}
                
                {{ $company->address }}
                <br>{{ $company->phone }}</p>
                <span>Receipt No.: {{ $payments[0]->receipt_number }}</span>
            <p>
                Date: {{ $payments[0]->receipt_date->format('Y-m-d') }}
                <br>Customer: {{ ucwords($payments[0]->customer_name) }}
                <br>Phone: {{ $payments[0]->customer_mobile_number }}
            </p>
            <br>
            <table>
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
                    @foreach ($payments as $item)
                    <tr>
                        <td class="description">{{ $item->product }}
                            <br>{{ $item->quantity }} X {{ $item->price_per_unit }} 
                        </td>
                        <td class="right-section">
                            <br>{{ $item->sub_total_price }}
                        </td>
                    </tr>
                    @endforeach
                    
                  
                    
                    <tr>
                        <td class="description">Discount</td>
                        <td class="right-section">GH¢ {{ $item->sum('discount_fee') }}</td>
                    </tr>
                    <tr>
                        <td  class="description">Delivery</td>
                        <td class="right-section">GH¢ {{ $item->sum('delivery_fee') }}</td>
                    </tr>
                    
                    <tr>
                        <td class="description"><strong>Grand Total</strong></td>
                        <td class="right-section"><strong>GH¢ {{ $total_price }}</strong></td>
                    </tr>
                    <tr>
                        <td class="description"><strong>Tendered Amount</strong></td>
                        <td class="right-section"><strong>GH¢ {{ $payments[0]->tendered_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td class="description"><strong>Balance</strong></td>
                        <td class="right-section"><strong>GH¢ {{ $payments[0]->balance }}</strong></td>
                    </tr>

                </tbody>
            </table>
            <br>
            <p class="centered"><strong>Thanks for your purchase!</strong></p>
            <button id="btnPrint" class="hidden-print">Print</button>
        </div>
       
    </div>
        
    </body>
</html>



<style>
    * {
    font-size: 12px;
    font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
    width: 100%;
}

td.description,
th.description {
    width: 50%;
    max-width: 50%;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.price,
th.price {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 90%;
    max-width: 90%;
    text-align: justify;
    margin: 0 auto;
    
}

.right-section{
    text-align: right;
}

.logo-img-div{
    align-content: center;
    justify-content: center;
}

.logo-img-div div{
    max-width: 80%;
    margin: 0 auto;
}




@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
</style>



<script>
    const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
</script>