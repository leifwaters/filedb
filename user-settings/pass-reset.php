<?php @$error = $_GET['error']; ?>
<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper">
			<h1>Password Has Been Reset</h1>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width6 first">					

					<h3>Password Reset Completed</h3>
                    
                    <?php if($error == 1) : ?>
                    <div class="box box-error">You reset your password and did not set a new password. Please do so now.</div>
                    <?php elseif($error == 2) : ?>
                    <div class="box box-error">Your password has expired. Please set a new password now.</div>
                    <?php else : ?>
					<div class="box box-info">Set your new password here.</div>
                    <?php endif; ?>
					
					<form id="passreset" method="post" action="https://dacc-online.com/bin/user-control/newpass.php">

						<fieldset>
							<legend>Reset Credentials</legend>
							
							<p>
								<label class="required" for="password">Password:</label><br/>
								<input type="password" id="password" class="half" value="" name="password"/>
							</p>

							<p>
								<label class="required" for="password_confirm">Confirm password:</label><br/>
								<input type="password" id="password_confirm" class="half" value="" name="password_confirm"/>
							</p>
							
							<p class="box"><input type="submit" class="btn btn-green big" value="Save New Password"/></p>

						</fieldset>

					</form>
				
				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2">
					<div id="rightmenu">
						<header>
							<h3>Password Requirements</h3>
						</header>
						<dl class="first">
							<dt><img width="16" height="16" alt="Basic styles" src="https://dacc-online.com/template/img/information.png"></dt>
							<dd><a href="styles.html">Length</a></dd>
							<dd class="last">at least 5 characters long</dd>							
							
							<dt><img width="16" height="16" alt="Form validation" src="https://dacc-online.com/template/img/information.png"></dt>
							<dd><a href="http://docs.jquery.com/Plugins/Validation">Acceptable Characters</a></dd>
							<dd class="last">Any letter, number, or the following characters: - ! @ _ +</dd>
                            
                            <dt><img width="16" height="16" alt="Form validation" src="https://dacc-online.com/template/img/error.png"></dt>
							<dd><a href="http://docs.jquery.com/Plugins/Validation">Do not use the following characters!</a></dd>
							<dd class="last">: ; / \ | * ^ % $ # ( ) =</dd>							
						</dl>
					</div>
				</aside>
				<!-- End of Right column/section -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->