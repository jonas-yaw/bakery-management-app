
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
                      <h2 class="content-header-title float-left mb-0">Register</h2>
                      <div class="breadcrumb-wrapper col-12">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                              </li>
                              <li class="breadcrumb-item"><a href="#">Forms</a>
                              </li>
                              <li class="breadcrumb-item active"> New Customer <img src="/images/4149883.png" width="30px" height="30px">
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
  <!-- Form wizard with step validation section start -->
  <section id="validation">
      <div class="row">
          <div class="col-12">
              <div class="card">
                 
                  <div class="card-content">
                      <div class="card-body">
                          <form action="#"  class="steps-validation wizard-circle">
                              <!-- Step 1 -->
                              <h6><i class="step-icon feather icon-home"></i> Personal </h6>
                              <fieldset>


                                
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="location">
                                              Account Type <sup class="text-danger font-medium-1"> * </sup>
                                          </label>
                                          <select class="custom-select form-control required" onchange="notbusiness();" id="account_type" name="account_type">
                                             <option value=""> -- Select Account Type -- </option>
                                                @foreach($accounttype as $accounttype)
                                                 <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                                                @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <br>

                              <div id="individualname">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="firstName">
                                                  First Name <sup class="text-danger font-medium-1"> * </sup>
                                              </label>
					      <input type="text"
                            onchange="checkCustomerExisitingStatus();"
                            class="form-control block-mask text-uppercase" minlength="2" required id="firstName" name="firstName">            
                                          </div>
                                      </div>

                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="lastName">
                                                  Last Name <sup class="text-danger font-medium-1"> * </sup>
                                              </label>
					      <input type="text"
	onchange="checkCustomerExisitingStatus();"
 class="form-control block-mask text-uppercase" minlength="2" required id="lastName" name="lastName">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName">
                                                Other Name(s)
                                            </label>
					    <input type="text"
	onchange="checkCustomerExisitingStatus();"
 class="form-control block-mask text-uppercase" minlength="2" maxlength="50" data-validation-required-message="Enter a valid name, no abbreviations!" id="otherName" name="otherName">
                                        </div>
                                    </div>
                                  </div>
                                 
                                  <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender">
                                                Title <sup class="text-danger font-medium-1"> * </sup>
                                            </label>
                                            <select class="custom-select form-control" required  id="title" name="title">
                                                <option value=""> -- Select Title -- </option>
                                                   @foreach($titles as $title)
                                                  <option value="{{ $title->type }}">{{ $title->type }}</option>
                                                  @endforeach
                                            </select>
                                        </div>
                                    </div>

                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="date_of_birth">
                                                  Date Of Birth
                                              </label>
                                              <input type="text" class="form-control" id="date_of_birth" name="date_of_birth">
                                          </div>
                                      </div>

                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="gender">
                                                  Gender <sup class="text-danger font-medium-1"> * </sup>
                                              </label>
                                              <select class="custom-select form-control required"  id="gender" name="gender">
                                                  <option value=""></option>
                                                  <option value="Male">Male</option>
                                                  <option value="Female">Female</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  </div>

                                  <div id="businessname">
                                  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="firstName">
                                                Name <sup class="text-danger font-medium-1"> * </sup>
                                            </label>
					    <input type="text"
	onchange="checkCustomerExisitingStatus();"
 class="form-control block-mask text-uppercase" minlength="5" required id="companyname" name="companyname">
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div id="jointname">
                                    <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="firstName">
                                                  Full name : 1st Insured <sup class="text-danger font-medium-1"> * </sup>
                                              </label>
					      <input type="text"
	onchange="checkCustomerExisitingStatus();"
 class="form-control block-mask text-uppercase" required id="first_insured" name="first_insured">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="firstName">
                                                Full name : 2nd Insured <sup class="text-danger font-medium-1"> * </sup>
                                            </label>
					    <input type="text"
	onchange="checkCustomerExisitingStatus();"
 class="form-control block-mask text-uppercase" required id="second_insured" name="second_insured">
                                        </div>
                                    </div>
                                  </div>
                                  </div>
  

                                <br>


                                  <div id="hideifwalkin">
                                    <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="occupation" id="occupation_label" name="occupation_label">
                                                  Occupation / Field of Activity 
					      </label>
						<sup class="text-danger font-medium-1"> * </sup>
                                              <select class="custom-select2 form-control required"  id="field_of_activity" name="field_of_activity">
                                                <option value=""> -- Select -- </option>
                                                   @foreach($professions as $profession)
                                                  <option value="{{ $profession->type }}">{{ $profession->type }}</option>
                                                  @endforeach
                                          </select>
                                             
                                          </div>
                                      </div>
                                  </div>
                                  </div>
                              </fieldset>

                              <!-- Step 2 -->
                              <h6><i class="step-icon feather icon-briefcase"></i> Contacts</h6>
                              <fieldset>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">

                                            <div class="row">
                                            <div class="col-md-6">
                                              <label for="mobile_number">
                                                  Mobile Number <sup class="text-danger font-medium-1"> * </sup>
                                              </label>
					      <input type="number" class="form-control required"
	onchange="checkCustomerExisitingStatus();"
 minlength="10" maxlength="10" data-validation-regex-regex="([^a-z]*[A-Z]*)*" data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" data-validation-required-message="Enter a valid mobile number" id="mobile_number" name="mobile_number">
                                             </div>

                                              <div class="col-md-6">
                                                <label for="mobile_number">
                                                   Alternative Mobile Number
                                                </label>
                                                <input type="number" class="form-control" minlength="10" maxlength="10" data-validation-regex-regex="([^a-z]*[A-Z]*)*" data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" data-validation-required-message="Enter a valid mobile number" id="mobile_number_2" name="mobile_number_2">
                                                </div>
                                            </div>
                                         
                                            </div>
                                          <div class="form-group">
                                              <label for="email">
                                                  Email
                                              </label>
                                              <input type="email" class="form-control" id="email" data-validation-required-message="Must be a valid email" name="email">
                                          </div>
                                      </div>
                                      
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="residential_address" id="residential_address_label" id="residential_address_label">Residential Address <sup class="text-danger font-medium-1"> * </sup>  </label>
                                              <textarea name="residential_address" id="residential_address" rows="4" class="form-control required block-mask text-uppercase"></textarea>
                                          </div>
                                      </div>
                                  </div>


                                  <div id="hideemergencycontacts">
                                            <div class="progress progress-bar-warning">
                                              <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100" style="width:100%"></div>
                                            </div>


                                          <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kin_name">
                                                        Digital Address
                                                    </label>
                                                    <input type="text" class="form-control" id="digital_address_code" name="digital_address_code">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="civil_status">
                                                        ID Type 
                                                    </label>
                                                    <select class="custom-select form-control"   id="id_type" name="id_type">
                                                          <option value=""> -- Select ID Type -- </option>
                                         
							  
                     				     @foreach($identificationtypes as $identificationtype)
                                                          <option value="{{ $identificationtype->type }}">{{ $identificationtype->type }}</option>
                                                        @endforeach   
                                       
                                      
                                     
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                  <label for="occupation">
                                                      ID Number 
                                                  </label>
                                                  <input type="text" class="form-control " id="id_number" name="id_number">
                                              </div>
                                          </div>
                                        </div>
                                  </div>



                              </fieldset>




                              <!-- Step 3 -->
                              <h6><i class="step-icon feather icon-image"></i> Communication Channels</h6>
                              <fieldset>
                                <div id="insurancepane">
                               



                                <div class="row">
                                   

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="insurance_eligibility">Sales Channel</label>
                                            <select class="custom-select form-control" id="sales_channel" name="sales_channel">
                                                <option value="">-- Not set --</option>
                                          
                                          	@foreach($sale_channels as $sale_channel)
                                                    <option value="{{ $sale_channel->channel }}">{{ $sale_channel->channel }}</option>
                                                @endforeach 
                                            
                                             
                             
                                              
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group d-flex align-items-center pt-md-2">
                                            <label class="mr-2">Communication Channel :</label>


                                            <div class="c-inputs-stacked">
                                                <div class="d-inline-block mr-2">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" value="SMS" name="communication_channel[]">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">SMS</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-inline-block mr-2">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" value="Whatsapp" name="communication_channel[]">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Whatsapp</span>
                                                    </div>
                                                </div>
                                                <div class="d-inline-block mr-2">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" value="Email" name="communication_channel[]">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Email</span>
                                                    </div>
                                                </div>
                                                <div class="d-inline-block">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" value="Calls" name="communication_channel[]">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Calls</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                  
                                  </div>
                            </fieldset>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Form wizard with step validation section end -->

</div>
</div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


                        

         @stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(document).ready(function () {
   
     $('#field_of_activity').select2({
      tags: true
      });

     $('#account_manager').select2({
      tags: true
      });

      $('#startform').hide();
     $('#individualname').show();
     $('#businessname').hide();
     $('#individualid').hide();
     $('#jointname').hide();
   
     
  });
</script>




<script type="text/javascript">
$(function () {
  $('#date_of_birth').daterangepicker({
     "minDate": moment('1930-06-14'),
            "maxDate": moment().subtract(18, 'years'),
      "startDate":  moment().subtract(18, 'years'),
      "singleDatePicker":true,
      "autoApply": true,
      "showDropdowns": true,
      "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });


  $('#date_of_birth').val('')

    $('#date_of_birth').on('apply.daterangepicker', function(ev, picker) {
    // Update the input field value when a date is selected
    $(this).val(picker.startDate.format('DD/MM/YYYY'));
    });

    // Listen for the cancel.daterangepicker event
    $('#date_of_birth').on('cancel.daterangepicker', function(ev, picker) {
    // Reset the input field value when the user cancels without selecting a date
    $(this).val('');
    });
});


function notbusiness()
{
  if($('#account_type').val() == "Corporate")
   {
      $('#businessname').show();
      $('#individualname').hide();
      $('#jointname').hide();
      $('#individualid').hide();
      $('#hideemergencycontacts').hide();
      $('#businesslabel').val('Business Name');
      $('#occupation_label').text('Field Of Activity');
      
      

       $('#firstname').val('');
       $('#surname').val('');
       $('#lastname').val('');



       $('#firstname').val('NA');
       $('#surname').val('NA');
       $('#lastname').val('NA');
       $('#companyname').val('');
   }

   else if($('#account_type').val() == "Joint")
   {
    $('#jointname').show();
     $('#businessname').hide();
      $('#individualname').hide();
      $('#individualid').hide();
      $('#hideemergencycontacts').show();
      $('#businesslabel').val('Joint Name');
      $('#occupation_label').text('Occupation');
      

       $('#firstname').val('');
       $('#surname').val('');
       $('#lastname').val('');



       $('#firstname').val('NA');
       $('#surname').val('NA');
       $('#lastname').val('NA');
       $('#companyname').val('');
   }

   else if($('#account_type').val() == "Individual")
   {
      $('#businessname').hide();
      $('#jointname').hide();
      $('#individualname').show();
      $('#individualid').show();
      $('#hideemergencycontacts').show();
      $('#occupation_label').text('Occupation');

      $('#firstname').val('');
       $('#surname').val('');
       $('#lastname').val('');
      $('#companyname').val('');
      $('#companyname').val('NA');
   }

   else
   {
     $('#businessname').hide();
     $('#jointname').hide();
      $('#individualname').show();
      $('#individualid').show();
      $('#hideemergencycontacts').show();

      $('#companyname').val('');
      $('#companyname').val('NA');
   }

}

</script>



<script type="text/javascript">

function checkCustomerExisitingStatus(){
    var selectedaccount = $('#account_type').val();
    var formValidator = false;

    if(selectedaccount === ""){
        formValidator = false;
    } 
    else if((selectedaccount == 'Individual' || $('#firstName').val() === "" || $('#lastName').val() === "" || $('#mobile_number').val() === "") && (selectedaccount == 'Joint' || $('#first_insured').val() === " " || $('#second_insured').val() === " " || $('#mobile_number').val() === "") && ($('#companyname').val() === " " || $('#mobile_number').val() === ""))
    {
        formValidator = false;
    } else{
        formValidator = true;
    }

      if(formValidator){
            $.get('/get-customer-exist',
            {
            "firstName"                  :$('#firstName').val(),
            "lastName"                   :$('#lastName').val(),
            "otherName"                  :$('#otherName').val(),
            "first_insured"              :$('#first_insured').val(),
            "second_insured"              :$('#second_insured').val(),
            "companyname"                 :$('#companyname').val(),
            "account_type"               :$('#account_type').val(),
            "mobile_number"              :$('#mobile_number').val()
            },
            function(data)
            { 
            
            $.each(data, function (key, value) {

            if(data["status"] == "Duplicate")
            {
                swal(`Customer - ${data["fullname"]} - ${data["account_number"]} \nwith the same details exist!`)  
            }
        });
                                            
            },'json');
      }else{
        //console.log('data incomplete');
      }


}



function addCustomer()
{
    $.get('/create-customer',
        {
          "firstName"                  :$('#firstName').val(),
          "lastName"                   :$('#lastName').val(),
	  "otherName"                  :$('#otherName').val(),
	  "title"                      :$('#title').val(),
          "account_type"               :$('#account_type').val(),
          "companyname"                :$('#companyname').val(),
          "first_insured"              :$('#first_insured').val(),
          "second_insured"             :$('#second_insured').val(),
          "residential_address"        :$('#residential_address').val(),
          "email"                      :$('#email').val(),
          "mobile_number"              :$('#mobile_number').val(),
          "mobile_number_2"              :$('#mobile_number_2').val(),
          "date_of_birth"              :$('#date_of_birth').val(),
          "field_of_activity"          :$('#field_of_activity').val(),
          "place_of_birth"             :$('#place_of_birth').val(),
          "gender"                     :$('#gender').val(),
          "insurance_company"          :$('#insurance_company').val(),
          "company"                    :$('#company').val(),
          "nationality"                :$('#nationality').val(),
          "insurance_id"               :$('#insurance_id').val(),
          "civil_status"               :$('#civil_status').val(),

          "id_type"                    :$('#id_type').val(),
	 "id_number"                  :$('#id_number').val(),
	  "kin_name"                   :$('#kin_name').val(),    
          "kin_phone"                  :$('#kin_phone').val(),    
          "kin_relationship"           :$('#kin_relationship').val(),
          "insurance_cover"            :$('#insurance_cover').val(),    
          "insurance_eligibility"      :$('#insurance_eligibility').val(),
          "parent_id"                  :$('#parent_id').val(),    
          "link_type"                  :$('#link_type').val(),
	  "expiry_date"                :$('#expiry_date').val(),
	  "sales_channel"              :$('#sales_channel').val(),
          "communication_channel"      : $("input[name='communication_channel[]']:checked")
              .map(function(){return $(this).val();}).get()


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Customer successfully saved!");
          window.location = "/create-reservation/"+data["ReferenceNumber"];
        
        }
        else if(data["Duplicate"])
        {
            swal("Customer with same details exist!")
        
        }
        else
        {
           
          toastr.error("Customer failed to save!");
          
        }
      });
                                        
        },'json');
  
 
}
</script>


