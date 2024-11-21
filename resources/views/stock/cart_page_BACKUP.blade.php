@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">
 
    <h1 class="h3 mb-2"><strong>POS</strong></h1>

    <div id="information-section"></div>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body">

                <div class="col-md-12">
                    <div class="input-group rounded">
                        <input type="search" id="product_search" class="form-control rounded" placeholder="Scan/Search Product by Code Or Name" aria-label="Search" aria-describedby="search-addon" oninput="isBarcodeScannerInput()" onblur="isBarcodeScannerInput()"  onkeypress="preventEnter(event)"/>
                        <span class="input-group-text border-0" id="search-addon" style="background-color: transparent;cursor: pointer;">
                          <i class="fa fa-search" onclick="searchItemRegex();"></i>
                        </span>
                      </div>
                </div>

                <br>
                <br>
                <form id="checkout_form" method="POST" action="/do-checkout">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 font-small-2 text-center" id="cart_table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sub Total Price</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="no_data_row">
                                    <td colspan="6">
                                        <p style="padding-top: 20px;">No Data Available</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="discount_input">Discount</label>
                                <input type="text" class="form-control" name="discount_fee" id="discount_input" min="0" value="0" step="0.01" placeholder="Discount" onchange="checkInputNegatives('discount_input');getTotalPrice()">
                              </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="delivery_input">Delivery Fee</label>
                                <input type="text" class="form-control" name="delivery_fee" id="delivery_input" min="0" value="0" step="0.01" placeholder="Delivery" onchange="checkInputNegatives('delivery_input');getTotalPrice()">
                              </div>
                        </div>

                        <div class="col-3">
                        </div>

                        <div class="col-3">
                            <button type="button" class="btn btn-md btn-success"><strong>Total: {{ $company->currency }} <input type="text" class="no-entry-input text-center total_price_input" name="total_price_input" readonly value="0"> </strong></button>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="customer_type">Customer type</label>
                                <select id="customer_type" name="customer_type" required rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control m-b" style="width: 100%;" onchange="checkCustomerType();">
                                    @foreach($account_types as $account)
                                  <option value="{{ $account->type }}">{{ $account->type }}</option>
                                    @endforeach
                                  </select>
                              </div>
                        </div>

                        <div class="col-3" id="member_account_number_div">
                            <div class="form-group">
                                <label for="reference_number">Account number</label>
                                <input type="text" class="form-control" id="member_account_number" name="member_account_number" value="" placeholder="">
                              </div>
                        </div>

                        <div class="col-3" id="customer_name_div">
                            <div class="form-group">
                                <label for="customer_name">Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="" placeholder="">
                              </div>
                        </div>

                        <div class="col-3" id="mobile_number_div">
                            <div class="form-group">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="" placeholder="">
                              </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Payment mode</label>
                                <select id="payment_mode" name="payment_mode" required rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control m-b" style="width: 100%;" onchange="checkPaymentType();">
                                    @foreach($paymentmodes as $mode)
                                  <option value="{{ $mode->type }}">{{ $mode->type }}</option>
                                    @endforeach
                                  </select>
                              </div>
                        </div>

                        <div class="col-3" id="reference_number_div">
                            <div class="form-group">
                                <label for="reference_number">Reference number</label>
                                <input type="text" class="form-control" id="reference_number" name="reference_number" value="" placeholder="">
                              </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="delivery_input">Amount Collected</label>
                                <input type="text" class="form-control" name="tendered_amount" id="tendered_amount" min="0" value="0" step="0.01" placeholder="" onblur="validateTenderedAmount();">
                              </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="delivery_input">Balance</label>
                                <input type="text" readonly class="form-control" name="balance_amount" id="balance_amount" min="0" value="0" step="0.01">
                              </div>
                        </div>
                    </div>
                    <hr>

                    <div class="justify-content-end">
                        <div>
                            @permission('create-sale')
                            <button type="submit" class="btn btn-md btn-purple" onclick="checkout();">Checkout</button>
                            @endpermission
                        </div>
                    </div>

                    </form>

                </div>
            </div>
        </div>


</div>
@stop


<div class="modal fade" id="search_item_list" tabindex="-1" role="dialog" aria-labelledby="search_item_list_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="search_item_list_label">Items Found</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Modal body content here -->
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 font-small-2 text-center" id="search_cart_table">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          <!-- Modal footer content here -->{{-- 
          <button type="button" class="btn btn-secondary" id="modal-close-btn" data-dismiss="modal">Close</button> --}}
        </div>
      </div>
    </div>
  </div>

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
   $(document).ready(function () {
    $(".modal .close").on("click", function(){
        // Find the parent modal and trigger its close action
        $(this).closest(".modal").modal("hide");
    });

    $('#payment_mode').select2();
    $('#customer_type').select2();
    $('#discount_input').number( true, 2 );
    $('#delivery_input').number( true, 2 );
    $('#tendered_amount').number( true, 2 );
    $('#balance_amount').number( true, 2 );
    
    getTotalSubPrice();
    checkPaymentType();
    checkCustomerType();

  /*   $('.btn-plus, .btn-minus').on('click', function(e) {
        const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
        const input = $(e.target).closest('.input-group').find('input');
        if (input.is('input')) {
            input[0][isNegative ? 'stepDown' : 'stepUp']()
        }
    }); */



    $('#checkout_form').submit(function(event) {
        event.preventDefault(); 
        checkout();
    });


     });
   </script>

   <script>
    function preventEnter(event) {
        return (event.key !== 'Enter');
    }

    function checkInputNegatives(id) {
        var input = document.getElementById(id);
        var value = input.value;
        
        if (value < 0) {
            input.value = 0.00;
        }
    }


    function quantityToggle(element){
        const isNegative = $(element).closest('.btn-minus').is('.btn-minus');
        const input = $(element).closest('.input-group').find('input');

        //console.log(input[3]);
        if (input.is('input')) {
            input[3][isNegative ? 'stepDown' : 'stepUp']()
        }
    }

    function validateTenderedAmount(){
        var total_price = $('.total_price_input').val();
        var tendered_amount = $('#tendered_amount').val();

        if(parseFloat(tendered_amount) < parseFloat(total_price)){
            swal("Error","Amount collected cannot be less than total amount to be paid.", "error");
            $('#tendered_amount').val(total_price);
        }else{
            getBalanceAmount();
        }
    }
        
   </script>


<script>
    function isNumeric(input) {
        return /^[0-9]+$/.test(input);
    }

    function isBarcodeScannerInput() {
        
        var barcode = $('#product_search').val();
        
        if (/^\d{13}$/.test(barcode) || /^\d{12}$/.test(barcode) ) {
            searchItem();
            //console.log('searching barcode...');
        }else if(isNumeric(barcode) == false){
            searchItem();
            //console.log('searching item..');
        }

    }

    function showDataAvailability(){
        var rowCount = $('#cart_table tr').length-1;
        

        if(rowCount > 0){
            $('#cart_table #no_data_row').remove();
        }else{
            $('#cart_table tbody').append(`<tr id="no_data_row">
                                    <td colspan="6">
                                        <p style="padding-top: 20px;">No Data Available</p>
                                    </td>
                                </tr>`);
        }
    }

    function searchItemRegex(){
        if($('#product_search').val() != ''){
            $.get("/find-stock-item-regex", {
                    "search": $('#product_search').val(),
                },

                function(json) {
                    //console.log(json);
                    var rowIds = [];
    
                    $("#cart_table tr").each(function() {
                        var rowId = $(this).attr("id");
                        rowIds.push(rowId);
                    });

                    if(json['data_status'] == "success")
                    {
                        //case where multiple items are found
                        if(json['count'] > 1){
                            
                            $("#search_cart_table tbody").empty();
                            $.each(json['items'], function (key, value) 
                            {           
                                 $('#search_cart_table tbody').append(`
                                    <tr id='${value['code']}'>
                                        <td>${value['item']}</td>
                                        <td>${value['category']}</td>
                                        <td>${value['brand'] ?? ''}</td>
                                        <td>${value['quantity']}</td>
                                        <td>${value['price_per_unit']}</td>
                                        <td> <button type="button" class="btn btn-primary btn-sm" onclick="addItemFromSearchList('${value['code']}','${value['item']}','${value['category']}','${value['price_per_unit']}','${value['quantity']}','${value['resock_limit']}')">Add</button> </td>
                                    </tr>
                                `) 
                            });

                            $("#search_item_list").modal("show");
                        }else{
                            if(rowIds.includes(json['code'])){
                                swal("Duplicate", "Item is already in the list. Kindly increase quantity.", "error");
                                $('#product_search').val('');
                            }else if(json['quantity'] == 0){
                                swal("Out of stock", "Insufficient quantity to sell. Kindly restock !", "error");
                            }else{
                                //check restock limit and notify users 
                                //console.log(parseInt(json['quantity']) , parseInt(json['restock_limit']));
                                if(parseInt(json['quantity']) <= parseInt(json['restock_limit'])){
                                    
                                    $('#information-section').append(`
                                        <div class="alert alert-danger mt-1 p-1">
                                            <p class="text-left">Item - ${json['item']} stock is low. Kindly restock !</p>
                                        </div>
                                    `)
                                }

                                var rowCount = $('#cart_table tr').length-1;

                                showDataAvailability();

                                $('#cart_table tbody').append(`<tr id="${json['code']}">
                                            <td>${rowCount}</td>
                                            <td>${json['item']}</td>
                                            <td class="center-div">
                                                <div class="input-group inline-group">
                                                    <input type="hidden" name="item_code[]" value="${json['code']}">
                                                    <input type="hidden" name="item_name[]" value="${json['item']}">
                                                    <input type="hidden" name="item_category[]" value="${json['category']}">

                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-secondary btn-minus" onclick="quantityToggle(this);getTotalSubPrice('${json['code']}','decrement');">
                                                        <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity text-center" min="1" max="${json['quantity']}" name="quantity[]"  value="1" type="number" onchange="getTotalSubPricePlus('${json['code']}')">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary btn-plus" onclick="quantityToggle(this);getTotalSubPrice('${json['code']}','increment');">
                                                        <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <input type="text" class="no-entry-input text-center price_per_unit_input" name="price_per_unit_input[]" readonly value="${json['price_per_unit']}">   
                                            </td>
                                            <td>
                                                <input type="text" class="no-entry-input text-center sub_total_price_input" name="sub_total_price_input[]" readonly value="${json['price_per_unit']}">
                                            </td>
                                            <td><a href="#" onclick="deleteCartItem('${json['code']}');"><i class="fa fa-trash"></i></a></td>
                                        </tr>`);     

                                getTotalPrice();
                                $('#product_search').val('');
                            }
                        }

                        
                    }

                }, 'json').fail(function(msg) {
                //alert(msg.status + " " + msg.statusText);
            });
        }
    }


    function searchItem(){
        if($('#product_search').val() != ''){
            $.get("/find-stock-item", {
                    "search": $('#product_search').val(),
                },

                function(json) {
                    //console.log(json);
                    var rowIds = [];
    
                    $("#cart_table tr").each(function() {
                        var rowId = $(this).attr("id");
                        rowIds.push(rowId);
                    });

                    if(json['data_status'] == "success")
                    {
                        //case where multiple items are found
                        if(json['count'] > 1){
                            
                            $("#search_cart_table tbody").empty();
                            $.each(json['items'], function (key, value) 
                            {           
                                 $('#search_cart_table tbody').append(`
                                    <tr id='${value['code']}'>
                                        <td>${value['item']}</td>
                                        <td>${value['category']}</td>
                                        <td>${value['brand'] ?? ''}</td>
                                        <td>${value['quantity']}</td>
                                        <td>${value['price_per_unit']}</td>
                                        <td> <button type="button" class="btn btn-primary btn-sm" onclick="addItemFromSearchList('${value['code']}','${value['item']}','${value['category']}','${value['price_per_unit']}','${value['quantity']}','${value['restock_limit']}')">Add</button> </td>
                                    </tr>
                                `) 
                            });

                            $("#search_item_list").modal("show");
                        }else{
                            if(rowIds.includes(json['code'])){
                                swal("Duplicate", "Item is already in the list. Kindly increase quantity.", "error");
                                $('#product_search').val('');
                            }else if(json['quantity'] == 0){
                                swal("Out of stock", "Insufficient quantity to sell. Kindly restock !", "error");
                            }else{
                                //check restock limit and notify users 
                                if(parseInt(json['quantity']) <= parseInt(json['restock_limit'])){
                                    
                                    $('#information-section').append(`
                                        <div class="alert alert-danger mt-1 p-1">
                                            <p class="text-left">Item - ${json['item']} stock is low. Kindly restock !</p>
                                        </div>
                                    `)
                                }

                                var rowCount = $('#cart_table tr').length-1;

                                showDataAvailability();

                                $('#cart_table tbody').append(`<tr id="${json['code']}">
                                            <td>${rowCount}</td>
                                            <td>${json['item']}</td>
                                            <td class="center-div">
                                                <div class="input-group inline-group">
                                                    <input type="hidden" name="item_code[]" value="${json['code']}">
                                                    <input type="hidden" name="item_name[]" value="${json['item']}">
                                                    <input type="hidden" name="item_category[]" value="${json['category']}">

                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-secondary btn-minus" onclick="quantityToggle(this);getTotalSubPrice('${json['code']}','decrement');">
                                                        <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity text-center" min="1" max="${json['quantity']}" name="quantity[]"  value="1" type="number" onchange="getTotalSubPricePlus('${json['code']}')">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary btn-plus" onclick="quantityToggle(this);getTotalSubPrice('${json['code']}','increment');">
                                                        <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <input type="text" class="no-entry-input text-center price_per_unit_input" name="price_per_unit_input[]" readonly value="${json['price_per_unit']}">   
                                            </td>
                                            <td>
                                                <input type="text" class="no-entry-input text-center sub_total_price_input" name="sub_total_price_input[]" readonly value="${json['price_per_unit']}">
                                            </td>
                                            <td><a href="#" onclick="deleteCartItem('${json['code']}');"><i class="fa fa-trash"></i></a></td>
                                        </tr>`);     

                                getTotalPrice();
                                $('#product_search').val('');
                            }
                        }

                        
                    }

                }, 'json').fail(function(msg) {
                //alert(msg.status + " " + msg.statusText);
            });
        }
    }


    function addItemFromSearchList(code,item,category,price_per_unit,quantity,restock_limit){
        var rowIds = [];
    
        $("#cart_table tr").each(function() {
            var rowId = $(this).attr("id");
            rowIds.push(rowId);
        });

        if(rowIds.includes(code)){
                                swal("Duplicate", "Item is already in the list. Kindly increase quantity.", "error");
                                $('#product_search').val('');
                            }
                            else if(quantity == 0){
                                swal("Out of stock", "Insufficient quantity to sell. Kindly restock !", "error");
                            }else{
                                //check restock limit and notify users 
                                
                                if(parseInt(quantity) <= parseInt(restock_limit)){  
                                  
                                    $('#information-section').append(`
                                        <div class="alert alert-danger mt-1 p-1">
                                            <p class="text-left">Item - ${item} stock is low. Kindly restock !</p>
                                        </div>
                                    `)
                                }

                                var rowCount = $('#cart_table tr').length-1;

                                showDataAvailability();

                                $('#cart_table tbody').append(`<tr id="${code}">
                                            <td>${rowCount}</td>
                                            <td>${item}</td>
                                            <td class="center-div">
                                                <div class="input-group inline-group">
                                                    <input type="hidden" name="item_code[]" value="${code}">
                                                    <input type="hidden" name="item_name[]" value="${item}">
                                                    <input type="hidden" name="item_category[]" value="${category}">

                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-secondary btn-minus" onclick="quantityToggle(this);getTotalSubPrice('${code}','decrement');">
                                                        <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity text-center" min="1" name="quantity[]"  value="1" type="number" onchange="getTotalSubPricePlus('${code}')">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary btn-plus" onclick="quantityToggle(this);getTotalSubPrice('${code}','increment');">
                                                        <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <input type="text" class="no-entry-input text-center price_per_unit_input" name="price_per_unit_input[]" readonly value="${price_per_unit}">   
                                            </td>
                                            <td>
                                                <input type="text" class="no-entry-input text-center sub_total_price_input" name="sub_total_price_input[]" readonly value="${price_per_unit}">
                                            </td>
                                            <td><a href="#" onclick="deleteCartItem('${code}');"><i class="fa fa-trash"></i></a></td>
                                        </tr>`);     

                                getTotalPrice();
                                $('#product_search').val('');

                                $('#search_cart_table #'+code).remove();
                            }
    }

    function checkPaymentType(){
        if($('#payment_mode').val() == 'Mobile Money'){
            $('#reference_number_div').show();
        }else{
            $('#reference_number_div').hide();
        }
    }


    function checkCustomerType(){
        if($('#customer_type').val() == 'Member'){
            $('#member_account_number_div').show();
            $('#customer_name_div').hide();
            $('#last_name_div').hide();
            $('#mobile_number_div').hide();
        }else{
            $('#member_account_number_div').hide();
            $('#customer_name_div').show();
            $('#last_name_div').show();
            $('#mobile_number_div').show();
            
        }
    }

    function getTotalSubPricePlus(id){
        var quantity = parseInt($('#'+ id +' .quantity').val());
        var price_per_unit = parseFloat($('#'+ id +' .price_per_unit_input').val());
        var sub_total_price = quantity * price_per_unit;

        $('#'+ id +' .sub_total_price_input').val(sub_total_price.toFixed(2));

        getTotalPrice() 
    }

    function getTotalSubPrice(id,action){
        var quantity = parseInt($('#'+ id +' .quantity').val());
        var price_per_unit = parseFloat($('#'+ id +' .price_per_unit_input').val());

        //console.log(quantity);
        
        /* if(action == 'decrement'){
            if(quantity > 1){
                quantity -= 1;
            }
        }else{
            quantity += 1;
        } */

        var sub_total_price = quantity * price_per_unit;

        $('#'+ id +' .sub_total_price_input').val(sub_total_price.toFixed(2));

        getTotalPrice();

    }

    function getTotalPrice(){
        var totalCharge = 0;
        
        $('.sub_total_price_input').each(function() { 
            totalCharge = totalCharge + parseFloat(this.value.replaceAll(',',''));  
        });

        //discount 
        var discount = $('#discount_input').val();
        totalCharge -= parseFloat(discount);

        //delivery 
        var delivery_fee = $('#delivery_input').val();
        totalCharge = totalCharge + parseFloat(delivery_fee);


        $('.total_price_input').val(totalCharge.toFixed(2));
        $('#tendered_amount').val(totalCharge.toFixed(2));

        getBalanceAmount();
    }


    function getBalanceAmount(){
        var tendered_amount = $('#tendered_amount').val();
        var totalCharge = $('.total_price_input').val();

        var balance = tendered_amount - totalCharge;
        $('#balance_amount').val(balance.toFixed(2));
    }

    function deleteCartItem(id){

        swal({   
        title: "Are you sure?",   
        text: `Do you want to delete item ?`,   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete!",   
        cancelButtonText: "No, cancel please!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
            $('#cart_table #'+id).remove();
            swal("Deleted", "Item removed successfully.", "success");
            getTotalPrice();
            showDataAvailability();
          } 
        else {     
          swal("Cancelled","Failed to delete item.", "error");   
        } });

        
    }

    function checkout(){
        var total_price = $('.total_price_input').val();
        var currency = '{{ $company->currency }}';

        var total_price = parseFloat($('.total_price_input').val());
        var tendered_amount = parseFloat($('#tendered_amount').val());

        if(total_price <= 0){
            swal("Error","Total price must be greater than 0.", "error");
        }else if(tendered_amount < total_price){
            swal("Error","Amount collected cannot be less than total amount to be paid.", "error");
        }else{
            $('#checkout_form').unbind('submit').submit();
        }
    }
</script>


<style>
    #cart_table tbody tr{
        font-weight: bold;
        color: black;
        font-size: 16px;
    }

    .center-div{
        text-align: center;
        display: flex;
        justify-content: center;
    }

    .inline-group {
        max-width: 15rem;
        padding: .2rem;
    }

    .inline-group .form-control {
        text-align: right;
    }

    .form-control[type="number"]::-webkit-inner-spin-button,
    .form-control[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .total_price_input{
        width: 40% !important;
        text-align: left !important;
        color: white;
    }
</style>