<?php 
$uid = $_GET['uid'];

$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');
$sql = 'SELECT * FROM users WHERE uid=?';
try {
	$stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->bindValue(1, $uid, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
}
catch (PDOException $e) {
	print $e->getMessage();
}
?>
<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper">
			<h1>Edit User</h1>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width6 first">					

					<h3>Edit <?php echo $row['uid']; ?></h3>
                    
					<?php if($status == 1) : ?>
                    <div class="box box-info">The user has been added.</div>
                    <?php elseif($status == 2) : ?>
                    <div class="box box-error">There were errors in your form. Please check the information and try again.</div>
                    <?php endif; ?>
                    
					<form id="editUser" method="post" action="../bin/user-control/edit.php">

						<fieldset>
							<legend>User Details</legend>
							<p>
                            <label for="fullName">Full Name:</label><br/>
    							<input type="hidden" id="fullName" class="half" value="<?php echo $row['fullName']; ?>" name="fullName"/><?php echo $row['fullName']; ?>
							</p>
                            <p>
								<label for="uid">Username:</label><br/>
								<input type="hidden" id="uid" class="half" value="<?php echo $row['uid']; ?>" name="uid"/><?php echo $row['uid']; ?>
							</p>
                            
                            <p>
                            	<label for="email">E-Mail Address:</label><br />
                                <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" />
                            </p>
                            
                            <p>
                            	<label class="required" for="level">User Level:</label><br />
                                <select name="level" id="level">
                                	<option value="2" <?php if($row['level'] == 2) { echo 'selected="selected"'; } ?>>General User</option>
                                    <option value="3" <?php if($row['level'] == 3) { echo 'selected="selected"'; } ?>>Admin</option>
                                </select>
                            </p>
                            
                            <p>
                            	<label for="notes">Notes:</label><br />
                                <textarea id="notes" class="full wysiwyg" name="notes"><?php echo $row['notes']; ?></textarea>                              
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
							<dt><img width="16" height="16" alt="Basic styles" src="https://dacc-online.com/template/img/information.png"></dt>
							<dd>Required Fields</dd>
							<dd class="last">All fields are required except for email and notes.</dd>					
							
							<dt><img width="16" height="16" alt="Form validation" src="https://dacc-online.com/template/img/information.png"></dt>
							<dd>Acceptable Characters for password</dd>
							<dd class="last">Any letter, number, or the following characters; - ! @ _ +</dd>
                            
                            <dt><img width="16" height="16" alt="Form validation" src="https://dacc-online.com/template/img/error.png"></dt>
							<dd>Do not use the following characters!</dd>
							<dd class="last">: ; / \ | * ^ % $ # ( ) =</dd>
                            
                            <dt><img width="16" height="16" alt="Form validation" src="https://dacc-online.com/template/img/error.png"></dt>
							<dd>Notes</dd>
							<dd class="last">Notes will only be seen by admin users.</dd>						
						</dl>
                        <header>
							<h3>User Levels</h3>
						</header>
						<dl class="first">
							<dt><img width="16" height="16" alt="Basic styles" src="https://dacc-online.com/template/img/information.png"></dt>
							<dd>Admin</dd>
							<dd class="last">Should only be assigned 1 person. This user can add, edit, or delete path logs and users.</dd>					
							
							<dt><img width="16" height="16" alt="Form validation" src="https://dacc-online.com/template/img/information.png"></dt>
							<dd>General User</dd>
							<dd class="last">Can create and print path logs.</dd>
                            
                            <dt><img width="16" height="16" alt="Form validation" src="https://dacc-online.com/template/img/information.png"></dt>
					
						</dl>
					</div>
				</aside>
				<!-- End of Right column/section -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->