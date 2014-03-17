<?php 
	$error = $_GET['error'];
	
	$dbh = new PDO('mysql:host=localhost;dbname=vault, 'root', '');
	
	$uid = $_POST['uid'];
	
	$sth = $dbh->prepare("SELECT secQ1, secQ2 FROM users WHERE uid = ?");
	$sth->bindParam(1, $uid, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	
	if($result == null) {
		#echo 'That username was not found!';
		header('Location: http://localhost/reset-pass/1');
	} else {
		$dbQ1 = $result['secQ1'];
		$dbQ2 = $result['secQ2'];
		$dbA1 = $result['secA1'];
		$dbA2 = $result['secA2'];
	}
	
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
					
                    <?php if($dbQ1 == '' || $dbQ2 == '') { ?>
						<h3>Please have an administrator assist you in modifying your account as you have not set your security questions for the pass reset form.</h3>
                        <h3>If you feel this is in error please contact <a href="http://bb-communications.com/">B&amp;B Communications, Inc.</a></h3>
                    <?php } else { ?>
					<h3>Reset Password</h3>
					<?php if($error === 1) {?><div class="box box-error">That username was not found. Please <a href="javascript:history.go(-1)">go back</a> and try again.</div>
                    <?php } elseif($error === 2) { ?><div class="box box-error">Your answers do not match our records. Ensure that you have not misspelled any words and try again.</div>
					<?php } else { ?><div class="box box-info">Use the form below to reset your password.</div><?php } ?>

					<form id="emailform" method="post" action="http://localhost/bin/user-control/reset.php">
						<div class="box">
							<p>
								<label for="q1">
								<?php if($dbQ1 == 1) : ?>What is your mother's maiden name?
								<?php elseif($dbQ1 == 2) : ?>What was your first car?
                                <?php elseif($dbQ1 == 3) : ?>What is your favorite pet's name?
                                <?php elseif($dbQ1 == 4) : ?>What is your favorite color?
                                <?php elseif($dbQ1 == 5) : ?>What is your favorite city?
                                <?php elseif($dbQ1 == 6) : ?>What is your favorite food?
                                <?php endif; ?>
								</label><br/>
								<input type="text" id="q1" class="full" value="" name="q1"/>
							</p>
                            <p>
								<label for="q1">
								<?php if($dbQ2 == 1) : ?>What is your mother's maiden name?
								<?php elseif($dbQ2 == 2) : ?>What was your first car?
                                <?php elseif($dbQ2 == 3) : ?>What is your favorite pet's name?
                                <?php elseif($dbQ2 == 4) : ?>What is your favorite color?
                                <?php elseif($dbQ2 == 5) : ?>What is your favorite city?
                                <?php elseif($dbQ2 == 6) : ?>What is your favorite food?</option>
                                <?php endif; ?>
								</label><br/>
								<input type="text" id="q2" class="full" value="" name="q2"/>
							</p>
							<p>
								<input type="submit" class="btn" value="Reset Pass"/>
							</p>
                            <input type="hidden" name="uid" value="<?php echo $_POST['uid']; ?>" />
                            <input type="hidden" name="hash" value="<?php echo sha1('salt'); ?>" />
						</div>
					</form>
					<?php } ?>
				</section>
				<!-- End of login form -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->
	
	<!-- Page footer -->
	<footer id="bottom">
		<div class="wrapper-login">
			<p>Copyright &copy; 2010 <b><a href="http://www.newbernderm.com/">Dermatology Associates of Costal Carolina</a></b>
		</div>
	</footer>
	<!-- End of Page footer -->

<!-- User interface javascript load -->
<script type="text/javascript" src="http://localhost/template/js/administry.js"></script>
</body>
</html>