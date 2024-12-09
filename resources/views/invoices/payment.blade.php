@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong>Payments</strong></h1>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body">
                    @livewire('payment-list-today')
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