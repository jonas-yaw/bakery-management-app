<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
             
                <div class="card-content">
                    <div class="card-body">
                       
                            <div class="form-body">
                                <div class="row">
                                  <div class="col-md-12 col-12">
                                    <div class="">
                                      <div class="form-group">
                                        <label for="item_barcode">Barcode</label>
                                      <input type="text" class="form-control" id="item_barcode" onkeypress="return (event.key!='Enter')"
                                       data-required="true" value="{{ Request::old('item_barcode') ?: '' }}"  name="item_barcode">
                                        
                                    </div>
                                    </div>
                                    
                                </div>


                                  <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="item_name">Item Name</label>
                                      <input type="text" class="form-control" id="item_name" required
                                       data-required="true" value="{{ Request::old('item_name') ?: '' }}"  name="item_name">
                                        
                                    </div>
                                </div>
  
                                <div class="col-md-6 col-6">
                                  <div class="form-group">
                                    <label for="item_category">Category</label>
                                    <select id="add_item_category" name="item_category" required rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control m-b" style="width: 100%;">
                                        <option value="">-- Select an category --</option>
                                        @foreach($stock_category as $item)
                                      <option value="{{ $item->type }}">{{ $item->type }}</option>
                                        @endforeach
                                    </select>

                                  </div>
                              </div>

                              <div class="col-md-6 col-6">
                                <div class="form-group">
                                  <label for="item_brand">Brand</label>
                                  <select id="add_item_brand" name="item_brand" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="custom-select2 form-control m-b" style="width: 100%;">
                                      <option value="">-- Select a brand --</option>
                                      @foreach($brands as $item)
                                    <option value="{{ $item->type }}">{{ $item->type }}</option>
                                      @endforeach
                                  </select>

                                </div>
                            </div>
                                

                            <div class="col-md-6 col-6">
                              <div class="form-group">
                                <label for="item_supplier">Supplier</label>
                                <select id="add_item_supplier" name="item_supplier" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control m-b" style="width: 100%;">
                                    <option value="">-- Select a suppplier --</option>
                                    @foreach($suppliers as $supplier)
                                  <option value="{{ $supplier->code }}">{{ $supplier->first_name }} {{ $supplier->last_name }}</option>
                                    @endforeach
                                </select>

                              </div>
                          </div>
                              
                                  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                          <input type="number" rows="3" class="form-control" required id="quantity"  name="quantity" value="{{ Request::old('quantity') ?: '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="quantity">Restock Limit</label>
                                        <input type="number" rows="3" class="form-control" id="restock_limit"  name="restock_limit" value="{{ Request::old('restock_limit') ?: '' }}">
                                      </div>
                                  </div>

                                    <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="price_per_unit">Cost Price Per Unit</label>
                                        <input type="text" rows="3" class="form-control" required id="cost_price_per_unit"  name="cost_price_per_unit" value="{{ Request::old('cost_price_per_unit') ?: '' }}">
                                      </div>
                                  </div>
  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="price_per_unit">Selling rice Per Unit</label>
                                          <input type="text" rows="3" class="form-control" required id="price_per_unit"  name="price_per_unit" value="{{ Request::old('price_per_unit') ?: '' }}">
                                        </div>
                                    </div>
  
                                   
                                </div>
                            </div>
  
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section> 
                     
  