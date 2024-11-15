  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Kan.Dev">
    <meta name="keywords" content="Kan.Dev">
    <meta name="author" content="Kan.Dev">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    
    <title>{{   $mycompany->legal_name }}</title>
    <link rel="apple-touch-icon" href="{{ asset('/images/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/favicon.png')}}">
 


<link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/app.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" href="{{ asset('/css/print.css')}}" type="text/css" media="print" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/knowledge-base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/error.css')}}">
    

   
    <!-- END: Vendor CSS-->


       <!-- BEGIN: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/authentication.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/invoice.css')}}">
       <!-- BEGIN: Page CSS-->

 
       <!-- END: Page CSS-->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/forms/wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/forms/bs-stepper.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css')}}"> -->

    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/file-uploaders/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/data-list-view.css')}}">

    <link rel="stylesheet" href="{{ asset('/js/sweetalert.css')}}" type="text/css"/>
    {{-- <link rel="stylesheet" href="{{ asset('/js/sweetalert.css')}}" type="text/css"/> --}}
    <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.css')}}" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('/js/datepicker/datepicker.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/js/daterangepicker.css')}}" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('/js/datepicker/datepicker.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/js/daterangepicker.css')}}" type="text/css" />

 <!-- BEGIN: Vendor CSS-->
 <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
 <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/app-chat.css')}}">
 <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/core/colors/palette-gradient.css')}}">
 <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/app-chat.css')}}">



 <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/app-todo.css')}}">



    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/editors/quill/katex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/app-email.css')}}">



  

    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/app-ecommerce-details.css')}}">

    <link href=" {{ asset('/app-assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/custom.css')}}">

	<link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/main.css')}}">





   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
 
   <style>
     body{
         font-family: 'Montserrat';
     }
   </style>

@livewireStyles
 

</head>
<!-- END: Head-->
