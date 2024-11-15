@extends('layouts.app')
@section('content')

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
			    <div class="card-body">

				@if(Auth::user()->created_at == Auth::user()->updated_at)		
				<p class="h4 text-danger"> <strong> Please change/reset password. A system default password is being used. <a href="/password/reset"</a> .</strong> </p> 
				 @else
               			 @endif
				<ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">Account</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->
                                        <div class="media mb-2">
                                            <a class="mr-2 my-25" href="#">
                                                <img src="/images/2102633.png" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90">
                                            </a>
                                            <div class="media-body mt-50">
                                                <h4 class="media-heading">{{ $user->fullname }}</h4>
                                                <div class="col-12 d-flex mt-1 px-0">
                                                    <a href="#" class="btn btn-primary d-none d-sm-block mr-75">Change</a>
                                                    <a href="#" class="btn btn-primary d-block d-sm-none mr-75"><i class="feather icon-edit-1"></i></a>
                                                    <a href="#" class="btn btn-outline-danger d-none d-sm-block">Remove</a>
                                                    <a href="#" class="btn btn-outline-danger d-block d-sm-none"><i class="feather icon-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form novalidate method="post" action="/update-user">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Username</label>
                                                            <input type="text" class="form-control" @permission('change-username')  @else readonly @endpermission name="username" id="username" placeholder="Username" value="{{ $user->username }}" required data-validation-required-message="This username field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" @permission('change-fullname') @else readonly @endpermission  name="fullname" id="fullname" placeholder="Name" value="{{ $user->fullname }}" required data-validation-required-message="This name field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Phone</label>
                                                            <input type="email" class="form-control" @permission('change-email') @else readonly @endpermission name="phone_number" id="phone_number" placeholder="Phone" value="{{ $user->phone_number }}" required data-validation-required-message="This email field is required">
                                                        </div>
                                                    </div>




                                                    @if (Auth::user()->getRole() == 'System Admin')
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Password</label>
                                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
                                                        </div>
                                                    </div>
                                                    @endif 

                                                   

                                                </div>
                                                <div class="col-12 col-sm-6">

                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="form-control" name="status"
                                                        @permission('activate-deactivate-user')
                                                        @else 
                                                        disabled 
                                                        @endpermission
                                                        >
							    @permission('activate-deactivate-user')
							    @foreach($status as $item)
                                    <option 
                                    @if ($user->status ==  $item->type)
                                        selected 
                                    @endif 
                                    value="{{ $item->type }}">{{ $item->type }}</option>
                                   @endforeach 
							    @endpermission
                                                        </select>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select class="form-control" name="usertype" id="usertype" 
                                                        @permission('assign-user-permission')
                                                        @else 
                                                        disabled
                                                        @endpermission>
                                                            <option value="{{ $user->usertype }}">{{ $user->usertype }}</option>
							   @permission('assign-user-permission')
							    @foreach($roles as $role)
                                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
							    @endforeach
							   @endpermission
                                                        </select>
                                                    </div>

                                                     
                                                    
                                                        
                                                        
                                                            
                                                           
                                                       
                                                    
                                                    
                                                  
                                                    <div class="form-group">
                                                        <label>Branch</label>
                                                        <select class="form-control" name="location" id="location" 
                                                        @permission('change-branch')
                                                        @else 
                                                        disabled
                                                        @endpermission>
                                    
                                                        @foreach($branches as $branch)
                                                            <option 
                                                            @if ($user->location == $branch->branch_name)
                                                                selected 
                                                            @endif
                                                            value="{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
                                                        @endforeach
                                                       
                                                    </select>
                                                    </div>



                                                    
                            @if (Auth::user()->getRole() == 'System Admin')
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Password Confirmation</label>
                                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password" value="">
                                                        </div>
                                                    </div>
                                                    @endif 

                                                </div>


                                                @if($user->signature)
                                                <div class="col-12 col-sm-6">
                                                    <label>Signature</label>
                                                    <div class="form-group signature-edit-div">
                                                        
                                                        <img src="/images/{{$user->signature}}" alt="users avatar" width="50%">
                                                    </div>
                                                </div>
                                                @endif
                                               


                                                @permission('edit-user')
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                                                        Changes</button>

                                                     <input type="hidden" name="userid" id="userid" value="{{ $user->id }}">
                                                     <input type="hidden" name="_token" value="{{ Session::token() }}">
                                                    <button type="reset" class="btn btn-outline-warning">Reset</button>
                                                </div>
                                                @endpermission
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
               
     
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>

    <!-- END: Content-->
    @stop

    <style>
        .signature-edit-div{
            border: 1px solid rgba(34, 41, 47, 0.125);
            border-radius: 10px;
            margin-top: 2%;
        }
    </style>
