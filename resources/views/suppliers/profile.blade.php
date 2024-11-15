
@extends('layouts.default')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-md-9 col-12 mb-2">
              <div class="row breadcrumbs-top">
                  <div class="col-12">
                      <h2 class="content-header-title float-left mb-0"> {{ $agent->agentname }} - ( {{ $agent->agentcode  }} )</h2>
                      <div class="breadcrumb-wrapper col-12">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                              </li>
                              <li class="breadcrumb-item"><a href="#">Pages</a>
                              </li>
                              <li class="breadcrumb-item active"> Agency Profile
                              </li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
          <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
              <div class="form-group breadcrum-right">
                  <div class="dropdown">
                      <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                      <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                  </div>
              </div>
          </div>
      </div>
      <div class="content-body">
          <!-- account setting page start -->
          <section id="page-account-settings">
              <div class="row">
                  <!-- left menu section -->
                  <div class="col-md-2 mb-2 mb-md-0">
                      <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                          <li class="nav-item">
                              <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                  <i class="feather icon-globe mr-50 font-medium-3"></i>
                                  General
                              </a>
                          </li>
                          
                         
                          <li class="nav-item">
                              <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                  <i class="feather icon-award mr-50 font-medium-3"></i>
                                  Reservations Assigned
                              </a>
                          </li>
                         
                        <li class="nav-item">
                          <a class="nav-link d-flex py-75" id="account-pill-document" data-toggle="pill" href="#account-vertical-document" aria-expanded="false">
                              <i class="feather icon-folder mr-50 font-medium-3"></i>
                              Documents
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
                                          <div class="media">
                                             
                                              <div class="media-body mt-75">
                                                  <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                      <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new letter</label>
                                                      <input type="file" id="account-upload" hidden>
                                                      <button class="btn btn-sm btn-outline-warning ml-50">Reset</button>
                                                  </div>
                                                  <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                                                          size of
                                                          800kB</small></p>
                                              </div>

                                          @permission('activate-deactivate-agent')
                                          @if($agent->flag == 'Active')
                                          <a href="#" class="btn btn-danger mr-sm-1 mb-1 mb-sm-0" onclick="deactivate('{{ $agent->id }}','{{ $agent->agentname }}')" data-toggle="class"><i class="fa fa-thumbs-down text-success text-active"></i><i class="fa fa-times text-danger text"></i>Deactivate</a>
                                          @else
                                          <a href="#" class="btn btn-success mr-sm-1 mb-1 mb-sm-0" onclick="activate('{{ $agent->id }}','{{ $agent->agentname }}')" data-toggle="class"><i class="fa fa-thumbs-down fa-check text-danger text-active"></i><i class="fa fa-times text-danger text"></i>Activate</a>
                                          @endif
                                          @endpermission
                                          </div>
                                          <hr>
                                          <form novalidate method="post" action="/update-agent-profile">
                                              <div class="row">
                                                  <div class="col-12">
                                                      <div class="form-group">
							  <div class="controls">
<input type="hidden" name="agentcode" id="agentcode" value="{{ $agent->agentcode }}">
                                                              <label for="account-username">Intermediary Type</label>
                                                              <input type="text" class="form-control" id="account-username" placeholder="Username" value="{{ ucwords(strtolower($agent->contract_type)) }}" required data-validation-required-message="This username field is required">
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-12">
                                                      <div class="form-group">
                                                          <div class="controls">
                                                              <label for="account-name">Name</label>
                                                              <input type="text" class="form-control" id="account-name" placeholder="Name" value="{{ ucwords(strtolower($agent->agentname)) }}" required data-validation-required-message="This name field is required">
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-12">
                                                      <div class="form-group">
                                                          <div class="controls">
                                                              <label for="account-e-mail">E-mail</label>
                                                              <input type="email" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="{{ ucwords(strtolower($agent->email)) }}" required data-validation-required-message="This email field is required">
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">Mobile Phone</label>
                                                            <input type="text" class="form-control" id="account-name" name="mobile_phone" placeholder="Name" value="{{ $agent->phone_number }}" required data-validation-required-message="This name field is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                  <div class="form-group">
                                                      <div class="controls">
                                                          <label for="account-name">Address</label>
                                                          <input type="text" class="form-control" id="account-name" name="address" placeholder="Name" value="{{ ucwords(strtolower($agent->r_address)) }}" required data-validation-required-message="This name field is required">
                                                      </div>
                                                  </div>
                                              </div>


                                              <!-- New agency details -->
                                              <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">ID Type</label>
                                                        <input type="text" class="form-control" id="account-name" name="id_type"  placeholder="Name" value="{{ $agent->id_type }}" required data-validation-required-message="This name field is required">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                              <div class="form-group">
                                                  <div class="controls">
                                                      <label for="account-name">ID Number</label>
                                                      <input type="text" class="form-control" id="account-name" name="id_number"  placeholder="Name" value="{{ $agent->id_number }}" required data-validation-required-message="This name field is required">
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-12">
                                              <div class="form-group">
                                                  <label for="account-company">Status</label>
                                                  <input type="text" class="form-control" value="{{ ucwords(strtolower($agent->flag)) }}" id="account-company" placeholder="Company name">
                                              </div>
						  </div>
						<input type="hidden" name="_token" value="{{ Session::token() }}">
                                                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
							@permission('update-agent-profile') 
						     <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                          changes</button>
                                                      <button type="reset" class="btn btn-outline-warning">Cancel</button>
							@endpermission 
						 </div>
                      </div>
                  </form>
              </div>



                                      <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                        <div class="table-responsive">
                                          <table class="table table-striped dataex-html5-selectors mb-0 font-small-2 text-center">
                                            <thead>
                                              <tr>
                                                 <!-- <th>Invoice #</th> -->
                                                 <th>Policy #</th>
                                                 <th>Insured</th>
                                                  <th>Date</th>
                                                  <th>Type</th>
                                                  <th>Currency</th>
                                                  <th>Premium</th>
                                                  <th>Payment State</th>
                                                  <th>Status</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                           @foreach($bills as $bill )
                                          <tr>
                                            <!-- <td>{{ $bill->invoice_number }}</td> -->
                                            <td><a href="/view-policy/{{ Crypt::encrypt($bill->endorsement_number) }}">{{ $bill->master_policy_number }}</a></td>
                                            <td class="text-left">{{ Str::limit($bill->fullname, 20) }}</td>
                                            <td>{{ $bill->invoice_date }}</td>
                                            <td>{{ $bill->policy_product }}</td>
                                            <td>{{ $bill->currency }}</td>
                                            <td>{{ $bill->amount }}</td>
                                            <td>{{ $bill->payment_status }}</td>
                                            <td>
                                              @if($bill->insurance_period_to < Carbon\Carbon::now()) <span class="text-danger">Expired</span>
                                                @else
                                                <span class="text-info">Running</span>
                                                @endif
                                                </a>
                                            </td>
                                            
                                          </tr>
                                         @endforeach 
                                            </tbody>
                                          </table>
                                         
                                        </div>
                                      </div>


                                      <div class="tab-pane fade" id="account-vertical-document" role="tabpanel" aria-labelledby="account-pill-document" aria-expanded="false">
                                        <!-- multi file upload starts -->
                                        <div class="row">
                                          <div class="card-body">
                                              <div class="col-lg-12 col-12">
                                                <div class="card">
                                                    
                                                    <div class="card-body">

                                                      <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
                                                        <div class="media-body mt-75">

                                                          <input id="filename" required name="filename" rows="3" tabindex="1" data-placeholder="Select here.."
                                                          class="form-control m-b">
                                                          
                                                         
                                                        </select>
                                                        <br>
                                                        <br>
                                                          <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                              <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="image">Upload new document</label>
                                                              <input type="file" required name="image" id="image" hidden>
            
                                                              <input type="hidden" name="selectedid" id="selectedid" value="{{ $agent->agentcode }}">
                                                              <input type="hidden" name="selectedcustomer" id="selectedcustomer" value="{{$agent->agentcode }}">
            
                                                              <button type="submit" class="btn btn-sm btn-outline-warning ml-50">Upload</button>
                                                              <input type="hidden" name="_token" value="{{ Session::token() }}">
                                                          </div>
                                                          </div>
                                                        </form>
            
            
                                                         
                                                            
                                                        
                                                            
            
            
                                                          <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                                                                  size of
                                                                  800kB</small></p>


                                                                  <div class="card">
                                                                   
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                          @foreach($images as $image)
                                                                            <!-- <div class="col-md-4 col-6 user-latest-img">
                                                                              <a href="/uploads/images/{{ $image->filepath }}">  <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-fluid mb-1 rounded-sm" alt="avtar img holder"></a>
                                                                            </div> -->

                                                                            @if($image->mime == 'docx')
                                                                            <div class="col-md-4 col-6 user-latest-img">
                                                                              <a href="/uploads/images/{{ $image->filepath }}">  <img src="{!! '/images/ms_word.png' !!}" class="img-fluid mb-1 rounded-sm" alt="avtar img holder"></a>
                                                                              {{ $image->filename }}  <a href="#" class="img-fluid mb-1 rounded-sm" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"><i class="fa fa-trash"></i></a> 
                                                                            </div>
                                                                            
                                                                              
                                                                                       
                                                                             @elseif($image->mime == 'pdf')
                                                                             <div class="col-md-4 col-6 user-latest-img">
                                                                              <a href="/uploads/images/{{ $image->filepath }}">  <img src="{!! '/images/pdf.png' !!}" class="img-fluid mb-1 rounded-sm" alt="avtar img holder"></a>
                                                                              {{ $image->filename }}  <a href="#" class="img-fluid mb-1 rounded-sm" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"><i class="fa fa-trash"></i></a> 
                                                                            </div>
                                                                             
                                                                              
                                                                             @else 
                                                                              <div class="col-md-4 col-6 user-latest-img">
                                                                              <a href="/uploads/images/{{ $image->filepath }}">  <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-fluid mb-1 rounded-sm" alt="avtar img holder"></a>
                                                                              {{ $image->filename }}  
                                                                              <a href="#" class="img-fluid mb-1 rounded-sm" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                             @endif  

                                                                             
                                                                          @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                      
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                    
                    
                                                </div>
                                            
                                        </div>
                                      <!-- multi file upload ends -->
                                    </div>

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          <!-- account setting page end -->

      </div>
  </div>
</div>
<!-- END: Content-->


@stop




  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
  <script >
    function deactivate(id,name)
      {
    
             
          swal({   
            title: "Are you sure?",   
            text: "Do you want to deactivate "+name+" ?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, deactivate it!",   
            cancelButtonText: "No, cancel !",   
            closeOnConfirm: false,   
            closeOnCancel: false }, 
            function(isConfirm){   
              if (isConfirm) 
              { 
              $.get('/deactivate-agent',
              {
                 "ID": id 
              },
              function(data)
              { 
                
                $.each(data, function (key, value) 
                {
                if(value == "OK")
                {
                  swal("Deactivated!", name +" was successfully deactivated.", "success"); 
                  location.reload(true);
                 }
                else
                { 
                  swal("Cancelled", name +" failed to deactivate.", "error");
                  
                }
               
            });
                                              
              },'json');    
               
                 } 
                 
            else {     
              swal("Cancelled", name +" failed to deactivate.", "error");   
            } });
    
      }
    
    function deleteAgent(id,name)
      {
    
             
          swal({   
            title: "Are you sure?",   
            text: "Do you want to delete "+name+" ?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            cancelButtonText: "No, cancel !",   
            closeOnConfirm: false,   
            closeOnCancel: false }, 
            function(isConfirm){   
              if (isConfirm) 
              { 
              $.get('/delete-agent',
              {
                 "ID": id 
              },
              function(data)
              { 
                
                $.each(data, function (key, value) 
                {
                if(value == "OK")
                {
                  swal("Deleted!", name +" was successfully deleted.", "success"); 
                  location.reload(true);
                 }
                else
                { 
                  swal("Cancelled", name +" failed to delete.", "error");
                  
                }
               
            });
                                              
              },'json');    
               
                 } 
            else {     
              swal("Cancelled", name +" failed to delete.", "error");   
            } });
    
      }
    
      function activate(id,name)
      {
    
            //alert(id,name);
          swal({   
            title: "Are you sure?",   
            text: "Do you want to activate "+name+" ?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, activate it!",   
            cancelButtonText: "No, cancel !",   
            closeOnConfirm: false,   
            closeOnCancel: false }, 
            function(isConfirm){   
              if (isConfirm) 
              { 
              $.get('/activate-agent',
              {
                 "ID": id 
              },
              function(data)
              { 
                
                $.each(data, function (key, value) 
                {
                if(value == "OK")
                {
                  swal("Activated!", name +" was activated successully.", "success"); 
                  location.reload(true);
                 }
                else
                { 
                  swal("Cancelled", name +" failed to activate.", "error");
                  
                }
               
            });
                                              
              },'json');    
               
                 } 
            else {     
              swal("Cancelled", name +" failed to activate.", "error");   
            } });
    
      }
    </script>

