  
  <!-- combodate -->


  <script src="{{ asset('/js/jquery.min.js')}}"></script>
 
  <!-- Bootstrap -->
  <script src="{{ asset('/js/bootstrap.js')}}"></script>
  <!-- App -->
<script src="{{ asset('/js/moment.js')}}"></script>
<script src="{{ asset('/js/daterangepicker.js')}}"></script>
<script src="{{ asset('/js/libs/moment.min.js')}}"></script>
<script src="{{ asset('/js/combodate/combodate.js')}}"></script>

  <script src="{{ asset('/js/app.js')}}"></script>
  <script src="{{ asset('/js/sweetalert.min.js')}}"></script>
  <script src="{{ asset('/js/app.plugin.js')}}"></script>
  <script src="{{ asset('/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{ asset('/js/charts/easypiechart/jquery.easy-pie-chart.js')}}"></script>
  <script src="{{ asset('/js/charts/sparkline/jquery.sparkline.min.js')}}"></script>
  <script src="{{ asset('/js/charts/flot/jquery.flot.min.js')}}"></script>
  <script src="{{ asset('/js/charts/flot/jquery.flot.tooltip.min.js')}}"></script>
  <script src="{{ asset('/js/charts/flot/jquery.flot.resize.js')}}"></script>
  <script src="{{ asset('/js/charts/flot/jquery.flot.grow.js')}}"></script>
  <script src="{{ asset('/js/charts/flot/demo.js')}}"></script>
  <script src="{{ asset('/js/Chart.js')}}"></script>
  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
{{-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}
<script src="{{ asset('/js/select2/select2.min.js')}}"></script>  
<script src="{{ asset('/js/nicEdit.js')}}"></script> 
<script src="{{ asset('/js/parsley/parsley.min.js')}}"></script>
<script src="{{ asset('/js/fuelux/fuelux.js')}}"></script>
<script src="{{ asset('/js/jquery-ui-1.10.3.custom.min.js')}}"></script>
<script src="{{ asset('/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{ asset('/js/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{ asset('/js/toastr/toastr.js')}}"></script> 
<script src="{{ asset('/js/tinymce/js/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{ asset('/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
{{-- <script src="{{ asset('/js/wysiwyg/jquery.hotkeys.js')}}"></script>
<script src="{{ asset('/js/wysiwyg/bootstrap-wysiwyg.js')}}"></script>
<script src="{{ asset('/js/wysiwyg/demo.js')}}"></script> --}}
<script src="{{ asset('/js/markdown/epiceditor.min.js')}}"></script>
<script src="{{ asset('/js/libs/underscore-min.js')}}"></script>
<script src="{{ asset('/js/prettyphoto/jquery.prettyPhoto.js')}}"></script>  
<script src="{{ asset('/js/grid/jquery.grid-a-licious.min.js')}}"></script>
<script src="{{ asset('/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>




{{-- 
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "0967f400-cc3b-4e46-9621-d901a8b5ff53",
    });
  });
</script> --}}
   
{{-- <script src="https://unpkg.com/magic-snowflakes/dist/snowflakes.min.js"></script>
<script>
    var sf = new Snowflakes({
        color: "#ffffff"
    });
</script> --}}

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

{{--   // <script src="{{ asset('/js/jquery.min.js')}}"></script> --}}


