<?php
@$status = $_GET['status'];
#Comment out when testing is done!
error_reporting(E_ALL);
  try {
	  $dbh = new PDO('mysql:host=dacc.db.6725841.hostedresource.com;dbname=dacc', 'dacc', 'MIchael93');
	  
	  $uid = $_COOKIE['DACC'];
  
	  $sth = $dbh->prepare("SELECT * FROM users WHERE uid = ?");
	  $sth->bindParam(1, $uid, PDO::PARAM_STR);
	  $sth->execute();
	  $result = $sth->fetch(PDO::FETCH_ASSOC);
	  
	  $email = $result['email'];
	  
	  $dbh = null;
  } catch (PDOException $e) {
	  print "Error!: " . $e->getMessage() . "<br />";
	  die();
  }

	?>
    <!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper">
			<h1>User Settings</h1>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width6 first">		

					<h3>User Details</h3>
                    
                    <?php if($status == 1) : ?>
                    <div class="box box-info">You password has been changed.</div>
                    <?php elseif($status == 2) : ?>
                    <div class="box box-info">Your settings have been changed.</div>
                    <?php elseif($status == 3) : ?>
                    <div class="box box-info">You have to set your security questions.</div>
                    <?php else : ?>
					<div class="box box-info">If you want to change your password, please click <a href="https://dacc-online.com/user-settings/pass-reset">here</a>.</div>
                    <?php endif; ?>	
					
					<form id="sampleform" method="post" action="https://dacc-online.com/bin/user-control/setting.php">

						<fieldset>

							<p>
								<label for="username">Username:</label><br/>
								<input type="text" id="username" class="half" value="<?php echo $_COOKIE['DACC']; ?>" name="username" disabled="disabled"/>
							</p>

							<p>
								<label for="email">Email address:</label><br/>
								<input type="text" id="email" class="half" value="<?php echo $result['email']; ?>" name="email"/>
							</p>
                            
                            <p>
                            	<label for="secQ1">Choose a security question</label><br />
                                <select name="secQ1" id="secQ1" onchange="Administry.removeOption();">
                                	<option disabled="disabled">Please Choose One</option>
                                	<option <?php if($result['secQ1'] == 1): ?>selected="selected" <?php endif; ?>value="1">What is your mother's maiden name?</option>
                                    <option <?php if($result['secQ1'] == 2): ?>selected="selected" <?php endif; ?>value="2">What was your first car?</option>
                                    <option <?php if($result['secQ1'] == 3): ?>selected="selected" <?php endif; ?>value="3">What is your favorite pet's name?</option>
                                    <option <?php if($result['secQ1'] == 4): ?>selected="selected" <?php endif; ?>value="4">What is your favorite color?</option>
                                    <option <?php if($result['secQ1'] == 5): ?>selected="selected" <?php endif; ?>value="5">What is your favorite city?</option>
                                    <option <?php if($result['secQ1'] == 6): ?>selected="selected" <?php endif; ?>value="6">What is your favorite food?</option>
                                </select>
                            </p>
                            
                            <p>
                            	<label for="secA1">Answer to security question 1</label><br />
                                <input type="text" id="secA1" name="secA1" class="half" value="<?php echo $result['secA1']; ?>" />
                            </p>
                            
                            <p>
                            	<label for="secQ2">Choose a security question</label><br />
                                <select name="secQ2" id="secQ2">
                                	<option disabled="disabled">Please Choose One</option>
                                	<option <?php if($result['secQ2'] == 1): ?>selected="selected" <?php endif; ?>value="1">What is your mother's maiden name?</option>
                                    <option <?php if($result['secQ2'] == 2): ?>selected="selected" <?php endif; ?>value="2">What was your first car?</option>
                                    <option <?php if($result['secQ2'] == 3): ?>selected="selected" <?php endif; ?>value="3">What is your favorite pet's name?</option>
                                    <option <?php if($result['secQ2'] == 4): ?>selected="selected" <?php endif; ?>value="4">What is your favorite color?</option>
                                    <option <?php if($result['secQ2'] == 5): ?>selected="selected" <?php endif; ?>value="5">What is your favorite city?</option>
                                    <option <?php if($result['secQ2'] == 6): ?>selected="selected" <?php endif; ?>value="6">What is your favorite food?</option>
                                </select>
                            </p>
                            
                            <p>
                            	<label for="secA2">Answer to security question 1</label><br />
                                <input type="text" id="secA2" name="secA2" class="half" value="<?php echo $result['secA2']; ?>" />
                            </p>
                            
                            <p>
                            	<label for="color">Color Scheme: <small>Default is blue</small></label>
                                <select name="color">
                                	<option value="6">Blue</option>
                                	<option <?php if(@$_COOKIE['ColorSet'] == 1) : ?>selected="selected"<?php endif; ?> value="1">Brown</option>
                                    <option <?php if(@$_COOKIE['ColorSet'] == 2) : ?>selected="selected"<?php endif; ?>value="2">Gray</option>
                                    <option <?php if(@$_COOKIE['ColorSet'] == 3) : ?>selected="selected"<?php endif; ?>value="3">Green</option>
                                    <option <?php if(@$_COOKIE['ColorSet'] == 4) : ?>selected="selected"<?php endif; ?>value="4">Pink</option>
                                    <option <?php if(@$_COOKIE['ColorSet'] == 5) : ?>selected="selected"<?php endif; ?>value="5">Red</option>
                                </select>
                             </p>
							
							<p class="box"><input type="submit" class="btn btn-green big" value="Validate"/> or <input type="reset" class="btn" value="Reset"/></p>

						</fieldset>

					</form>
				</section>
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->