<section id="multiple-column-form">
  <div class="row match-height">
      <div class="col-12">
          <div class="card">
           
              <div class="card-content">
                  <div class="card-body">
                     
                          <div class="form-body">
                              <div class="row">
                                <div class="col-md-6 col-6">
                                  <div class="form-label-group">
                                    <input type="text" class="form-control" id="first_name"
                                    @if (Auth::user()->hasPermission('edit-customer-name'))
                                    @else 
                                    readonly
                                  @endif
                                     data-required="true" value="{{ Request::old('first_name') ?: '' }}"  name="first_name">
                                      <label for="first-name-column">First Name</label>
                                  </div>
                              </div>

                              <div class="col-md-6 col-6">
                                <div class="form-label-group">
                                  <input type="text" class="form-control" id="last_name"
                                  @if (Auth::user()->hasPermission('edit-customer-name'))
                                  @else 
                                  readonly
                                @endif
                                   data-required="true" value="{{ Request::old('last_name') ?: '' }}"  name="last_name">
                                    <label for="first-name-column">Last Name</label>
                                </div>
                            </div>
                                
                                  <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <input type="text" rows="3" class="form-control" id="account_number" readonly="true" name="account_number" value="{{ Request::old('account_number') ?: '' }}">
                                        <label for="city-column">Customer Number</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <select id="account_type" name="account_type" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                                          <option value="">-- Select an account --</option>
                                          @foreach($accounttype as $accounttype)
                                        <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                                          @endforeach
                                        </select>
                                        <label for="country-floating">Customer Type</label>
                                      </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <input type="text" class="input-sm input-s datepicker-input form-control" value="{{ Request::old('dateofbirth') ?: '' }}"   id="date_of_birth" name="date_of_birth" placeholder="dd/mm/YYYY">      
                                          <label for="company-column">Date of Birth</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <select id="gender" name="gender" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                                          <option value=""></option>
                                         @foreach($gender as $gender)
                                       <option value="{{ $gender->type }}">{{ $gender->type }}</option>
                                         @endforeach
                                       </select>     
                                          <label for="email-id-column">Gender</label>
                                      </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                    <div class="form-label-group">
                                      <input type="text" class="form-control" id="field_of_activity" name="field_of_activity" value="{{ Request::old('field_of_activity') ?: '' }}">     
                                        <label for="email-id-column">Occupation / Field of Activity</label>
                                    </div>
                                  </div>


                                <div class="col-md-6 col-12">
                                  <div class="form-label-group">
                                    <input type="text" class="form-control" id="email" name="email" value="{{ Request::old('email') ?: '' }}">      
                                      <label for="email-id-column">Email</label>
                                  </div>
                              </div>

                              <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                  <input type="text" class="form-control" id="mobile_number" data-required="true" name="mobile_number" value="{{ Request::old('mobile_number') ?: '' }}">       
                                    <label for="email-id-column">Mobile Number</label>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                <input type="text" class="form-control" id="id_number" data-required="true" name="id_number" value="{{ Request::old('id_number') ?: '' }}">       
                                  <label for="email-id-column">ID Number</label>
                              </div>
                          </div>

                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                <textarea type="text" rows="3" class="form-control" id="residential_address" name="residential_address" value="{{ Request::old('residential_address') ?: '' }}"></textarea>          
                                  <label for="email-id-column">Residential Address</label>
                              </div>
                          </div>

                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              <textarea type="text" rows="3" class="form-control" data-required="true" id="postal_address" name="postal_address" value="{{ Request::old('postal_address') ?: '' }}"></textarea>       
                                <label for="email-id-column">Postal Address</label>
                            </div>
                        </div>
                       
                        <div class="col-md-6 col-12">
                          <div class="form-label-group">
                            <select id="account_manager" name="account_manager" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                              @foreach($users as $user)
                             <option value="{{  Auth::user()->getNameOrUsername() }}">{{  Auth::user()->getNameOrUsername() }}</option>
                               @endforeach
                             </select>       
                            <label for="email-id-column">Account Manager</label>
                          </div>
                        </div>

                        <div class="col-md-6 col-12">
                          <div class="form-label-group">
                            <select id="sales_channel" name="sales_channel" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                              <option value="">-- Not set --</option>
                           @foreach($sale_channels as $sale_channel)
                         <option value="{{ $sale_channel->channel }}">{{ $sale_channel->channel }}</option>
                           @endforeach 
                         </select>        
                              <label for="email-id-column">Sale Channel</label>
                          </div>
                      </div>
                     

                 
                                 
                              </div>
                          </div>

                          <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                            <input type="hidden" id="account_id" name="account_id" value="{{ Request::old('account_id') ?: '' }}">
                              <button type="submit" class="btn btn-success btn-s-xs">Update Record</button>
                          </div>
                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</section> 
                   
