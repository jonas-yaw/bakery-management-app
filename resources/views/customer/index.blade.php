@extends('layouts.default')
@section('content')
<section id="content">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">

            </div>
            <div class="content-body">

                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">


                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">Active Customer</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                            <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">Inactive Customer</span>
                                        </a>
                                    </li>

                                    <!-- Inputs Group with Buttons -->

                                    <div class="col-md-6 col-12 mb-1">
                                        <form action="/find-customer" method="GET">
                                            <fieldset>
                                                <div class="input-group">

                                                    <input type="text" class="form-control" id="search by name , phone number..." name="search" placeholder="search...">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                                    <input type="text" name='review_period' id='review_period' class="input-sm form-control round" placeholder="Search by name, phone number">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary" type="button"><i class="feather icon-search"></i></button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>

                                    </div>

                                </ul>


                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->
                                        <div class="row" id="table-hover-animation">

                                            <div class="col-12">
                                                <div class="alert alert-primary mt-1 p-1">
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <a href="/register-start"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>&nbsp; Add new customer</button></a>


                                                    </div>
                                                </div>
                                                <div class="card">

                                                    <div class="card-content">
                                                        <div class="card-body">

                                                            <div class="table-responsive">
                                                                <table class="table table-stripedtable-hover mb-0 font-small-3 text-center">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Customer #</th>
                                                                            <th scope="col">Fullname</th>
                                                                            <th scope="col">Address</th>
                                                                            <th scope="col">Contact</th>
                                                                            <th scope="col">Created On</th>
                                                                            <th scope="col">Created By</th>
                                                                            <th scope="col"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach( $customers as $customer )
                                                                        <tr>
                                                                            <td><a href="/customer-profile/{{ Crypt::encrypt($customer->account_number) }}">{{ $customer->account_number }}</a></td>
                                                                            <td class="text-left">{{ ucwords(strtolower(Str::limit($customer->fullname,50))) }}</td>
                                                                            <td>{{ ucwords(strtolower($customer->postal_address)) }}</td>
                                                                            <td>{{ $customer->mobile_number }}</td>
                                                                            <td>{{ $customer->created_on }}</td>
                                                                            <td>{{ $customer->created_by }}</td>


                                                                            <td> <a href="/create-reservation/{{ Crypt::encrypt($customer->account_number) }}" class="badge badge-pill badge-glow badge-success mr-1 mb-1" id="edit"> </i> Create New Reservation </a></td>

                                                                            <td class="product-action">


                                                                                <a href="#edit_customer" data-toggle="modal" class="bootstrap-modal-form-open" onclick="setAccountNo('{{ $customer->id }}')"><i class="feather icon-edit-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Account"></i></a>



                                                                                <a href="/customer-profile/{{ Crypt::encrypt($customer->account_number) }}"><i class="feather icon-folder" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Details"></i></a>

                                                                                <a href="#attach_document" data-toggle="modal" class="bootstrap-modal-form-open" onclick="showidonUploadModal('{{$customer->account_number}}')"><i class="feather icon-upload-cloud" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Document(s)"></i></a>

                                                                                @role(['System Admin'])



                                                                                <a href="#" class="" onclick="deletecustomer('{{$customer->id}}','{{ $customer->fullname }}')"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Account"></i></a>

                         
                                                                                @if($customer->status == 'Active')
                                                                                <a href="#" class="" onclick="deactivate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class"><i class="fa fa-thumbs-down" data-toggle="tooltip" data-placement="top" title="" style="color: red;" data-original-title="Deactive"></i> </a>
                                                                                @else
                                                                                <a href="#" class="" onclick="activate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class"><i class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="top" title="" style="color: green;" data-original-title="Activate Account"></i></a>
                                                                                @endif
                                                                            </td>
                                                                            @endrole
                                                                            @endforeach

                                                                    </tbody>
                                                                </table>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div> Record(s) Found : <img src="/images/4149883.png" width="30px" height="30px"> {{ $customers->total() }} {{ Str::plural('Customer', $customers->total()) }}</div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                {!!$customers->render()!!}
                                            </div>
                                        </div>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->

                                    </div>
                                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
            <!-- inactive users edit media object start -->
            <div class="row" id="table-hover-animation">
                                        
                <div class="col-12">
                 
                    <div class="card">
                     
                        <div class="card-content">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <!-- <table id="customerTable" class="table table-striped dataex-html5-selectors table-hover mb-0 font-small-3 text-center"> -->
                                      <table class="table table-stripedtable-hover mb-0 font-small-3 text-center"> 
                                      <thead>

                                         
                                            <tr>
                                                <th scope="col">Customer #</th>
                                                <th scope="col">Fullname</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Created On</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach( $inactive_customers as $customer )
                                                <tr>
                                                  <td><a href="/customer-profile/{{ Crypt::encrypt($customer->account_number) }}">{{ $customer->account_number }}</a></td>
                                                  <td class="text-left">{{ ucwords(strtolower(Str::limit($customer->fullname,50))) }}</td>
                                                  <td>{{ ucwords(strtolower($customer->postal_address)) }}</td>
                                                  <td>{{ $customer->mobile_number }}</td>
                                                  <td>{{ $customer->created_on }}</td>
                                                  <td>{{ $customer->created_by }}</td>
                                                

                                                   <td> 
                                                    @if($customer->status == 'Active')
                                                    <a href="/create-reservation/{{ Crypt::encrypt($customer->account_number) }}" class="badge badge-pill badge-glow badge-success mr-1 mb-1" id="edit"> </i> Create New Reservation </a>
                                                    @else
                                                    <a href="#" style="cursor:not-allowed;font-size:13px;padding:0.7rem;" class="badge badge-pill badge-dark mr-1 mb-1" id="edit"> </i> Create New Reservation </a>
                                                    @endif 
                                                  </td>
                                                
                                                    <td class="product-action">
                                                    
                                                      
                                                      <a href="#edit_customer" data-toggle="modal" class="bootstrap-modal-form-open"
                                                      onclick="setAccountNo('{{ $customer->id }}')"><i class="feather icon-edit-2" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Edit Account"></i></a>
                                                     
                                                     
                                                    
                                                        <a href="/customer-profile/{{ Crypt::encrypt($customer->account_number) }}"><i class="feather icon-folder" data-toggle="tooltip"
                                                          data-placement="top" title="" data-original-title="View Details"></i></a>
                                                   
                                                      <a href="#attach_document" data-toggle="modal" class="bootstrap-modal-form-open"
                                                        onclick="showidonUploadModal('{{$customer->account_number}}')"><i class="feather icon-upload-cloud" data-toggle="tooltip"
                                                          data-placement="top" title="" data-original-title="Upload Document(s)"></i></a>
                                                
                                                  @role(['System Admin'])

                                                 
                                                 
                                                    <a href="#" class="" onclick="deletecustomer('{{$customer->id}}','{{ $customer->fullname }}')"><i
                                                        class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete Account"></i></a>

                                                    <a href="#merge_customer" data-toggle="modal" class="bootstrap-modal-form-open"
                                                          onclick="showidonModal('{{$customer->account_number}}')"><i
                                                          class="feather icon-copy" data-toggle="tooltip" data-placement="top" title=""
                                                          data-original-title="Merge Account"></i></a>
                                                  
                                                    @if($customer->status == 'Active')
                                                    <a href="#" class="" onclick="deactivate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class"><i
                                                        class="fa fa-thumbs-down" data-toggle="tooltip" data-placement="top" title=""
                                                        style="color: red;"
                                                        data-original-title="Deactive"></i> </a>
                                                    @else
                                                    <a href="#" class="" onclick="activate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class"><i
                                                        class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="top" title=""
                                                        style="color: green;"
                                                        data-original-title="Activate Account"></i></a>
                                                    @endif
                                                  </td>
                                                  @endrole
                                                  @endforeach
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-5">
              <div> Record(s) Found : <img src="/images/4149883.png" width="30px" height="30px"> {{ $inactive_customers->total() }} {{ Str::plural('Customer', $inactive_customers->total()) }}</div>
            </div>
              <div class="col-sm-12 col-md-7">
                {!!$inactive_customers->render()!!}
              </div>
                </div>
              <!-- users edit media object ends -->
              <!-- users edit account form start -->

                                    </div>

                                
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>





    <div class="modal fade" id="merge_customer" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Merge Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="get" action="/add-exchange-rate">

                        <input type="text" required readonly class="form-control" width="1000px" height="40px" placeholder="Old Customer Number. eg KS0304918" name="customer_number_old" id="customer_number_old" /><br>
                        <input type="text" required class="form-control" width="1000px" height="40px" placeholder="New Customer Number. eg BT4784899" name="customer_number_new" id="customer_number_new" /><br>

                        <input type="submit" name="submit" class="btn btn-success btn-s-xs" value="Merge" />
                        <input type="hidden" name="_token" value="{{ Session::token() }}">

                    </form>
                </div>
            </div>
        </div>
    </div>









    <div class="modal fade" id="attach_document" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attach Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="/upload-document">
                        <input type="text" required class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
                        <input type="file" required class="form-control dropbox" width="500px" height="40px" name="image" /><br>
                        <input type="submit" name="submit" class="btn btn-success btn-s-xs" value="upload" />
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input type="hidden" name="selectedid" id="selectedid" value="">
                    </form>
                </div>
                <div class="jumbotron how-to-create">
                    <ul>
                        <li>Documents/Images are uploaded as soon as you drop them</li>
                        <li>Maximum allowed size of image is 8MB</li>
                    </ul>

                </div>

            </div>
        </div>
    </div>





    <div class="modal fade" id="edit_customer" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="bootstrap-modal-form" method="post" action="/update-customer" class="panel-body wrapper-lg">
                        @include('customer/edit')  
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>

            </div>
        </div>
    </div>







    @stop



<style type="text/css">
    .product-action > a {
        margin: 0 5px;
    }
</style>

    <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
    <script>
        (function(doc, id) {
            var scripts = doc.getElementsByTagName("script")[0];
            if (!doc.getElementById(id)) {
                var script = doc.createElement("script");
                script.async = 1;
                script.id = id;
                script.src = "https://cdn.jotfor.ms/s/umd/latest/for-sheets-embed.js";
                scripts.parentNode.insertBefore(script, scripts);
            }
        })(document, "jotform-async");
    </script>




    <script type="text/javascript">
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#review_period span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#review_period').daterangepicker({
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
    </script>

    <script>
        var account_no = null;

        function setAccountNo(id) {

            $.get("/edit-customer", {
                    "id": id
                },
                function(json) {

                    $('#edit_customer input[name="account_id"]').val(json.account_id);
                    $('#edit_customer input[name="account_number"]').val(json.account_number);
                    $('#edit_customer input[name="first_name"]').val(json.first_name);
                    $('#edit_customer input[name="last_name"]').val(json.last_name);
                    $('#edit_customer select[name="account_type"]').val(json.account_type);
                    $('#edit_customer textarea[name="residential_address"]').val(json.residential_address);
                    $('#edit_customer textarea[name="postal_address"]').val(json.postal_address);
                    $('#edit_customer input[name="date_of_birth"]').val(json.date_of_birth);
                    $('#edit_customer input[name="email"]').val(json.email);
                    $('#edit_customer select[name="account_manager"]').val(json.account_manager);
                    $('#edit_customer input[name="field_of_activity"]').val(json.field_of_activity);
                    $('#edit_customer input[name="mobile_number"]').val(json.mobile_number);
                    $('#edit_customer select[name="sales_channel"]').val(json.sales_channel);
                    $('#edit_customer select[name="gender"]').val(json.gender);
                    $('#edit_customer img[name="imagePreview"]').attr("src", '/images/avatar_default.jpg');
                    $('#edit_customer input[name="image"]').val(json.image);





                    //}
                }, 'json').fail(function(msg) {
                alert(msg.status + " " + msg.statusText);
            });

        }


        function showidonModal(id) {

            var account_no = id;
            $('#merge_customer input[name="customer_number_old"]').val(account_no);

        }


        function showidonUploadModal(id) {

            var account_no = id;
            $('#attach_document input[name="selectedid"]').val(account_no);

        }
    </script>



    <script>
        function deactivate(id, name) {


            swal({
                    title: "Are you sure?",
                    text: "Do you want to deactivate " + name + " ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, deactivate it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.get('/deactivate-customer', {
                                "ID": id
                            },
                            function(data) {

                                $.each(data, function(key, value) {
                                    if (value == "OK") {
                                        swal("Deleted!", name + " was successfully deactivated.", "success");
                                        location.reload(true);
                                    } else {
                                        swal("Cancelled", name + " failed to deactivate.", "error");

                                    }

                                });

                            }, 'json');

                    } else {
                        swal("Cancelled", name + " failed to deactivate.", "error");
                    }
                });

        }

        function deletecustomer(id, name) {


            swal({
                    title: "Are you sure?",
                    text: "Do you want to delete " + name + " ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.get('/delete-customer', {
                                "ID": id
                            },
                            function(data) {

                                $.each(data, function(key, value) {
                                    if (value == "OK") {
                                        swal("Deleted!", name + " was successfully deleted.", "success");
                                        location.reload(true);
                                    } else {
                                        swal("Cancelled", name + " failed to delete.", "error");

                                    }

                                });

                            }, 'json');

                    } else {
                        swal("Cancelled", name + " failed to delete.", "error");
                    }
                });

        }

        function activate(id, name) {

            //alert(id,name);
            swal({
                    title: "Are you sure?",
                    text: "Do you want to activate " + name + " ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, activate it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.get('/activate-customer', {
                                "ID": id
                            },
                            function(data) {

                                $.each(data, function(key, value) {
                                    if (value == "OK") {
                                        swal("Deleted!", name + " was activated successully.", "success");
                                        location.reload(true);
                                    } else {
                                        swal("Cancelled", name + " failed to activate.", "error");

                                    }

                                });

                            }, 'json');

                    } else {
                        swal("Cancelled", name + " failed to activate.", "error");
                    }
                });

        }


        function notbusiness() {
            if ($('#account_type').val() == "Business") {
                $('#businessname').show();
                $('#individualname').hide();
                $('#individualid').hide();

                $('#firstname').val('');
                $('#surname').val('');
                $('#lastname').val('');



                $('#firstname').val('NA');
                $('#surname').val('NA');
                $('#lastname').val('NA');
                $('#companyname').val('');
            } else if ($('#account_type').val() == "Individual") {
                $('#businessname').hide();
                $('#individualname').show();
                $('#individualid').show();

                $('#firstname').val('');
                $('#surname').val('');
                $('#lastname').val('');
                $('#companyname').val('');
                $('#companyname').val('NA');
            } else {
                $('#businessname').hide();
                $('#individualname').show();
                $('#individualid').show();

                $('#companyname').val('');
                $('#companyname').val('NA');
            }

        }


        function startform() {
            $('#startform').show();
        }
    </script>



    <script type="text/javascript">
        $(function() {
            $('#date_of_birth').daterangepicker({
                "minDate": moment('1950-06-14 0'),
                "maxDate": moment(),
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                }
            });
        });
    </script>


    <script>
        (function(doc, id) {
            var scripts = doc.getElementsByTagName("script")[0];
            if (!doc.getElementById(id)) {
                var script = doc.createElement("script");
                script.async = 1;
                script.id = id;
                script.src = "https://cdn.jotfor.ms/common/tableEmbed.js";
                scripts.parentNode.insertBefore(script, scripts);
            }
        })(document, "jotform-async");
    </script>

<script type="text/javascript">
    $(function() {


      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('lastTab', $(this).attr('href'));
      });
      var lastTab = localStorage.getItem('lastTab');

      if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
      }

    });
</script>