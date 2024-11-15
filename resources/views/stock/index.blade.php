@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong>Stock</strong></h1>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body">



                    <div>

                        <div class="row" id="table-hover-animation">
                            <div class="col-12">
                                <div class="card">


                                                    <div class="col-md-12 col-12 mb-1">
            <div class="justify-content-space-between">

            
            <div class="input-group-wrap col-md-5">
                <form action="/get-stock" method="GET">
                    <fieldset>
                        <div class="input-group">

                            <input type="text" class="form-control" id="search by name , id , visit type ..." name="search" placeholder="Search By Item Code, Item Name">



                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                    </fieldset>

                </form>
            </div>

            <div></div>
            </div>
           
        </div>


                                    <div class="alert alert-primary mt-1 p-1">
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                @permission('add-stock-item')
                <a href="/add-stock-item-page"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>&nbsp; Add Item</button></a>
                @endpermission
            </div>
        </div>

                                    <div class="card-content">
                                        <div class="card-body">

                                            
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0 font-small-2 text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Item</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Category</th>
                    <th scope="col">Quantity Available</th>
                    <th scope="col">Price Per Unit</th>
                    <th scope="col">Created on</th>
                    <th scope="col">Created by</th>
                    <th scope="col"></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $stock as $key => $item )
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->barcode }}</td>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->brand }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price_per_unit }}</td>
                    <td>{{ $item->created_on }}</td>
                    <td>{{ $item->created_by }}</td>
                    <td>
                        @permission('edit-stock-item')
                        <a href="#edit_item" onclick="editStockItem('{{ Crypt::encrypt($item->id) }}')" data-toggle="modal" class="bootstrap-modal-form-open" ><i data-toggle="tooltip" data-placement="top" title="Edit item" class="fa fa-pencil"></i></a>
                        @endpermission
                    </td>
                    <td>
                        @permission('delete-stock-item')
                        <a onclick="deleteStockItem('{{ $item->item }}','{{ Crypt::encrypt($item->id) }}')" data-toggle="modal" class="bootstrap-modal-form-open" ><i data-toggle="tooltip" data-placement="top" title="Delete item" class="fa fa-trash"></i></a>
                        @endpermission
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- users edit media object ends -->
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div> Record(s) Found : <img src="/images/250500.svg" width="30px" height="30px"> {{ $stock->total() }} {{ Str::plural('Item', $stock->total()) }}</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {!!$stock->render()!!}
                            </div>
                        </div>
                        <!-- users edit account form start -->
                    </div>

                </div>
            </div>
        </div>


</div>


@stop

<div class="modal fade" id="add_stock_item" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" method="post" action="/add-stock-item" class="panel-body wrapper-lg">
                    @include('stock/add_item')  
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" method="post" action="/update-stock-item" class="panel-body wrapper-lg">
                    @include('stock/edit_item')  
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>

        </div>
    </div>
</div>



<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
   $(document).ready(function () {
        $('#add_item_category').select2();
        $('#edit_item_category').select2();
 
        $('#add_item_brand').select2({
            tags: true
        });


        $('#add_item_supplier').select2();

        $('#edit_item_supplier').select2();

        $('#edit_item_brand').select2({
            tags: true
        });
    });
   </script>


<script>
    
    function editStockItem(id){
        $.get("/fetch-stock-item-details", {
                "id": id
            },

            function(json) {
                $('#edit_item input[name="item_barcode"]').val(json.barcode);
                $('#edit_item input[name="item_name"]').val(json.item);
                $('#edit_item select[name="item_category"]').val(json.category);
                $('#edit_item select[name="item_brand"]').val(json.brand);
                $('#edit_item select[name="item_supplier"]').val(json.supplier);
                $('#edit_item input[name="quantity"]').val(json.quantity);
                $('#edit_item input[name="restock_limit"]').val(json.restock_limit);
                $('#edit_item input[name="price_per_unit"]').val(json.price_per_unit);
                $('#edit_item input[name="cost_price_per_unit"]').val(json.cost_price_per_unit);
                $('#edit_item input[name="key"]').val(id);
            }, 'json').fail(function(msg) {
            alert(msg.status + " " + msg.statusText);
        });
    }


    function deleteStockItem(name,id)
    {
        swal({   
        title: "Are you sure?",   
        text: `Do you want to delete ${name} ?`,   
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
          $.get('/delete-stock-item',
          {
             "id": id 
          },
          function(json)
          { 
            
            if(json['status'] == "success")
            {
                swal({
                    title: "Deleted!", 
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
              swal("Cancelled", "Failed to delete item.", "error");
              
            }
           
    
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to delete item.", "error");   
        } });
    }

</script>