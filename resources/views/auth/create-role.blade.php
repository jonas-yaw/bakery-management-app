@extends('layouts.app')
@section('content')
         <!-- BEGIN: Content-->
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
          <div class="content-header row">
          </div>

  <!-- END: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  <div>

    <form @if($state == 'Edit') action="/update-role/{{ $role->id }}" @else action="/create-new-role" @endif method="post" id="paymentform" name='paymentform'>
        @csrf
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                 
                    <div class="card-content">
                        <div class="card-body">
                           
                                <div class="form-body" >
                                    <div class="row">
      
                                    
      
                                        <div class="col-md-6 col-6">
                                          <div class="form-label-group">
                                            <input required type="text" rows="3" class="form-control" placeholder="Role Name"  id="role_name" name="role_name" 
                                            @if($state == 'Edit')
                                            value="{{ $role->name }}"
                                            @else 
                                            value=""
                                            @endif 
                                            >         
                                              <label for="email-id-column">Role</label>
                                          </div>
                                        </div>
      
      
      
      
      
                                  
                                 
                                    </div>
                                </div>



                                <section id="accordion-with-margin">
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <div class="card collapse-icon accordion-icon-rotate">
                                            
                                              <div class="card-body">
                                                 
                                                  <div class="accordion" id="accordionAccident" data-toggle-hover="true">
                                                      <div class="collapse-margin">
                                                          <div class="card-header collapsed" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOneAccident" aria-expanded="false" aria-controls="collapseOneEngineering">
                                                              <span class="lead collapse-title font-small-3">
                                                                  <code>Underwriting / Claims Limits </code>
                                                              </span>
                                                          </div>
              
                                                          <div id="collapseOneAccident" class="collapse" aria-labelledby="headingOne" data-parent="#accordionAccident">
                                                              <div class="card-body">
                                                                <form novalidate>
                                                                  <div class="row">
                                                                     
                                                                      <div class="col-6">
                                                                          <div class="form-group">
                                                                              <div class="controls">
                                                                                  <label for="account-new-password">Scope</label>
                                                                                  <input type="text" name="password" id="limit_scope" required name="limit_scope" class="form-control" placeholder="Scope">
                                                                                  <input type="hidden" name="limitkey" id="limitkey" value="">
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-6">
                                                                          <div class="form-group">
                                                                              <div class="controls">
                                                                                  <label for="account-new-password">Limit</label>
                                                                                  <input type="text" name="password" id="limit" required name="limit" class="form-control" placeholder="Limit">
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                     
                                                                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                          <a onclick="addLimit()" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">+
                                                                              Add Limit</a>
                                                                          
                                                                      </div>
                                                                  </div>
                                                              </form>

                                                              <div class="alert alert-primary mt-1 p-1">
                                              
                                                              </div>
                
                
                                                            <div class="table-responsive">
                                                                          
                                                                           
                                                                <table id="LimitTable" class="table table-hover-animation table-striped mb-0 font-small-2 text-center">
                                                                  <thead>
                                                                    <tr>
                                                                       
                                                                        <th>Scope</th>
                                                                        <th>Limit</th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        
                                                                    </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                    
                                                                  </tbody>
                                                                </table>
                                                             
                                                          </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="collapse-margin">
                                                          <div class="card-header" id="headingTwo" data-toggle="collapse" role="button" data-target="#collapseTwoAccident" aria-expanded="false" aria-controls="collapseTwoEngineering">
                                                              <span class="lead collapse-title font-small-3">
                                                                <code> Permissions </code>
                                                              </span>
                                                          </div>
                                                          <div id="collapseTwoAccident" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionAccident">
                                                              <div class="card-body">
                                                                
                                                                <button type="button" name="select-all" id="select-all">Select All </button>

                                                                <div class="permissions row" style="align-items: flex-start">
                                
                                                                    @foreach ($permissionsGroup as $keys => $permission)
                                                                    <div class="permission-wrapper col-3" style="margin-bottom: 7%;">
                                                                    <div class="permission-heading"><strong> {{ $permission[0]->description }}</strong></div>
                                                                    <br>
                                
                                                                    <div class="permission-list">
                                                                        @foreach($permission as $item )
                                                                        <div>
                                                                            <input type="checkbox" name="permissions[]"  value="{{$item->id}}"  
                                                                            @if($state == 'Edit')
                                                                            @if($role->permissions->contains($item->id)) checked=checked @endif
                                                                            @else
                                                                            @endif
                                                                            >
                                                                            <span>{{$item->name}}</span>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                
                                
                                                                   
                                
                                                                    @endforeach
                                                                </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                     
                                                     
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </section>


                               
      
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                 
                                  @permission('edit-role')
                                  <button type="submit" onclick="addRole()"  class="btn btn-success btn-s-xs">Save</button>
                                  @endpermission
                                 
                                </div>
                            
                        </div>
                    </div>





                </div>
            </div>
        </div>
      </section> 
    </form>
</div>




@stop

<script src="{{ asset('/event_components/jquery.min.js') }}"></script>
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script src="{{ asset('/js/tinymce/tinymce.min.js')}}"></script>
 


<script type="text/javascript">
    $(document).ready(function () {
    
        //alert('Hello');
        $('#template_reference').select2();
        loadLimits();
        $('#limit').number( true, 2 );

      });
    </script>


<script type="text/javascript">

function thousands_separators(num)
  {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
  }

function loadLimits()
   {
         
        //alert($('#role_name').val());

        $.get('/get-role-limits',
          {
            role : $('#role_name').val(),
          },
          function(data)
          { 

            $('#LimitTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#LimitTable tbody').append('<tr><td>'+ value['product'] +'</td><td>'+  thousands_separators(value['sum_insured']) +'</td><td><a a href="#"><i onclick="editLimit('+value['id']+')" class="fa fa-pencil"></i></a></td><td><a a href="#"><i onclick="removeLimit('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


    function editLimit(id) {

     

$.get("/edit-limit-detail", {
  "id": id
},
  function (json) {
   // alert(json.limit);

    $('#limitkey').val(json.limitkey);
    $('#limit_scope').val(json.scope);
    $('#limit').val(json.limit);
    
  }, 'json').fail(function (msg) {
    alert(msg.status + " " + msg.statusText);
  });

}

function addLimit()
{

/* if($('#limit_scope').val()=="")
  {document.getElementById('limit_scope').focus(); swal("Enter scope eg. Motor Insurance / Own Damage ",'Fill all fields', "error");}

else */ 
if($('#limit').val()==0)
  {document.getElementById('limit').focus(); swal("Please enter limit amount  ",'Fill all fields', "error");}

  else
  {

    
    $.get('/add-role-limit',
        {
          "limitkey"    :$('#limitkey').val(),
          "level"       :$('#role_name').val(),
          "limit_scope" :$('#limit_scope').val(),
          "limit"       :$('#limit').val(),   
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {          
        
        loadLimits();
 
        $('#limit_scope').val('');
        $('#limit').val(0);
        $('#limitkey').val(0);

        
        }
        else
        {
          swal("Limit failed to add!");
        }
      });
                                        
        },'json');
  }
  
}

function addRole(){
	$('#limit_scope').prop('required',false);
	$('#limit').prop('required',false);
}

function removeLimit(id)
   {

  swal({
  title: "Enter your password to delete item!",
  text: "Are you sure you want to delete item ?",
  type: "input",
  inputType : "password",
  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Please enter your password"
},
function(inputValue){
  if (inputValue === false) return false;

  if (inputValue === "") {
    swal.showInputError("Please enter your password!");
    return false
  }

//alert($('#cover_type').val());
  $.get('/delete-limit',
          {
             "ID": id, 
             "mypassword": inputValue
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              loadLimits();
             swal.close();
             }
            else
            { 
              swal("Cancelled","failed to delete. Password verification failed", "error");
            }
            });
                                          
          },'json');  

    


});
}

    </script>

<script type="text/javascript">  
  $(document).ready(function() {
    $('#select-all').click(function() {
        var checked = this.checked;
        $('input[type="checkbox"]').each(function() {
        this.checked = checked;
    });
    })
});
</script>  



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


</script>


<style>
    .permissions{
       padding: 3%;
    }
    .permission-wrapper{
        margin-bottom: 2%;
        width: 20%;
    }
 
    .permission-heading{
        font-size: 22px;
        color: black;
    }

    .permission-list{
        display: column;
        flex-flow: column-reverse;
        flex-grow: 1;
        flex-wrap: wrap;
        font-size: 18px;
        align-items: center;
        color: black;
        
    }

    .permission-list div{
        padding-top: 2%;
        padding-bottom: 2%;
    }


    .permission-list div{
        margin-right: 2%;
    }
</style>

