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
                          <h2 class="content-header-title float-left mb-0">{{ $customers->fullname }}</h2>
                          <div class="breadcrumb-wrapper col-12">
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#">Pages</a>
                                  </li>
                                  <li class="breadcrumb-item active">Profile
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
          <div class="content-body">
              <div id="user-profile">
                  <div class="row">
                      <div class="col-12">
                          <div class="profile-header mb-2">
                              <div class="relative">
                              </div>
                          </div>
                      </div>
                  </div>
                  <section id="profile-info">
                      <div class="row">
                          <div class="col-lg-3 col-12">
                              <div class="card">
                                  <div class="card-header">
                                      <h4>About</h4>
                                      <i class="feather icon-more-horizontal cursor-pointer"></i>
                                  </div>
                                  <div class="card-body">
                                      <p>{{ ucwords(strtolower($customers->fullname)) }}</p>
                                      <div class="mt-1">
                                          <h6 class="mb-0">Joined as:</h6>
                                          <p>{{ ucwords(strtolower($customers->account_type)) }}</p>
                                      </div>
                                      <div class="mt-1">
                                          <h6 class="mb-0">Lives:</h6>
                                          <p>{{ ucwords(strtolower($customers->postal_address)) }}</p>
                                      </div>
                                      <div class="mt-1">
                                          <h6 class="mb-0">Email:</h6>
                                          <p>{{ ucwords(strtolower($customers->email)) }}</p>
                                      </div>
                                      <div class="mt-1">
                                          <h6 class="mb-0">Mobile Number:</h6>
                                          <p>{{ $customers->mobile_number }}</p>
                                      </div>
                                      <div class="mt-1">
                                        <h6 class="mb-0">Account Manager:</h6>
                                        <p>{{ $customers->created_by }}</p>
                                      </div>
                                      <div class="mt-1">
                                        <h6 class="mb-0">Field of Activity:</h6>
                                        <p>{{ $customers->field_of_activity }}</p>
                                      </div>
                                      <div class="mt-1">
                                          <button type="button" class="btn btn-sm btn-icon btn-primary mr-25 p-25"><i class="feather icon-facebook"></i></button>
                                          <button type="button" class="btn btn-sm btn-icon btn-primary mr-25 p-25"><i class="feather icon-twitter"></i></button>
                                          <button type="button" class="btn btn-sm btn-icon btn-primary p-25"><i class="feather icon-instagram"></i></button>
                                      </div>
                                  </div>
                              </div>
                              <div class="card">
                                  <div class="card-header">
                                      <h4 class="card-title">Preferences</h4>
                                  </div>
                                  <div class="card-body suggested-block">
                                    @foreach($reservations as $reservation)
                                    @endforeach
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-12">
                              <div class="card">
                                  <div class="card-body">
                                    <h4>Reservations</h4>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped dataex-html5-selectors mb-0 font-small-2 text-center">
                                          <thead>
                                            <tr>
                                               <!-- <th>Invoice #</th> -->
                                                <th>Reservation #</th>
                                                <th>Room #</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Currency</th>
                                                <th>Rate</th>
                                                <th>Payment Status</th>
                                                <th>Status</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                         @foreach($bills as $bill )
                                        <tr>
                                          <td><a href="/view-policy/{{ Crypt::encrypt($bill->reference) }}">{{ $bill->reference }}</a></td>
                                          <td>{{ $bill->room_number }}</td>
                                          <td>{{ $bill->invoice_date }}</td>
                                          <td>{{ $bill->product }}</td>
                                          <td>{{ $bill->currency }}</td>
                                          <td>{{ $bill->amount }}</td>
                                          <td>{{ $bill->payment_status }}</td>
                                          <td>
                                            @if($bill->insurance_period_to < Carbon\Carbon::now()) <span class="text-danger">Expired</span>
                                              @else
                                              <span class="text-info">Running</span>
                                              @endif
                                              </a>
                                          </td>
                                          
                                        </tr>
                                       @endforeach 
                                          </tbody>
                                        </table>
                                       
                                      </div>
                                  </div>
                              </div>
                          </div>

                          
                          <div class="col-lg-3 col-12">
                              <div class="card">
                                  <div class="card-header">
                                      <h4>Latest Documents</h4>
                                  </div>
                                  <div class="card-body">
                                      <div class="row">
                                        @foreach($images as $image)
                                          <div class="col-md-4 col-6 user-latest-img">
                                            <a href="/uploads/images/{{ $image->filepath }}">  <img src="/images/pdf.png" class="img-fluid mb-1 rounded-sm" alt="avtar img holder"></a>
                                          </div>
                                        @endforeach
                                      </div>
                                  </div>
                              </div>

                              <div class="card">
                                <div class="card-header">
                                    <div class="row1" style="width:100%;">
                                        <div>
                                            <h4>Notes</h4>
                                        </div>

                                        <div>
                                            <a href="#add_customer_note" data-toggle="modal" class="bootstrap-modal-form-open"> <button class="round-btn-add">+</button></a>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="card-body">
                                </div>
                                
                              </div>
                          </div>
                      </div>
                  </section>
              </div>

          </div>
      </div>
  </div>
  <!-- END: Content-->











  @stop


 <div class="modal fade" id="attach_document" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Attach Document</h4>
        </div>

        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $customers->ID  }}">
          <input type="hidden" name="selectedcustomer" id="selectedcustomer" value="{{ $customers->ID  }}">
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>

      </div>
      </div>
      </div>
      </div>


    <div class="modal fade" id="add_customer_note" tabindex="-1" role="dialog" aria-labelledby="update-stock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="bootstrap-modal-form" method="post" action="/add-customer-note" class="panel-body wrapper-lg">
                    @include('customer/add_note')  
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>

        </div>
    </div>
</div>

