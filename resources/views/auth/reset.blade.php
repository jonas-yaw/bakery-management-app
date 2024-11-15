
<!DOCTYPE html>
<html lang="en" class="bg-dark">
@include('includes.signinhead')
<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="#">Change Password</a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">

        </header>
       <form method="POST" action="/password/reset" class="panel-body wrapper-lg">
    {!! csrf_field() !!} 
    <input type="hidden" name="token" value="{{ $token }}">
          <div class="form-group">
           <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
            <label class="control-label">Email</label>
            <input type="text" placeholder="" class="form-control input-lg" type="email" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
          <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
          </div>

           <div class="form-group">
           <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
            <label class="control-label">Password</label>
            <input placeholder="" class="form-control input-lg" type="password" name="password">
            @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
          </div>

           <div class="form-group">
           <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">
            <label class="control-label">Confirm Password</label>
            <input placeholder="" class="form-control input-lg" type="password" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
          <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>


          <button class="btn btn-lg btn-success btn-login btn-block" id="login" name="login" value="Login" type="submit">Reset Password</button>
         

        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
       <small>@include('includes.appversion')</small>
      </p>
    </div>
  </footer>
 <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
 <img src="/images/join-team.png"> 
  <!-- / footer -->
  <script src="{{ asset('/js/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('/js/bootstrap.js')}}"></script>
  <!-- App -->
  <script src="{{ asset('/js/app.js')}}"></script>
  <script src="{{ asset('/js/app.plugin.js')}}"></script>
  <script src="{{ asset('/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('/js/jquery.backstretch.min.js')}}"></script>
   <script>
          $.backstretch("{{ asset('images/medical-icon.jpg')}}", {speed: 500});
      </script>


        <script src="{{ asset('/js/toastr/toastr.js')}}"></script> 
  
  <script>

  @if(Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
  @endif

  @if(Session::has('info'))
      toastr.success("{{ Session::get('info') }}");
  @endif

  @if(Session::has('warning'))
      toastr.warning("{{ Session::get('warning') }}");
  @endif

  @if(Session::has('error'))
      toastr.error("{{ Session::get('error') }}");
  @endif

</script>
</body>
</html>