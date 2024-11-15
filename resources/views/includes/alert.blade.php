{{-- @if (Session::has('info'))
	<div class="alert alert-info" role="alert">
		{{ Session::get('info')}}
	</div>
@elseif(Session::has('warning'))
	<div class="alert alert-danger" role="alert">
		{{ Session::get('warning')}}
	</div>
@endif --}}


  @if(Session::has('success'))
  		toastr.success("{{ Session::get('success') }}");
  @endif

  @if(Session::has('info'))
  		toastr.info("{{ Session::get('info') }}");
  @endif

  @if(Session::has('warning'))
  		toastr.warning("{{ Session::get('warning') }}");
  @endif

  @if(Session::has('error'))
  		toastr.error("{{ Session::get('error') }}");
  @endif
