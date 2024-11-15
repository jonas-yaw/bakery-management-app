<section id="multiple-column-form">
  <div class="row match-height">
      <div class="col-12">
          <div class="card">
           
              <div class="card-content">
                  <div class="card-body">
                     
                          <div class="form-body">
                              <div class="row">

                                <div class="col-md-12 col-12">
                                  <label for="email-id-column">Payment Type</label>
                                  <div class="form-label-group">
                                    <select id="collection_mode" name="collection_mode" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                                      <option value=""> -- Please select method -- </option>
                                      <option value="Cash">Cash</option>
                                      <option value="Cheque">Cheque</option>
                                      <option value="Mobile Money">Mobile Money</option>
                                      <option value="Self Cheque Deposit">Self Cheque Deposit</option>
                                      <option value="Bank Transfer">Bank Transfer</option>
                                      <option value="Credit Advice">Credit Advice</option>
                                      <option value="Debit Card Payment">Debit Card Payment</option>
                                      <option value="Offsetting Entry">Offsetting Entry</option>
                                      <option value="Bancassurance Deposit">Bancassurance Deposit</option>
                                      <option value="Returned Cheque">Returned Cheque</option>
                                      <option value="Exchange Loss">Exchange Loss</option>
                                      <option value="Exchange Gain">Exchange Gain</option>
				</select>
                                  </div>

                                  <div class="alert alert-warning mb-2" role="alert">
                                
                                  </div>
                              </div>

                             

                              <div class="col-md-6 col-12">
                                <div class="form-label-group">
				 <input type="text" class="form-control" name="receipt_date" id="receipt_date" placeholder="Select your time" value="{{ Request::old('receipt_date') }}">  
                                </div>
                            </div>
                           

                                  <div class="col-md-3 col-12">
                                      <div class="form-label-group">
                                        <input type="text" data-required="true" rows="3" class="form-control" id="payment_amount" name="payment_amount" value="{{ Request::old('payment_amount') ?: '' }}"> 
                                          <label for="first-name-column"> Payment Amount</label>
                                      </div>
                                  </div>

                                  <div class="col-md-3 col-12">
                                    <div class="form-label-group">
                                      <input type="text" data-required="true" rows="3" class="form-control" id="payment_exchange" name="payment_exchange" value="{{ Request::old('payment_exchange') ?: '' }}">  
                                        <label for="first-name-column"> Exchange Rate</label>
                                    </div>
                                </div>

                                  

                                
                                  <div class="col-md-12 col-12">
                                      <div class="form-label-group">
                                        <input type="text" rows="3" class="form-control" readonly="true" id="payer_name" name="payer_name" value="{{ Request::old('payer_name') ?: '' }}">      
                                        <label for="city-column">Customer Name</label>
                                      </div>
                                      <div class="alert alert-warning mb-2" role="alert">
                                
                                      </div>
                                  </div>
                                   

                    
                                  
                                

                                  <div class="col-md-4 col-12">
                                    <div class="form-label-group">
                                      <input type="text" rows="3" class="form-control" readonly="true" id="policy_number" name="policy_number" value="{{ Request::old('policy_number') ?: '' }}">    
                                        <label for="email-id-column">Policy Number</label>
                                    </div>
                                  </div>



                                <div class="col-md-4 col-12">
                                  <div class="form-label-group">
                                    <input type="text" rows="3" class="form-control" readonly="true" id="receipt_number" name="receipt_number" value="{{ Request::old('receipt_number') ?: '' }}">      
                                      <label for="email-id-column">Receipt Number</label>
                                  </div>
                              </div>

                              <div class="col-md-4 col-12">
                                <div class="form-label-group">
                                  <input type="text" rows="3" class="form-control" readonly="true" id="invoice_number" name="invoice_number" value="{{ Request::old('invoice_number') ?: '' }}">        
                                    <label for="email-id-column">Debit Number</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                              <div class="form-label-group">
                                <input type="text" rows="3" class="form-control" id="payment_description" data-required="true" name="payment_description" value="Payment of policy">       
                                  <label for="email-id-column">Transaction Description</label>
                              </div>
                              <div class="alert alert-warning mb-2" role="alert">
                                
                              </div>
                          </div>

                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                <input type="text" rows="3" class="form-control" id="reference_name" name="reference_name" value="{{ Request::old('reference_name') ?: '' }}" data-required="true">          
                                  <label for="email-id-column">Paid By</label>
                              </div>
                          </div>

                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              <input type="text" rows="3" class="form-control" id="reference_number" name="reference_number" value="{{ Request::old('reference_number') ?: '' }}" data-required="true">    
                                <label for="email-id-column">Cheque No. / Swift No. / Momo Reference</label>
                            </div>
                        </div>
                       


                          <div class="col-md-12 col-12">
                          <div class="form-label-group">
                        <select id="agency" name="agency" rows="3" tabindex="1" data-placeholder="Select here.." class="custom-select2 form-control required" style="width: 100%;" data-required="true">
                          <option value=""> -- Please select method -- </option>
                        @foreach($intermediary as $agent)
                        <option value="{{ $agent->agentcode }}">{{  $agent->agentcode }} -{{  $agent->agentname }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12 col-12">
                    <div class="form-label-group">
                  <select id="coa_bank" style="width: 100%;" name="coa_bank" rows="3" tabindex="1" data-placeholder="Select here.." class="custom-select2 form-control required" data-required="true">
                    <option value=""> -- Please select method -- </option>
                    @foreach($coa_banks as $bank)
                      <option value="{{ $bank->code }}">{{ $bank->code }} - {{ $bank->account }}</option>
                    @endforeach 
                </select>
              </div>
            </div>
                        <!-- <div class="col-md-6 col-12">
                          <div class="form-label-group">
                            <input type="text" rows="3" class="form-control" id="agency" name="agency" value="{{ Request::old('agency') ?: '' }}" data-required="true">   
                            <label for="email-id-column">Agency Number</label>
                          </div>
                        </div> -->

                     
                     

                 
                                 
                              </div>
                          </div>

                          <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                            <input type="hidden" name="receipt_id" id="receipt_id" value="{{ Request::old('receipt_id') ?: '' }}">
                              <button type="submit" class="btn btn-success btn-s-xs">Update Record</button>
                          </div>
                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</section> 
                   
             
             
             
                      






                    




                       
