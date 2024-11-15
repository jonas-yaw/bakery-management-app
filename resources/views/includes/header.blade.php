 <!-- BEGIN: Header-->
@if(Auth::check()) 

<div class="top_nav">
    <div class="nav_menu">
       
        <nav class="nav navbar-nav header-navbar">
            <div class="navbar-container content header-content custom-navbar-content">
                <div class="nav toggle-btn">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>


                <div class="nav-left-content">
                    <span><a href="/signout"><i class="fa fa-sign-out"></i>Logout</a></span>
                </div>
            </div>

            
      </nav>

    </div>
  </div>

@endif
<!-- END: Header-->
