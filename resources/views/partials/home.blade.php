 <!-- BEGIN: Content-->
 <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card bg-analytics text-white">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <img src="../../../app-assets/images/elements/decore-left.png" class="img-left" alt="
        card-img-left">
                                    <img src="../../../app-assets/images/elements/decore-right.png" class="img-right" alt="
        card-img-right">
                                    <div class="avatar avatar-xl bg-primary shadow mt-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-award white font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="ext-default">Welcome {{ Auth::user()->getNameOrUsername() }},</h1>
                                        <p>You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <a href="/online-policies"> <i class="feather icon-users text-primary font-medium-5"></i> </a>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1 mb-25"><span class="text-bold-700 mt-1 mb-25" id="total_in_house_guests" name="total_in_house_guests" value="{{ Request::old('total_in_house_guests') ?: '0' }}"></h2>
                                <p class="mb-0">In-house Guests</p>
                            </div>
                            <div class="card-content">
                                <div id="subscribe-gain-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-warning p-50 m-0">
                                    <div class="avatar-content">
                                       <a href="#"> <i class="feather icon-package text-warning font-medium-5"></i></a>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1 mb-25"><span class="text-bold-700 mt-1 mb-25" id="total_arrivals" name="total_arrivals" value="{{ Request::old('total_arrivals') ?: '0' }}"></h2>
                                <p class="mb-0">Today's Arrivals</p>
                            </div>
                            <div class="card-content">
                                <div id="orders-received-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
  

                <div class="row">
                    <div class="col-lg-8 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-end">
                                <h4 class="card-title">Occupancy Statistics</h4>
                                <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
                            </div>
                            <div class="card-content">
                                <div class="card-body pb-0">
                                  
                                    <div id="revenue-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                   
                </div>
  
  
                
            </section>
            <!-- Dashboard Analytics end -->
  
        </div>
    </div>
  </div>
  <!-- END: Content-->
