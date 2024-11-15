<head>
    <meta charset="utf-8" />
    <title>{{   $mycompany->legal_name }}</title>
  
  
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  
    
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/print.css')}}" type="text/css" media="print" />
    <link rel="stylesheet" href="{{ asset('/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/font.css')}}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('/css/app.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/js/fullcalendar/fullcalendar.css')}}" type="text/css"  />
    <link rel="stylesheet" href="{{ asset('/js/fullcalendar/theme.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/js/datepicker/datepicker.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/js/daterangepicker.css')}}" type="text/css" />
  
  
    <!--[if lt IE 9]>
      <script src="js/ie/html5shiv.js"></script>
      <script src="js/ie/respond.min.js"></script>
      <script src="js/ie/excanvas.js"></script>
    <![endif]-->
  
    <link rel="stylesheet" href="{{ asset('/js/select2/select2.css')}}" type="text/css" /> 
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> 
    <link rel="stylesheet" href="{{ asset('/js/select2/theme.css')}}" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('/js/fuelux/fuelux.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/js/sweetalert.css')}}" type="text/css"/>
  
    <link rel="stylesheet" href="{{ asset('/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/fontello/css/fontello.css')}}" type="text/css"  />
    <link rel="stylesheet" href="{{ asset('/js/daterangepicker.css')}}" type="text/css" />
  
    <link rel="stylesheet" href="{{ asset('/js/prettyphoto/prettyPhoto.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/js/grid/gallery.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/js/Chart.js')}}" type="text/css" />
  
   
  
  
  <style type="text/css">
   .checkbox-grid li {
     display:inline-block;
      float: left;
      width: 40%; /*  added  */
      font-weight: 400;
    margin-bottom: 10px !important;
    margin-right: 1%;
    margin-left:0;
  }
  
  </style>
  
  <style type="text/css">
    
    .float{
    position:fixed;
    width:60px;
    height:60px;
    bottom:40px;
    right:40px;
    background-color:#0C9;
    color:#FFF;
    border-radius:50px;
    text-align:center;
    box-shadow: 2px 2px 3px #999;
  }
  
  .my-float{
    margin-top:22px;
  }
  
  
  
  
  #presentation{
    width: 480px;
    height: 120px;
    padding: 20px;
    margin: auto;
    background: #FFF;
    margin-top: 10px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); 
    transition: all 0.3s; 
    border-radius: 3px;
  }
  
  #presentation:hover{
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    transition: all 0.3s;
    transform: translateZ(10px);
  }
  
  #floating-button{
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: #db4437;
    position: fixed;
    bottom: 30px;
    right: 30px;
    cursor: pointer;
    box-shadow: 0px 2px 5px #666;
  }
  
  .plus{
    color: white;
    position: absolute;
    top: 0;
    display: block;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    padding: 0;
    margin: 0;
    line-height: 55px;
    font-size: 38px;
    font-family: 'Roboto';
    font-weight: 300;
    animation: plus-out 0.3s;
    transition: all 0.3s;
  }
  
  #container-floating{
    position: fixed;
    width: 70px;
    height: 70px;
    bottom: 30px;
    right: 30px;
    z-index: 50px;
  }
  
  #container-floating:hover{
    height: 400px;
    width: 90px;
    padding: 30px;
  }
  
  #container-floating:hover .plus{
    animation: plus-in 0.15s linear;
    animation-fill-mode: forwards;
  }
  
  .edit{
    position: absolute;
    top: 0;
    display: block;
    bottom: 0;
    left: 0;
    display: block;
    right: 0;
    padding: 0;
    opacity: 0;
    margin: auto;
    line-height: 65px;
    transform: rotateZ(-70deg);
    transition: all 0.3s;
    animation: edit-out 0.3s;
  }
  
  #container-floating:hover .edit{
    animation: edit-in 0.2s;
     animation-delay: 0.1s;
    animation-fill-mode: forwards;
  }
  
  @keyframes edit-in{
      from {opacity: 0; transform: rotateZ(-70deg);}
      to {opacity: 1; transform: rotateZ(0deg);}
  }
  
  @keyframes edit-out{
      from {opacity: 1; transform: rotateZ(0deg);}
      to {opacity: 0; transform: rotateZ(-70deg);}
  }
  
  @keyframes plus-in{
      from {opacity: 1; transform: rotateZ(0deg);}
      to {opacity: 0; transform: rotateZ(180deg);}
  }
  
  @keyframes plus-out{
      from {opacity: 0; transform: rotateZ(180deg);}
      to {opacity: 1; transform: rotateZ(0deg);}
  }
  
  .nds{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    position: fixed;
    z-index: 300;
    transform:  scale(0);
    cursor: pointer;
  }
  
  .nd1{
    background: #FF5733;
    right: 40px;
    bottom: 120px;
    animation-delay: 0.2s;
      animation: bounce-out-nds 0.3s linear;
    animation-fill-mode:  forwards;
  }
  
  .nd3{
    background: #6C3483;
    right: 40px;
    bottom: 180px;
    animation-delay: 0.15s;
      animation: bounce-out-nds 0.15s linear;
    animation-fill-mode:  forwards;
  }
  
  .nd4{
    background: #ba68c8;
    right: 40px;
    bottom: 240px;
    animation-delay: 0.1s;
      animation: bounce-out-nds 0.1s linear;
    animation-fill-mode:  forwards;
  }
  
  .nd5{
    background: #DAF7A6;
    right: 40px;
    bottom: 300px;
    animation-delay: 0.08s;
    animation: bounce-out-nds 0.1s linear;
    animation-fill-mode:  forwards;
  }
  
  @keyframes bounce-nds{
      from {opacity: 0;}
      to {opacity: 1; transform: scale(1);}
  }
  
  @keyframes bounce-out-nds{
      from {opacity: 1; transform: scale(1);}
      to {opacity: 0; transform: scale(0);}
  }
  
  #container-floating:hover .nds{
    
    animation: bounce-nds 0.1s linear;
    animation-fill-mode:  forwards;
  }
  
  #container-floating:hover .nd3{
    animation-delay: 0.08s;
  }
  #container-floating:hover .nd4{
    animation-delay: 0.15s;
  }
  #container-floating:hover .nd5{
    animation-delay: 0.2s;
  }
  
  .letter{
    font-size: 23px;
    font-family: 'Roboto';
    color: white;
    position: absolute;
    left: 0;
    right: 0;
    margin: 0;
    top: 0;
    bottom: 0;
    text-align: center;
    line-height: 40px;
  }
  
  .reminder{
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    top: 0;
    bottom: 0;
    line-height: 40px;
  }
  
  .profile{
    border-radius: 50%;
    width: 40px;
    position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
    right: 20px;
  }
  
  </style>
  
  </head>
  