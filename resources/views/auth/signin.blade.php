<html lang="en" class="app">
    @include('includes.head')
   {!! htmlScriptTagJsApi() !!}
    <body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static  menu-collapsed blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
     
     
     <!-- BEGIN: Content-->
     <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div class="content-body">
            
              <section class="row flexbox-container">
                  <div class="col-xl-8 col-10 d-flex justify-content-center">
                      <div class="card bg-authentication rounded-0 mb-0">
                          <div class="row">
                              <div class="col-lg-12 col-12 p-0">
                                  <div class="card rounded-0 mb-0 p-2">
                                    <div class="col-md-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                                        <img src="/images/{{ $mycompany->logo }}" style="width:80%" alt="branding logo">
                                    </div>
                                    <br>
                                      <div class="card-header pt-50 pb-1">

                                          <div class="card-title">
                                              <h4 class="mb-0">Login - {{ $mycompany->name }}</h4>
                                          </div>
                                      </div>
                                  <p class="px-2">Welcome back, please login to your account.</p>
                                  <div class="card-content">
                                      <div class="card-body pt-1">
					  <form method="post" action="{{ route('auth.signin') }}">
						@csrf
                                              <fieldset class="form-label-group form-group position-relative">
                                                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                                  
                                                  <label for="username">Username</label>
                                              </fieldset>

                                              <fieldset class="form-label-group position-relative">
                                                  <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" placeholder="Password" required>
                                                 
                                                  <label for="password">Password</label>
                                              </fieldset>

						
                                              @if($company->security_layer == 'advance')
                                              <fieldset class="form-label-group position-relative has-icon-left">
                                                    {!! htmlFormSnippet() !!}
                                             </fieldset>
                                             @elseif($company->security_layer == 'intermediate')
                                                 <div class="form-group mt-4 mb-4">
                                                <div class="captcha">
                                                    <span>{!! captcha_img() !!}</span>
                                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                                        &#x21bb;
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>
                                            </div> 
                                             @else
                                             @endif

						   <div class="form-group d-flex justify-content-between align-items-center">
                                                  <div class="text-left">
                                                      <fieldset class="checkbox">
                                                          <div class="vs-checkbox-con vs-checkbox-primary">
                                                              <input type="checkbox">
                                                              <span class="vs-checkbox">
                                                                  <span class="vs-checkbox--check">
                                                                      <i class="vs-icon feather icon-check"></i>
                                                                  </span>
                                                              </span>
                                                              <span class="">Remember me</span>
                                                          </div>
                                                      </fieldset>
                                                  </div>
                                                  <div class="text-right"><a href="/password/reset" class="card-link">Forgot Password?</a></div>
                                              </div>
                                              
                                              <input type="hidden" name="_token" value="{{ Session::token() }}">
                                              <button type="submit" id="login" name="login" class="btn btn-primary btn-large btn-inline" style="width:100%;">Login</button>
                                          </form>
                                      </div>
                                  </div>
                                  <br>
                                  <br>
                              </div>
                          </div>
                      </div>
                      
                  </div>
              </div>
             
          </section>
         
      </div>
  </div>
</div>
<!-- END: Content-->
@include('includes.scripts')

</body>
</html>


