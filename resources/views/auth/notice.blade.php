
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<style>
body,table {
    font-family: "Montserrat","Montserrat", "Montserrat", Helvetica, Arial, sans-serif;
  font-size: 15px;
  color: #000000;
  background-color: transparent;
  -webkit-font-smoothing: antialiased;
}
.maindiv {
	width: 900px;
	margin: 0px auto;
	border-radius: 2px;
	text-align: justify;
	margin-top: 5%;
}

.tfabutton {
	background-color: #6DA60A;
	border: 1px solid #65990B;
	color: #FFFFFF;
	font-size: 14px;
	padding: 6px 14px;
	text-decoration: none;
}

.cancelbutton {
	background-color: #CACACA;
	font-size: 14px;
	padding: 6px 14px;
	text-decoration: none;
	color:#333;
	margin-left: 5px;
	border: 1px solid #c3c3c3;
}
.cancelbutton1 {
	background-color: #CACACA;
	font-size: 14px;
	padding: 6px 14px;
	text-decoration: none;
	color:#333;
	margin-left: 5px;
	border: 1px solid #c3c3c3;
}

.continuelink {
	text-decoration: underline;
	color: #0483C8;
	margin-left: 30px;
}

.mobileimage {
background: rgba(0, 0, 0, 0) url("https://img.zohostatic.com/iam/m4006.17/images/banner-icons.png") no-repeat scroll -12px -8px;
    display: inline-block;
    height: 192px;
    margin-left: 5px;
    margin-top: 34px;
    width: 192px;
}
.saveBtn {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #5ac7f0;
    border-color: #47b0d8 #47b0d8 #2c8fb4;
    border-image: none;
    border-radius: 2px;
    border-style: solid;
    border-width: 1px;
    color: #fff;
    cursor: pointer;
    font-size: 13px;
    padding: 5px 10px;
    position: relative;
    text-align: center;
    margin-right: 6px;
    text-decoration:none;
}
.saveBtn:hover, .saveBtn:focus ,.minisaveBtn:hover, .minisaveBtn:focus {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #55c0e8;
    border-color: #47b0d8 #47b0d8 #2c8fb4;
    border-image: none;
    border-style: solid;
    border-width: 1px;
    color:#fff;
	text-decoration:none;
}
.cancelBtn {
	-moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #e4e4e4;
    border-color: #e4e4e4 #e4e4e4 #bbbbbb;
    border-image: none;
    border-radius: 2px;
    border-style: solid;
    border-width: 1px;
    color: #141823;
    cursor: pointer;
    font-size: 13px;
    padding: 5px 10px;
    text-align: center;
    margin-right: 6px;
    text-decoration:none;
}
.cancelBtn:hover, .cancelBtn:focus ,.minicancelBtn:hover, .minicancelBtn:focus {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #e0e0e0;
    border-color: #d4d4d4 #d4d4d4 #bbbbbb;
    border-image: none;
    border-style: solid;
    border-width: 1px;
}
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 300;
  src: local('Montserrat Light'), local('Montserrat-Light'), url(../app-assets/fonts/masfont.woff2) format('woff2');
  unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
.title-banner{
  font-size: 24px;
  width: 185px;
  text-align: right;
  line-height: 45px;
  }
</style>
<script type='text/javascript'>
	function redirect() {
		window.location.href = '';
		return;
	}
</script>
</head>
<body>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0">
<tr><td valign="top" style="height:40px;">
	<header>
<div style="height:40px;margin:0px auto;border-bottom:1px solid #c5c8ca;box-shadow:0px 3px 0px #e8ebee;">

    <div style="float:right;padding:0px;margin:0px;">
		<div style="font-size:11px;color:#000;text-decoration:none;">
	    	<ul style="list-style: none; float: right; *padding-top:10px;">
				<li style="float: left; margin-right: 20px;"><a href="/auth/login" title="Home" style="color:#085DDC;text-decoration:none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">Home</a></li>
				<li style="float: left; margin-right: 20px;"><a href="#" title="Frequently Asked Questions" style="color:#085DDC;text-decoration:none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">FAQ</a></li>
	    	</ul>
		</div>
    </div>
</div>
	</header>
</td></tr>
<tr>
<td valign="top">
<div class="maindiv">
	<div style="border-right:1px solid #8d8d8d;width: 235px;float: left;"><div class='title-banner'>Stronger security for your {{ $company->name }} Account</div>
		<div class="mobileimage"></div>
	</div>
<div style="margin:0px 0 0 282px;">
<div style="width: 600px;line-height: 22px;float: left;">
<div style="margin-top: 20px;">Hi <span style="font-weight:bold;">{{ Auth::user()->getNameOrUsername() }}</span></div>
<div style="margin-top: 10px;">At {{ $company->legal_name }} , we take account security very seriously. Here is how to make it hard for your {{ $company->name }}  user account to fall into wrong hands.</div>
<div style="margin-top: 10px;">For your security, we recommend that you don't reuse passwords associated with your email address or any other type of account. Additionally, if you enter your original password as your new password, you may trigger an error message. Create an entirely new password from the default given</div>

<div style="clear: both;margin-top: 50px;">
<a href="/password/reset" target="_blank" class="saveBtn">Set up password</a>
<input type="hidden" name="_token" value="{{ Session::token() }}">
<a href="#" class="cancelBtn">Remind me Later</a>
</div>
<div style=" margin: 19px auto 100px; "><a href="/edit-user/{{ Crypt::encrypt(Auth::user()->getID()) }}">Skip Two Factor Authentication</a></div>
</div>
</div>
</div>
</td></tr>
<tr><td valign="bottom">
	<footer>
<div style="font-size:10px;text-align:center;padding:5px 0px;">
			&copy;&nbsp;{{ date('Y') }},&nbsp;<a href="#" title="OmniLabsGh Corp." target="_blank" style="font-size:11px;color:#085ddc;">{{ $company->name }} .</a>&nbsp;All rights reserved.
</div>	</footer>
</td></tr>
</table>
</body>
</html>