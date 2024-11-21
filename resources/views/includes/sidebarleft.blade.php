<div class="col-md-3 left_col tw-bg-sky-950 z-10" id="main-sidebar-div">
  <div class="left_col scroll-view">
  
    <div class="clearfix"></div>

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        
        <ul class="nav side-menu">
          @permission('view-dashboard')
          <li><a href="/dashboard"><i class="fa fa-bar-chart-o"></i> Dashboard</a></li>
          @endpermission
          <!-- <li><a href="/get-members"><i class="fa fa-group"></i> Members</a> </li> -->
          <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>

{{--           @permission('view-catalogue')
          <li><a href="/get-catalogue"><i class="fa fa-files-o"></i> Catalogue</a> </li>
          @endpermission --}}

          @permission('view-catalogue')
          <li><a href="/create-sale"><i class="fa fa-plus-square"></i> POS</a> </li>
          @endpermission

          @permission('view-manage-sales')
          <li><a href="/get-payments"><i class="fa fa-money"></i>Payments</a> </li>
          @endpermission

          @permission('view-stock')
          <li><a href="/get-stock"><i class="fa fa-truck"></i> Stock </a> </li>
          @endpermission

          @permission('view-suppliers')
          <li><a href="/get-suppliers"><i class="fa fa-briefcase"></i> Suppliers </a> </li>
          @endpermission

          @permission('view-reports')
          <li><a href="/get-reports"><i class="fa fa-table"></i> Reports</a> </li>
          @endpermission

          @permission('view-users')
          <li><a href="/manage-users"><i class="fa fa-user"></i> Users</a></li>
          @endpermission

          @permission('view-settings')
          <li><a href="/setup"><i class="fa fa-gear"></i> Settings</a></li>
          @endpermission

        </ul>
      </div>
 

    </div>
    <!-- /sidebar menu -->

  </div>
</div>