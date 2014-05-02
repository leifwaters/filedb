<?php
require_once('class.usercontrol.php');

$auth = new UserControl(0);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Reset Your Password</title>
</head>
<body>
	<h1>Your password has expired</h1>
	<p>In order to comply with HIPPA regulations your password must be reset every 30 days. Do not use the same password.</p>

	<form action="">
		<p>
			<label for="new_pass">New Password</label><br />
			<input type="password" name="new_pass" />
		</p>

		<p>
			<label for="confirm_pass">Confirm New Password</label><br />
			<input type="password" name="confirm_pass" />
		</p>

		<input type="submit" name="reset_pass" value="Reset Pass" />
	</form>
</body>
</html>