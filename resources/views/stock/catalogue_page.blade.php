@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong>Catalogue</strong></h1>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body">



                        <div class="col-md-12 col-12 mb-1">
                            <div class="justify-content-space-between">

                            
                            <div class="input-group-wrap col-md-5">
                                <form action="/get-catalogue" method="GET">
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

                                 <div class="">
                         
                                    @permission('create-sale')
                                     <a href="/create-sale">
                                       <button class="btn btn-md btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;  Create Sale</button>  
                                     </a>
                                     @endpermission
                                 </div>

                                </div>
                           
                        </div>
                    

                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 font-small-2 text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Quantity Avail</th>
                                    <th scope="col">Price Per Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $catalogue as $key => $item )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->item }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price_per_unit }}</td>
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