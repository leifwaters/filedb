<?php 
	$error = $_GET['error'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Employee Login | DACC Path Log</title>
<meta name="description" content="DACC Path Log" />
<!-- Favicons --> 
<link rel="shortcut icon" type="image/png" href="http://localhost/template/img/favicons/favicon.png"/>
<link rel="icon" type="image/png" href="http://localhost/template/img/favicons/favicon.png"/>
<link rel="apple-touch-icon" href="http://localhost/template/img/favicons/apple.png" />
<!-- Main Stylesheet --> 
<link rel="stylesheet" href="http://localhost/template/css/style.css" type="text/css" />
<!-- Your Custom Stylesheet --> 
<link rel="stylesheet" href="http://localhost/template/css/custom.css" type="text/css" />
<!-- jQuery with plugins -->
<script type="text/javascript" src="http://localhost/template/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="http://localhost/template/js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="http://localhost/template/js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="http://localhost/template/js/jquery.ui.tabs.min.js"></script>
<!-- jQuery tooltips -->
<script type="text/javascript" src="http://localhost/template/js/jquery.tipTip.min.js"></script>
<!-- Superfish navigation -->
<script type="text/javascript" src="http://localhost/template/js/jquery.superfish.min.js"></script>
<script type="text/javascript" src="http://localhost/template/js/jquery.supersubs.min.js"></script>
<!-- jQuery form validation -->
<script type="text/javascript" src="http://localhost/template/js/jquery.validate_pack.js"></script>
<!-- jQuery popup box -->
<script type="text/javascript" src="http://localhost/template/js/jquery.nyroModal.pack.js"></script>
<!-- Internet Explorer Fixes --> 
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="http://localhost/template/css/ie.css"/>
<script src="http://localhost/template/js/html5.js"></script>
<![endif]-->
<!--Upgrade MSIE5.5-7 to be compatible with MSIE8: http://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE8.js -->
<!--[if lt IE 8]>
<script src="http://localhost/template/js/IE8.js"></script>
<![endif]-->
<script type="text/javascript">

$(document).ready(function(){
	
	/* setup navigation, content boxes, etc... */
	Administry.setup();
	
	// validate signup form on keyup and submit
	var validator = $("#loginform").validate({
		rules: {
			username: "required",
			password: "required"
		},
		messages: {
			username: "Enter your username",
			password: "Provide your password"
		},
		// the errorPlacement has to take the layout into account
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent().find('label:first'));
		},
		// set new class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("ok");
		}
	});

});
</script>
</head>
<body>
	<!-- Header -->
	<header id="top">
		<div class="wrapper-login">
			<!-- Title/Logo - can use text instead of image -->
			<div id="title"><img src="http://localhost/template/img/logo.png" alt="DACC Path Log" /><!--<span>DACC Path Log</span>--></div>
		</div>
	</header>
	<!-- End of Header -->
	<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper-login"></div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper-login">
				<!-- Login form -->
				<section class="full">					
					
					<h3>Login</h3>
					
					<?php if($error == 1) { ?><div class="box box-error closeable">That username was not found. Please try again.</div>
					<?php } elseif($error == 2) { ?><div class="box box-error closeable">Your password is incorrect. Please try again.</div>
                    <?php } elseif($error == 3) { ?><div class="box box-error closeable">You must login before you can access that area.</div>
                    <?php } elseif($error == 99) { ?><div class="box box-error closeable">You have been directed here due to an invalid access of files.</div>
                    <?php } elseif($error == 4) { ?><div class="box box-error closeable">You were logged out due to inactivity.</div>
					<?php } else { ?><div class="box box-warning closeable">This site is for employees of Dermatology Associates of Coastal Carolina. Please visit <a href="http://www.newbernderm.com/">our website</a> if you are not an employee.</div><?php } ?>

					<form id="loginform" method="post" action="http://localhost/bin/user-control/login.php">

						<p>
							<label class="required" for="uid">Username:</label><br/>
							<input type="text" id="uid" class="full" value="" name="uid"/>
						</p>
						
						<p>
							<label class="required" for="pass">Password:</label><br/>
							<input type="password" id="pass" class="full" value="" name="pass"/>
						</p>
						
						<p>
							<input type="submit" class="btn btn-green big" value="Login"/> &nbsp; <a href="javascript: //;" onclick="$('#emailform').slideDown(); return false;">Forgot password?</a>
						</p>
						<div class="clear">&nbsp;</div>

					</form>
					
					<form id="emailform" style="display:none" method="post" action="http://localhost/reset-pass">
						<div class="box">
                        	<p>
								<label for="uid">What is your user name?</label><br/>
								<input type="text" id="uid" class="full" value="" name="uid"/>
							</p>
							<p>
								<input type="submit" class="btn" value="Reset Pass"/>
							</p>
						</div>
					</form>
					
				</section>
				<!-- End of login form -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->
	
	<!-- Page footer -->
	<footer id="bottom">
		<div class="wrapper-login">
			<p>Copyright &copy; 2010 <b><a href="http://www.newbernderm.com/">Dermatology Associates of Coastal Carolina</a></b>
		</div>
	</footer>
	<!-- End of Page footer -->

<!-- User interface javascript load -->
<script type="text/javascript" src="http://localhost/template/js/administry.js"></script>
</body>
</html>