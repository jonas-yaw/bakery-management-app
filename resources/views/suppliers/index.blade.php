@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-2"><strong>Suppliers</strong></h1>

        <div class="card" style="height: auto;">
            <div class="card-content">
                <div class="card-body">



                        <div class="col-md-12 col-12 mb-1">
                            <div class="justify-content-space-between">

                            
                            <div class="input-group-wrap col-md-5">
                                <form action="/get-suppliers" method="GET">
                                    <fieldset>
                                        <div class="input-group">
    
                                            <input type="text" class="form-control" id="search by name , id , visit type ..." name="search" placeholder="Search By Name, Phone number">
    
    
    
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
    
                                    </fieldset>
    
                                </form>
                            </div>

                                 <div class="">
                         
                                     <a href="#add_supplier"  data-toggle="modal" class="bootstrap-modal-form-open">
                                        @permission('add-supplier')
                                       <button class="btn btn-md btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;  Add Supplier</button>  
                                       @endpermission
                                     </a>
                                 </div>

                                </div>
                           
                        </div>
                    

                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 font-small-2 text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Mobile Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Created By</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $suppliers as $key => $supplier )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $supplier->first_name }}</td>
                                    <td>{{ $supplier->last_name }}</td>
                                    <td>{{ $supplier->mobile_number }}</td>
                                    <td>{{ $supplier->status }}</td>
                                    <td>{{ $supplier->created_on }}</td>
                                    <td>{{ $supplier->created_by }}</td>
                                    <td>
                                        @permission('edit-supplier')
                                        <a href="#edit_supplier"  data-toggle="modal" class="bootstrap-modal-form-open" onclick="editSupplier('{{ $supplier->id }}')"><i data-toggle="tooltip" data-placement="top" title="Edit Supplier" data-original-title="Edit Supplier" alt="Edit"  class="fa fa-pencil"></i></a>
                                        @endpermission
                                    </td>
                                    <td>
                                        @permission('delete-supplier')
                                        <a data-toggle="modal" class="bootstrap-modal-form-open" onclick="deleteSupplier('{{ Crypt::encrypt($supplier->id) }}','{{ $supplier->first_name }}')"><i data-toggle="tooltip" data-placement="top" title="Delete Supplier" data-original-title="Delete Supplier" alt="Delete"  class="fa fa-trash"></i></a>
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