@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">

  <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

  <div class="row">
    <div class="col-xl-6 col-xxl-5 d-flex">
      <div class="w-100">
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Sales</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="truck"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $company->currency }} {{ $today_sales }} </h1>
               
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Visitors</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="users"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $visitors }}</h1>
                
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Earnings</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="dollar-sign"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $company->currency }} {{ $today_earnings }}</h1>
                
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Orders</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="shopping-cart"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $orders }}</h1>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-xxl-7">
      <div class="card flex-fill w-100">
        <div class="card-header">

          <h5 class="card-title mb-0">Daily Sales</h5>
        </div>
        <div class="card-body py-3">
          
            <canvas id="chartjs-daiily-sales" style="width: 100%;"></canvas>
          
        </div>
      </div>
    </div>
  </div>

  <div class="row">
   
    <div class="col-12 col-lg-6 col-xxl-3 d-flex">
      <div class="card flex-fill w-100">
        <div class="card-header">

          <h5 class="card-title mb-0">Monthly Sales</h5>
        </div>
        <div class="card-body d-flex w-100">
            <canvas style="width: 100%;" id="chartjs-dashboard-bar-monthly"></canvas>
          
        </div>
      </div>
    </div>


    <div class="col-12 col-lg-6 col-xxl-3 d-flex">
      <div class="card flex-fill w-100">
        <div class="card-header">

          <h5 class="card-title mb-0">Monthly Earnings</h5>
        </div>
        <div class="card-body d-flex w-100">
            <canvas id="chartjs-dashboard-bar-weekly"></canvas>
          
        </div>
      </div>
    </div>
  </div>

</div>
@stop


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
   $(document).ready(function () {
      //getOccupancyStatistics();


     });
   </script>

<script>
 document.addEventListener("DOMContentLoaded", function() {
  const ctx = document.getElementById('chartjs-daiily-sales');
    const xlabels = [
      "Sun", "Mon", "Tues", "Wed", "Thur", "Fri", "Sat"
    ];
    //const yValues = [7,8,8,9,9,9,10];
  
    const yValues = {!! json_encode($weekly_array) !!};
    

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: xlabels,
        datasets: [{
          label: 'Amount',
          fill: false,
          data: yValues,
          lineTension: 0,
          backgroundColor: "rgba(0,0,255,1.0)",
          borderColor: "blue",
          borderWidth: 2
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
 });

</script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('chartjs-dashboard-bar-monthly');
    const xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    //var yValues = [54, 67, 41, 55, 62, 0, 0, 0, 0, 0, 0, 0];
    const yValues = {!! json_encode($monthly_array) !!};

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: "orange",
          data: yValues
        }]
      },
      options: {
      legend: {display: false},
    
    }
    });
  });
</script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('chartjs-dashboard-bar-weekly');
    const xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    const yValues = {!! json_encode($monthly_earning_array) !!};

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: "green",
          data: yValues
        }]
      },
      options: {
      legend: {display: false},
    
    }
    });
  });
</script>