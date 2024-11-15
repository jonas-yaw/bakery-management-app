<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
             
                <div class="card-content">
                    <div class="card-body">
                       
                            <div class="form-body">
                                <div class="form-label-group">
                                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Name" required>
                                    <label for="inputName">Name</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone" required>
                                    <label for="phone">Phone</label>
                                </div>

                                <div class="form-label-group">
                                  <label for="inputName">Location</label>
                                  <select id="location" name="location" required rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                                      @foreach($branches as $branch)
                                      <option value="{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
                                      @endforeach
                                      </select>
                                  
                              </div>

                               <div class="form-label-group">
                                  <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                                  <label for="inputName">Username</label>
                              </div>
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                    <label for="inputPassword">Password</label>
                                </div>
                                <div class="form-label-group">
                                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                  <label for="inputConfPassword">Confirm Password</label>
                              </div>


                                <div class="form-label-group">
                                  <select id="usertype" name="usertype" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control input-lg">
                                    @foreach($roles as $role)
                                     <option value="{{ $role->name }}">{{ $role->name }}</option>
                                     @endforeach
                                   </select>
                                  <label for="inputPassword">Role</label>
                              </div>


                              <input type="hidden" name="_token" value="{{ Session::token() }}">
  
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                              <input type="hidden" id="account_id" name="account_id" value="{{ Request::old('account_id') ?: '' }}">
                                <button type="submit" class="btn btn-success btn-s-xs">Create</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section> 
