<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
             
                <div class="card-content">
                    <div class="card-body">
                       
                            <div class="form-body">
                                <div class="row">
  
                                

                                  <div class="col-md-12 col-12">
                                    <label for="email-id-column">Transfer Type</label>
                                    <div class="form-label-group">
                                      <select id="journal_type" name="journal_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                                        <option value=""> -- Please select transfer method -- </option>
                                       <option value="Debit Journal">Scheduled</option>
                                       <option value="Credit Journal" selected>Instant</option>
                                        </select>  
                                    </div>
  
                                    <div class="alert alert-danger mb-2" role="alert">
                                  
                                    </div>
                                </div>
  
                               
                               
  
                                <div class="col-md-6 col-12">
                                  <div class="form-label-group">
                                    <input type="text" class="form-control" name="source_payment_date" id="source_payment_date" placeholder="Select your time" value="{{ old('source_payment_date') }}"> 
                                      <label for="company-column">Source Payment Date</label>
                                  </div>
                                 </div>
                             
  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                          <input type="text" data-required="true" readonly rows="3"  class="form-control" id="source_paid_amount" name="source_paid_amount" value="{{ Request::old('source_paid_amount') ?: '' }}"> 
                                            <label for="first-name-column">Source Paid Amount</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <input type="text" rows="3" class="form-control" readonly="true" id="source_policy_number" name="source_policy_number" value="{{ Request::old('source_policy_number') ?: '' }}">      
                                          <label for="email-id-column">Source Policy Number</label>
                                      </div>
                                    </div>
  
  
  
                                  <div class="col-md-6 col-12">
				    <div class="form-label-group">
					<input type="hidden" id="invoice_number" name="invoice_number" value="{{ Request::old('invoice_number') ?: '' }}">
                                      <input type="text" rows="3" class="form-control" readonly="true" id="source_receipt_number" name="source_receipt_number" value="{{ Request::old('source_receipt_number') ?: '' }}">       
                                        <label for="email-id-column">Source Receipt Number</label>
                                    </div>
                                </div>
                                   
  
                                  
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                          <input type="text" rows="3" class="form-control" readonly="true" id="source_insured" name="source_insured" value="{{ Request::old('source_insured') ?: '' }}">     
                                          <label for="city-column"> Source Customer Name</label>
                                        </div>
                                        <div class="alert alert-danger mb-2" role="alert">
                                  
                                        </div>
                                    </div>
                                     
  
                      
                                    
                                  
  
                                  


                                    <div class="col-md-12 col-12">
                                      <div class="alert alert-success mb-2" role="alert">
                                
                                      </div>
                                      <div class="form-label-group">
                                        <input type="text" rows="3" class="form-control" readonly="true" id="destination_insured" name="destination_insured" value="{{ Request::old('destination_insured') ?: '' }}">     
                                        <label for="city-column"> Destination Customer Name</label>
                                      </div>
                                     
                                  </div>
                                   
  
                                   

                                    <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <input type="text" rows="3" readonly class="form-control"  required id="destination_policy_number" name="destination_policy_number" value="{{ Request::old('destination_policy_number') ?: '' }}">      
                                          <label for="email-id-column">Destination Policy Number</label>
                                      </div>
                                    </div>
  
  
  
                                  <div class="col-md-6 col-12">
                                    <div class="form-label-group">
                                      <input type="text" rows="3" class="form-control" onblur="getPolicyDetails();" required id="destination_debit_number" name="destination_debit_number" value="{{ Request::old('destination_debit_number') ?: '' }}">       
                                        <label for="email-id-column">Destination Debit Number</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                  <div class="form-label-group">
                                    <input type="text" rows="3" class="form-control" readonly required id="policy_balance" name="policy_balance" value="{{ Request::old('policy_balance') ?: '' }}">       
                                      <label for="email-id-column"> Debit Amount</label>
                                  </div>
                              </div>


                                <div class="col-md-6 col-12">
                                  <div class="form-label-group">
                                    <input type="text" data-required="true" readonly rows="3"  class="form-control" id="available_amount" name="available_amount" value="{{ Request::old('available_amount') ?: '' }}"> 
                                      <label for="first-name-column">Available Amount</label>
                                  </div>
                              </div>

                               
  
                              <div class="col-md-12 col-12">
                                <div class="form-label-group">
                                  <input type="text" rows="3" class="form-control" id="journal_description" data-required="true" name="journal_description" value="Credit Transfer">      
                                    <label for="email-id-column">Transaction Description</label>
                                </div>
                                <div class="alert alert-success mb-2" role="alert">
                                
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                <input type="text" data-required="true" rows="3"  class="form-control" id="destination_paid_amount" name="destination_paid_amount" value="{{ Request::old('destination_paid_amount') ?: '' }}"> 
                                  <label for="first-name-column">Transfer Amount</label>
                              </div>
                          </div>
  
                             
                                </div>
                            </div>
  
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                             
                              <button type="submit" onclick="validateTransfer(event);" class="btn btn-success btn-s-xs">Process Transfer</button>
 
                              <input type="hidden" name="premium" id="premium" value="{{ Request::old('premium') ?: '' }}">
                              <input type="hidden" name="journal_id" id="journal_id" value="{{ Request::old('journal_id') ?: '' }}">
                            </div>
                        
                    </div>
                </div>
            </div>
