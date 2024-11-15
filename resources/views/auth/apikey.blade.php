@extends('layouts.default')
@section('content')
         <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div class="content-body">
              <!-- users edit start -->
              <section class="users-edit">
                  <div class="card">
                      <div class="card-content">
                          <div class="card-body">
                             

                             <div class="card">
                                <h4>Key</h4>
                                <br>
                                <h3>
                                    {{ $apiKey }}
                                </h3>
                             </div>
                              
                               
                          </div>
                      </div>
                  </div>
              </section>
              <!-- users edit ends -->

          </div>
      </div>
  </div>
  <!-- END: Content-->

  @stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>