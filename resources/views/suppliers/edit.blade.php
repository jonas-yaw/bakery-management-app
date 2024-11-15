<section id="multiple-column-form">
  <div class="row match-height">
      <div class="col-12">
          <div class="card">
           
              <div class="card-content">
                  <div class="card-body">
                     
                          <div class="form-body">
                              <div class="row">
                                <div class="col-md-6 col-6">
                                  <div class="form-group">
                                      <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" required
                                     data-required="true" value="{{ Request::old('first_name') ?: '' }}"  name="first_name">
                                      
                                  </div>
                              </div>

                              <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="item_name">Last Name</label>
                                  <input type="text" class="form-control" id="last_name" required
                                   data-required="true" value="{{ Request::old('last_name') ?: '' }}"  name="last_name">
                                    
                                </div>
                            </div>

                            <div class="col-md-6 col-6">
                              <div class="form-group">
                                  <label for="item_name">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" required
                                 data-required="true" value="{{ Request::old('mobile_number') ?: '' }}"  name="mobile_number">
                                  
                              </div>
                          </div>

                              

                                 
                              </div>
                          </div>

                          <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                            <input type="hidden" name="key" id="key">
                              <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                          </div>
                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</section> 
                   
