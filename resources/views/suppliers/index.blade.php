@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong>Suppliers</strong></h1>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body">
                    @livewire('suppliers-list')
                </div>
            </div>
        </div>


</div>




@stop

<div class="modal fade" id="add_supplier" tabindex="-1" role="dialog" aria-labelledby="add_supplier" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="add_supplier_form" method="post" action="/add-supplier">
                    @include('suppliers/create')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="edit_supplier" tabindex="-1" role="dialog" aria-labelledby="add_supplier" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="edit_supplier_form" method="post" action="/edit-supplier">
                    @include('suppliers/edit')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
   $(document).ready(function () {
      //getOccupancyStatistics();


     });
   </script>


<script>
    function editSupplier(id){
        $.get("/fetch-supplier-details", {
                "id": id
            },

            function(json) {
                $('#edit_supplier input[name="first_name"]').val(json.first_name);
                $('#edit_supplier input[name="last_name"]').val(json.last_name);
                $('#edit_supplier input[name="mobile_number"]').val(json.mobile_number);
                $('#edit_supplier input[name="key"]').val(id);
            }, 'json').fail(function(msg) {
            alert(msg.status + " " + msg.statusText);
        });
    }


    function deleteSupplier(id,name)
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
          $.get('/delete-supplier',
          {
             "id": id 
          },
          function(json)
          { 
            
            if(json['status'] == "success")
            {
                swal({
                    title: "Deleted!", 
                    text: "Supplier was removed successfully", 
                    type: "success"
                    },
                function(){ 
                    location.reload();
                }
                );

            }
            else
            { 
              swal("Cancelled", "Failed to delete supplier.", "error");
              
            }
           
    
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to delete supplier.", "error");   
        } });
    }
</script>