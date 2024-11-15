@extends('layouts.app')
@section('content')
      <div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div class="content-body">
              <!-- users edit start -->
              <section class="users-edit">
                  <div class="card">
                      <div class="card-content">
                          <div class="card-body">
                              <ul class="nav nav-tabs mb-3" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                          <i class="feather icon-user-check mr-25"></i><span class="d-none d-sm-block">Users</span>
                                      </a>
				  </li>


                                  <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center " id="account-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="true">
                                        <i class="feather icon-user-plus mr-25"></i><span class="d-none d-sm-block">Roles</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link d-flex align-items-center " id="account-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="true">
                                      <i class="feather icon-settings mr-25"></i><span class="d-none d-sm-block">Permission</span>
                                  </a>
                               </li>
                                 
                                  
                                  <form action="/find-user" method="GET">
                                    <div class="col-12">
                                    
                                              <input type="text" class="form-control" id="search" name="search" placeholder="search...">
                                        
                                  </div>
				  </form>
				@permission('add-new-user')
                                <a href="#createUser" data-toggle="modal" class="bootstrap-modal-form-open"> <button class="btn btn-primary mb-2"><i class="feather icon-plus"></i>&nbsp; Add New User</button></a>@endpermission 
                              </ul>

                             
                              <div class="tab-content">
                                  <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                      <!-- users edit media object start -->
                                      <div class="row" id="table-hover-animation">
                                        <div class="col-12">
                                            <div class="card">
                                             
                                                <div class="card-content">
                                                    <div class="card-body">
                                                       
                                                        <div class="table-responsive">
                                                            <table id="investigationsTable" class="table table-striped table-hover mb-0 font-small-3 text-center">
                                                                <thead>
                                                                    <tr>
                                                                      <th scope="col">User</th>
                                                                      <th scope="col">Phone</th>
                                                                      <th scope="col">Location</th>
								      <th scope="col">Role</th>
								      <th scope="col">Status</th>
                                                                      <th scope="col">Date</th>
                                                                      <th scope="col"></th>
                                                                      <th scope="col"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($users as $user)
                                                                  <tr>
                                                                    <td>{{ $user->fullname }}</td>
                                                                    <td>{{ $user->phone_number }}</td>
                                                                    <td>{{ $user->location }}</td>
                                                                    <td>{{ $user->usertype }}</td>
								   <td>{{ $user->status }}</td>
								    <td>{{ $user->created_at }}</td>
                                                                    <td>@permission('edit-user')<a href="/edit-user/{{ Crypt::encrypt($user->id) }}" alt="edit"><i class="fa fa-pencil"></i></a></td>@endpermission
                                                                    <td>@permission('delete-user')<a onclick="deleteUser('{{ $user->id }}','{{ $user->fullname }}')" ><i class="fa fa-trash"></i></a></td>@endpermission
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
                                    <div class="row">
                                      <div class="col-sm-12 col-md-5">
                                      <div> Record(s) Found : {{ $users->total() }} {{ Str::plural('User', $users->total()) }}</div>
                                    </div>
                                      <div class="col-sm-12 col-md-7">
                                        {!!$users->render()!!}
                                      </div>
                                        </div>
                                      <!-- users edit media object ends -->
                                      <!-- users edit account form start -->
                                      
				  </div>



                                  <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                      <!-- users edit Info form start -->
                                      <div class="row" id="table-hover-animation">
                                        <div class="col-12">
                                            <div class="card">
                                             
                                              <div class="alert alert-primary mt-1 p-1">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                  @role(['System Admin'])
                                                  <a href="#merge-debit" data-toggle="modal" class="bootstrap-modal-form-open"> <button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i></button></a>
                                                  @endrole
                                               
                                                </div>
                                              </div>
                                                <div class="card-content">
                                                    <div class="card-body">



                                                      <section id="multiple-column-form">
                                                        <div class="row match-height">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                 
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                           
                                                                                <div class="form-body" id="paymentform" name='paymentform'>
                                                                                    <div class="row">
                                                      
                                                                                    
                                                      
                                                                                        <div class="col-md-6 col-12">
                                                                                          <div class="form-label-group">
                                                                                            <input type="text" rows="3" class="form-control" placeholder="Permission Name"  id="permission_name" name="permission_name" value="{{ Request::old('permission_name') ?: '' }}">         
                                                                                              <label for="email-id-column">Permission</label>
                                                                                          </div>
                                                                                        </div>
                                                      
                                                      
                                                      
                                                                                      <div class="col-md-6 col-12">
                                                                                        <div class="form-label-group">
                                                                                          <input type="text" placeholder="Description" rows="3" class="form-control" required="true" id="permission_description" name="permission_description" value="{{ Request::old('permission_description') ?: '' }}">      
                                                                                            <label for="email-id-column">Description</label>
                                                                                        </div>
                                                                                    </div>
                                                      
                                                      
                                                                                  
                                                                                 
                                                                                    </div>
                                                                                </div>
                                                      
                                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                                 
                                                                                  @role(['System Admin'])
                                                                                  <button type="button" onclick="addPermission()" class="btn btn-success btn-s-xs">Save</button>
                                                                                  @endrole
                                                                                 
                                                                                </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      </section> 


                                                    
                                                     
                                                       
                                                        <div class="table-responsive">
                                                          
                                                           
                                                              <table id="permissionTable" class="table dataex-html5-selectors table-hover-animation table-striped mb-0 font-small-2 text-center">
                                                                <thead>
                                                                  <tr>
                                                                      <th>Permission</th>
                                                                      <th>Description</th>
                                                                      <th></th>
                                                                      <th></th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($permissions as $permission)
                                                                  <tr>
                                                                  <td>{{ $permission->name }}</td>
                                                                  <td>{{ $permission->description }}</td>
                                                                  <td><a href="edit-permission/{{ $permission->id }}"> <i class="fa fa-pencil"></i></a> </td>
                                                                  <td><a onclick="deletePermission('{{ $permission->id }}','{{ $permission->name }}')" ><i class="fa fa-trash"></i></a></td>
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
                                      <!-- users edit Info form ends -->
                                  </div>
                                  <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                      <!-- users edit socail form start -->
                                      <div class="row" id="table-hover-animation">
                                        <div class="col-12">
                                            <div class="card">
                                             
                                              <div class="alert alert-primary mt-1 p-1">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                  @permission('add-new-role')
                                                  <a href="/create-role"><button class="btn btn-sm btn-primary rounded pull-left"><i class="feather icon-plus"></i>Add New Role </button></a>
                                                  @endpermission
                                               
                                                </div>
                                              </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                              <table id="roleTable" class="table dataex-html5-selectors table-hover-animation table-striped mb-0 font-small-2 text-center">
                                                                <thead>
                                                                  <tr>
                                                                      <th>Id</th>
                                                                      <th>Role</th>
                                                                      <th>Description</th>
                                                                      <th></th>
                                                                      <th></th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($roles as $role)
                                                                  <tr>
                                                                  <td>{{ $role->id }}</td>
                                                                  <td>{{ $role->name }}</td>
                                                                  <td>{{ $role->description }}</td>
                                                                  <td>@permission('edit-role')<a href="edit-role/{{ $role->id }}"> <i class="fa fa-pencil"></i></a>@endpermission </td>
                                                                  <td>@permission('delete-role')<a onclick="deleteRole('{{ $role->id }}','{{ $role->name }}')" ><i class="fa fa-trash"></i></a>@endpermission</td>
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

                                      <!-- users edit socail form ends -->
                                  </div>

                              
                                  </div>
                                    <!-- users edit socail form ends -->
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

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>
  
    <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form  class="bootstrap-modal-form" method="post" action="{{ route('auth.signup') }}" class="panel-body wrapper-lg">
                @include('auth/create-user')
                <input type="hidden" name="_token" value="{{ Session::token() }}">
           </form>
            </div>
           
        </div>
    </div>
  </div>




  <div class="modal fade" id="generateTokenModal" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Token</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                         
                            <div class="card-content">
                                <div class="card-body">
                                   
                                        <div class="form-body">
                                         


              <form  class="bootstrap-modal-form" method="post" action="/generate-api-token" class="panel-body wrapper-lg">
                @csrf

               <div class="row">
                <div class="col-md-12 col-12">
                  <div class="form-label">
                    <label for="email">Username</label>
                    <input type="text" rows="3" class="form-control" id="username" name="username" value="{{ Request::old('username') ?: '' }}">       
                  </div>
              </div>

              

              <div style="margin-top: 3%;" class="col-md-12 col-12">
                <div class="form-label">
                  <label for="password">Password</label>
                  <input type="password" rows="3" class="form-control" id="password" name="password" value="{{ Request::old('password') ?: '' }}">       
                </div>
              </div>

               </div>
               <br>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit"  class="btn btn-success btn-s-xs pull-right">Generate</button>
                <br>
           </form>

         
        </div>
    </div>
   </div>
  </div>
</section> 
            </div>
           
        </div>
    </div>
  </div>



  @stop







<script src="{{ asset('/event_components/jquery.min.js')}}"></script>



  
<script>

function deleteUser(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from system?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-user',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", "User was removed from system.", "success"); 
               location.reload();
             }
            else
            { 
              swal("Cancelled","User to be removed from system.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to be removed from system.", "error");   
        } });

   }


   function deleteRole(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from system?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-role',
          {
             "ID": id 
          },
          function(data)
          { 
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal({
                  title: "Deleted!",
                  text: "Role was removed from system.",
                  type: "success"
              },
              function() {
                  window.location.reload();
              }
              );
             }
            else
            { 
              swal("Cancelled","Failed to be removed from system.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to be removed from system.", "error");   
        } });

   }


</script>
