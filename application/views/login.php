<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>JasPri ERP v0.1</title>

	<!--- CSS --->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_form/style.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
        <p style="text-align:center; color:#F00; font-size:18px;"><?php if(isset($msg)): echo $msg; endif; ?></p>
        <form action="<?php echo base_url();?>index.php/home/processlogin" method="post" name="frmLogin" id="frmLogin">
    <div class="login">LOGIN</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" name="user" />
				</div>
				<div class="password-field">
					<input type="password" name="passwd" />
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Remember me</label>
				<div class="forgot-usr-pwd">Forgot <a href="#">username</a> or <a href="#">password</a>?</div>
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
        <div id="footer" style="color:#FF0000;"></div>
		<div id="footer">Copyright @ 2014 by JasPri ERP</div>
</body>
</html>
