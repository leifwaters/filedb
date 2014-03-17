<?php $status = $_GET['status']; ?>
<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper">
			<h1>Add A User</h1>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width6 first">					

					<h3>Add A User</h3>
                    
					<?php if($status == 1) : ?>
                    <div class="box box-info">The user has been added.</div>
                    <?php elseif($status == 2) : ?>
                    <div class="box box-error">There were errors in your form. Please check the information and try again.</div>
                    <?php endif; ?>
                    
					<form id="addUser" method="post" action="../bin/user-control/add.php">

						<fieldset>
							<legend>User Details</legend>
							<p>
								<label class="required" for="uid">Username: (This can NOT be changed later!)</label><br/>
								<input type="text" id="uid" class="half" value="" name="uid"/>
							</p>
                            
                            <p>
                            	<label class="required" for="fullName">Full Name</label><br />
                                <input class="half" type="text" name="fullName" id="fullName" />
                            </p>
                            
							<p>
								<label class="required" for="pass">Password:</label><br/>
								<input type="password" id="pass" class="half" value="" name="pass"/>
							</p>

							<p>
								<label class="required" for="password_confirm">Confirm password:</label><br/>
								<input type="password" id="password_confirm" class="half" value="" name="password_confirm"/>
							</p>
                            
                            <p>
                            	<label for="email">E-Mail Address:</label><br />
                                <input class="half" type="text" name="email" id="email" />
                            </p>
                            
                            <p>
                            	<label class="required" for="level">User Level:</label><br />
                                <select name="level" id="level">
                                	<option value="2">General User</option>
                                    <option value="3">Admin</option>
                                </select>
                            </p>
                            
                            <p>
                            	<label for="notes">Notes:</label><br />
                                <textarea id="notes" class="full wysiwyg" name="notes"></textarea>                              
                            </p>
							
							<p class="box"><input type="submit" class="btn btn-green big" value="Add User"/></p>

						</fieldset>

					</form>
				
				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2">
					<div id="rightmenu">
						<header>
							<h3>Notes</h3>
						</header>
						<dl class="first">
							<dt><img width="16" height="16" alt="Basic styles" src="http://localhost/template/img/information.png"></dt>
							<dd>Required Fields</dd>
							<dd class="last">All fields are required except for email and notes.</dd>					
							
							<dt><img width="16" height="16" alt="Form validation" src="http://localhost/template/img/information.png"></dt>
							<dd>Acceptable Characters for password</dd>
							<dd class="last">Any letter, number, or the following characters; - ! @ _ +</dd>
                            
                            <dt><img width="16" height="16" alt="Form validation" src="http://localhost/template/img/error.png"></dt>
							<dd>Do not use the following characters!</dd>
							<dd class="last">: ; / \ | * ^ % $ # ( ) =</dd>
                            
                            <dt><img width="16" height="16" alt="Form validation" src="http://localhost/template/img/error.png"></dt>
							<dd>Notes</dd>
							<dd class="last">Notes will only be seen by admin users.</dd>						
						</dl>
                        <header>
							<h3>User Levels</h3>
						</header>
						<dl class="first">
							<dt><img width="16" height="16" alt="Basic styles" src="http://localhost/template/img/information.png"></dt>
							<dd>Admin</dd>
							<dd class="last">Should only be assigned 1 person. This user can add, edit, or delete path logs and users.</dd>					
							
							<dt><img width="16" height="16" alt="Form validation" src="http://localhost/template/img/information.png"></dt>
							<dd>General User</dd>
							<dd class="last">Can create and print path logs.</dd>
                            					
						</dl>
					</div>
				</aside>
				<!-- End of Right column/section -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->