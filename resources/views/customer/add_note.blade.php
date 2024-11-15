<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
             
                <div class="card-content">
                    <div class="card-body">
                       
                            <div class="form-body">
                                <div class="row">
                              
  
  
                              <div class="col-md-12 col-12">
                                <div class="form-label-group">
                                  <textarea type="text" rows="3" class="form-control" id="customer_note" name="customer_note" value="{{ Request::old('customer_note') ?: '' }}"></textarea>          
                                    <label for="email-id-column">Note</label>
                                </div>
                            </div>
  
                     
                       
  
                   
                                   
                                </div>
                            </div>
  
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                              <input type="hidden" id="account_id" name="account_id" value="{{ $customers->account_number }}">
                                <button type="submit" class="btn btn-success btn-s-xs">Add</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section> 
                     
  