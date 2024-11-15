
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
@include('includes.head')
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      @if(Auth::user()->created_at == Auth::user()->updated_at)
      @else
      @include('includes.sidebarleft')
    
      @endif
      @include('includes.header')
      
      <div class="right_col" role="main">
   


    <section>
      <section class="hbox stretch">
        <!-- .aside -->
      
       
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">          
           @yield('content')
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        @include('includes.footer')
      </section>
    </section>

      </div>
      @livewireScripts
@include('includes.scripts')

    </div>
  </div>
</body>
</html>
