<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
             
                <div class="card-content">
                    <div class="card-body">
                       
                            <div class="form-body">
                                <div class="row">
  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Name</label>
                                            <br>
                                          <input type="text" required rows="3" class="form-control" id="type" name="type" value="{{ Request::old('type') ?: '' }}"> 
                                          <input type="hidden" name="id">
                                        </div>
                                    </div>
  
                                </div>  
  
                              </div>
                            </div>
  
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                            </div>
                        
                            <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section> 