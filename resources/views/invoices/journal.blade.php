<section id="multiple-column-form">
  <div class="row match-height">
      <div class="col-12">
          <div class="card">
           
              <div class="card-content">
                  <div class="card-body">
                     
                          <div class="form-body">
                              <div class="row">

                                <div class="col-md-12 col-12">
                                  <label for="email-id-column">Jounal Type</label>
                                  <div class="form-label-group">
                                    <select id="journal_type" name="journal_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                                      <option value=""> -- Please select journaling method -- </option>
                                     <option value="Debit Journal" selected>Debit</option>
                                     <option value="Credit Journal">Credit</option>
                                      </select>  
                                  </div>

                                  <div class="alert alert-warning mb-2" role="alert">
                                
                                  </div>
                              </div>

                             

                              <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                  <input type="text" class="form-control" name="journal_date" id="journal_date" placeholder="Select your time" value="{{ old('journal_date') }}"> 
                                    <label for="company-column">Journal Date</label>
                                </div>
                            </div>
                           

                                  <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <input type="text" data-required="true" rows="3"  class="form-control" id="journal_amount" name="journal_amount" value="{{ Request::old('journal_amount') ?: '' }}"> 
                                          <label for="first-name-column"> Journal Amount</label>
                                      </div>
                                  </div>
                                 

                                
                                  <div class="col-md-12 col-12">
                                      <div class="form-label-group">
                                        <input type="text" rows="3" class="form-control" readonly="true" id="journal_name" name="journal_name" value="{{ Request::old('journal_name') ?: '' }}">     
                                        <label for="city-column">Customer Name</label>
                                      </div>
                                      <div class="alert alert-warning mb-2" role="alert">
                                
                                      </div>
                                  </div>
                                   

                    
                                  
                                

                                  <div class="col-md-6 col-12">
                                    <div class="form-label-group">
                                      <input type="text" rows="3" class="form-control" readonly="true" id="journal_policy_number" name="journal_policy_number" value="{{ Request::old('journal_policy_number') ?: '' }}">      
                                        <label for="email-id-column">Policy Number</label>
                                    </div>
                                  </div>



                                <div class="col-md-6 col-12">
                                  <div class="form-label-group">
                                    <input type="text" rows="3" class="form-control" readonly="true" id="payer_id" name="journal_receipt" value="{{ Request::old('journal_receipt') ?: '' }}">       
                                      <label for="email-id-column">Receipt Number</label>
                                  </div>
                              </div>


                            <div class="col-md-12 col-12">
                              <label for="email-id-column">Transaction Description</label>
                              <div class="form-label-group">
                                <select id="journal_description" name="journal_description" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true" onchange="getJournalStatus(this.value);" >
                                  <option value=""> -- Please select journaling method -- </option>
				 @foreach($journaltypes as $journaltype)
                                  <option 
                                  @if ($journaltype->type == 'Reversal of Receipt') selected @endif
                                  value="{{ $journaltype->type }}">{{ $journaltype->type }}</option>
                                    @endforeach
                                 
                                  
              
	

                                  </select>  
                                
                              </div>
                              <div class="alert alert-warning mb-2" role="alert">
                                
                              </div>
                          </div>

			<div class="col-md-12 col-12">
                            <div class="form-label-group">
                                <input type="text" id="journal_narration" name="journal_narration" class="form-control" placeholder="Narration">
                                <label for="narration">Narration</label>
                            </div>
			</div>


      <div class="col-md-12 col-12" id="journal_bank_div">
        <div class="form-label-group">
          <select id="journal_coa_bank" name="journal_coa_bank" required rows="3" style="width: 100%;" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                                      
            <option value=""> -- Please select bank -- </option>
            @foreach($coa_banks as $bank)
            <option value="{{ $bank->code }}">{{ $bank->code }} - {{ $bank->account }}</option>
            @endforeach 
            </select>  

            <label for="narration">Bank</label>
        </div>
</div>

                              </div>
                          </div>

                          <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                           
                            <button type="submit" class="btn btn-success btn-s-xs">Process Journal</button>
                            <input type="hidden" name="premium" id="premium" value="{{ Request::old('premium') ?: '' }}">
                            <input type="hidden" name="journal_id" id="journal_id" value="{{ Request::old('journal_id') ?: '' }}">
                          </div>
                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</section> 
             
             
           
                  


                     
                        



                       

                    
               

                         
                     
