@extends('layouts.app')
@section('content')

<!-- BEGIN: Content-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">System Settings</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Pages</a>
                                </li>
                                <li class="breadcrumb-item active"> System Settings
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="content-body">
            <!-- account setting page start -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column mt-md-0 mt-1" id="nav_tabs">
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    Company
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#vertical-brands" aria-expanded="false">
                                    <i class="feather icon-grid mr-50 font-medium-3"></i>
                                    Brands
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill" href="#vertical-categories" aria-expanded="false">
                                    <i class="feather icon-layers mr-50 font-medium-3"></i>
                                    Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="account-pill-social" data-toggle="pill" href="#vertical-payment-modes" aria-expanded="false">
                                    <i class="feather icon-pause mr-50 font-medium-3"></i>
                                    Payment Modes
                                </a>
                            </li>


                        </ul>
                    </div>
                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                          
                                           
                                            <form method="POST" action="/update-company-details">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-username">Company Name</label>
                                                                <input type="text" class="form-control" id="account-username" name="company_legal_name"  placeholder="Name" value="{{ $company->legal_name }}" required data-validation-required-message="This username field is required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-name">Contact</label>
                                                                <input type="text" class="form-control" id="account-name" name="company_phone" placeholder="Phone" value="{{ $company->phone }}" required data-validation-required-message="This name field is required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-e-mail">E-mail</label>
                                                                <input type="email" class="form-control" id="account-e-mail" name="company_email" placeholder="Email" value="{{ $company->email }}" required data-validation-required-message="This email field is required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-e-mail">Address</label>
                                                                <input type="text" class="form-control" id="account-e-mail" name="company_address" placeholder="Address" value="{{ $company->office_address }}" required data-validation-required-message="This email field is required">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                            changes</button>
                                                        <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="tab-pane fade" id="vertical-brands" role="tabpanel" aria-labelledby="vertical-brands" aria-expanded="false">
                                            <div class="alert alert-primary mt-1 p-1">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    @role(['System Admin'])
                                                    <a href="#add-new-brand" data-toggle="modal" class="bootstrap-modal-form-open"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>&nbsp; Add Brand </button></a>
                                                    @endrole

                                                </div>
                                            </div>


                                            <div class="table-responsive">


                                                <table id="brandsTable" class="table table-hover-animation table-striped mb-0 font-small-2 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Type</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($brands as $key => $brand)
                                                            <tr>
                                                                <td>{{ $key++ }}</td>
                                                                <td>{{ $brand->type }}</td>
                                                                <td><a href="#edit-brand"  class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" ><i class="fa fa-edit" onclick="editBrand('{{ $brand->id }}')" data-toggle="tooltip" data-placement="top" title="Edit Brand"></i></a></td>
                                                                <td><i class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete brand" onclick="deleteBrand('{{ $brand->id }}')"></i></td>    
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="vertical-categories" role="tabpanel" aria-labelledby="vertical-categories" aria-expanded="false">
                                            <div class="alert alert-primary mt-1 p-1">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    @role(['System Admin'])
                                                    <a href="#add-category" data-toggle="modal" class="bootstrap-modal-form-open"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>&nbsp; Add Category </button></a>
                                                    @endrole

                                                </div>
                                            </div>


                                            <div class="table-responsive">


                                                <table id="categoriesTable" class="table table-hover-animation table-striped mb-0 font-small-2 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Type</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($categories as $key => $item)
                                                            <tr>
                                                                <td>{{ $key++ }}</td>
                                                                <td>{{ $item->type }}</td>
                                                                <td><a href="#edit-category"  class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" onclick="editCategory('{{ $item->id }}')"><i class="fa fa-edit"></i></a></td>
                                                                <td><i class="fa fa-trash" onclick="deleteCategory('{{ $item->id }}')"></i></td> 
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>


                          

                    <div class="tab-pane fade" id="vertical-payment-modes" role="tabpanel" aria-labelledby="vertical-payment-modes" aria-expanded="false">
                        <div class="alert alert-primary mt-1 p-1">
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                @role(['System Admin'])
                                <a href="#add-payment-type" data-toggle="modal" class="bootstrap-modal-form-open"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>&nbsp; Add Payment Mode </button></a>
                                @endrole

                            </div>
                        </div>


                        <div class="table-responsive">


                            <table id="paymentTypesTable" class="table table-hover-animation table-striped mb-0 font-small-2 text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment_modes as $mode)
                                    <tr>
                                        <td>{{ $key++ }}</td>
                                        <td>{{ $mode->type }}</td>
                                        <td><a href="#edit-payment-type"  class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" onclick="editPaymentType('{{ $mode->id }}')"><i class="fa fa-edit"></i></a></td>
                                        <td><i class="fa fa-trash" onclick="deletePaymentType('{{ $mode->id }}')"></i></td> 
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
    </div>

                </div>
            </section>
        </div>
    </div>


@stop

<div class="modal fade" id="add-new-brand" tabindex="-1" role="dialog" aria-labelledby="add-new-brand" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="add-new-brand-form" method="post" action="/add-new-brand">
                    @include('setup/add_brand')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="edit-brand" tabindex="-1" role="dialog" aria-labelledby="edit-brand" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="edit-brand-form" method="post" action="/edit-brand">
                    @include('setup/edit_brand')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="add-category" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="add-category-form" method="post" action="/add-new-category">
                    @include('setup/add_category')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="edit-category" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="edit-category-form" method="post" action="/edit-category">
                    @include('setup/edit_category')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="add-payment-type" tabindex="-1" role="dialog" aria-labelledby="add-payment-type" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payment Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="add-payment-type-form" method="post" action="/add-new-payment-type">
                    @include('setup/add_payment_type')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="edit-payment-type" tabindex="-1" role="dialog" aria-labelledby="edit-payment-type" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Payment Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" data-validate="parsley" id="edit-hall-form" method="post" action="/edit-payment-type">
                    @include('setup/edit_payment_type')
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                </form>
            </div>

        </div>
    </div>
</div>


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        getExtraBedStatus();
        $('#room_type').select2(); 
        $('#floor_type').select2(); 
        $('#hall_type').select2(); 
        $('#assigned_to').select2(); 
    });
</script>

<script>
    $(document).ready(function() {
        $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#nav_tabs a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>


<script type="text/javascript">

$(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#coupon_period span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    $('#edit_coupon_period span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#coupon_period').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

$('#edit_coupon_period').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

cb(start, end);

});


function getExtraBedStatus(){
    if($('#extra_bed_status').is(":checked")){
        $('#extra_bed_occupancy_div').show();
        $('#extra_bed_status').val('1'); 
        $('#extra_bed_occupancy').prop('required',true);
    }else{
        $('#extra_bed_occupancy_div').hide();
        $('#extra_bed_status').val('0'); 
        $('#extra_bed_occupancy').prop('required',false);
    }
}


function editBrand(id){
    $.get("/fetch-brand-details", {
                "id": id
            },

            function(json) {
                $('#edit-brand input[name="id"]').val(json.id);
                $('#edit-brand input[name="brand_type"]').val(json.type);
            }, 'json').fail(function(msg) {
            alert(msg.status + " " + msg.statusText);
        });
}

function deleteBrand(id){
    swal({   
		title: "Are you sure you want to delete brand ?",   
	       
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete!",   
		cancelButtonText: "No, cancel !",   
		closeOnConfirm: false,   
		closeOnCancel: false }, 
		function(isConfirm){   
		  if (isConfirm) 
		  { 
			
			$.get('/delete-brand-type',
			{
			   "ID": id 
			},
			function(data)
			{ 
			  
            if(data['status'] == "success")
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
              swal("Cancelled", "Failed to be removed from list.", "error");
              
            }
											
			},'json'); 
           
             } 
             
        else {     
          swal("Cancelled", "Failed to be removed from list.", "error");   
        } });   
}

function editCategory(id){
    $.get("/fetch-category-details", {
                "id": id
            },

            function(json) {
                $('#edit-category input[name="type"]').val(json.type);
                $('#edit-category input[name="id"]').val(id);
            }, 'json').fail(function(msg) {
            alert(msg.status + " " + msg.statusText);
        });
}

function deleteCategory(id){
    swal({   
		title: "Are you sure you want to delete category ?",   
	       
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete!",   
		cancelButtonText: "No, cancel !",   
		closeOnConfirm: false,   
		closeOnCancel: false }, 
		function(isConfirm){   
		  if (isConfirm) 
		  { 
			
			$.get('/delete-category-type',
			{
			   "ID": id 
			},
			function(data)
			{ 
			  
                if(data['status'] == "success")
                {
                    swal({
                        title: "Deleted!", 
                        text: "Category was removed successfully", 
                        type: "success"
                        },
                    function(){ 
                        location.reload();
                    }
                    );

                }
                else
                { 
                swal("Cancelled", "Failed to be removed from list.", "error");
                
                }
											
			},'json'); 
           
             } 
             
        else {     
          swal("Cancelled", "Failed to be removed from list.", "error");   
        } });   
}

function editPaymentType(id){
    $.get("/fetch-payment-type-details", {
                "id": id
            },

            function(json) {
                $('#edit-payment-type input[name="type"]').val(json.type);
                $('#edit-payment-type input[name="id"]').val(id);
            }, 'json').fail(function(msg) {
            alert(msg.status + " " + msg.statusText);
        });
}

function deletePaymentType(id){
    swal({   
		title: "Are you sure you want to delete payment mode ?",   
	       
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete!",   
		cancelButtonText: "No, cancel !",   
		closeOnConfirm: false,   
		closeOnCancel: false }, 
		function(isConfirm){   
		  if (isConfirm) 
		  { 
			
			$.get('/delete-payment-type',
			{
			   "ID": id 
			},
			function(data)
			{ 
			  
                if(data['status'] == "success")
                {
                    swal({
                        title: "Deleted!", 
                        text: "Payment mode was removed successfully", 
                        type: "success"
                        },
                    function(){ 
                        location.reload();
                    }
                    );

                }
                else
                { 
                swal("Cancelled", "Failed to be removed from list.", "error");
                
                }
											
			},'json'); 
           
             } 
             
        else {     
          swal("Cancelled", "Failed to be removed from list.", "error");   
        } });   
}


</script>