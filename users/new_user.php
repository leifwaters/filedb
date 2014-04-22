<?php
require_once('class.usercontrol.php');

$auth = new UserControl(0);

if($_POST) {
	if(isset($_POST['baduser'])) {
		$user = $_POST['username'];
	} else {
		$user = null;
	}
	$auth->create_user($_POST['password'], $_POST['passwordConfirm'], $_POST['firstName'], $_POST['lastName'], $_POST['level'], $user);
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>New User</title>
</head>
<body>
	<?php if($auth->getSuccess() !== false) : ?>
	<div class="success">
		<?php
		foreach($auth->getSuccess() as $success) {
			echo $success .'<br />';
		}
		?>
	</div>
	<?php endif; ?>

	<?php if($auth->getErrors() !== false) : ?>
	<div class="errors">
		<?php
		foreach($auth->getErrors() as $error) {
			echo $error .'<br />';
		}
		?>
	</div>
	<?php endif; ?>

	<h1>New User</h1>
	<form action="" method="post">

		<?php if($auth->showUserField !== null) : ?>
		<p>
			<label for="username">Username:</label><br />
			<input type="text" name="username" value="<?php echo $auth->showUserField; ?>" />
			<input type="hidden" name="baduser" value="true" />
		</p>
		<?php endif; ?>

		<p>
			<label for="firstName">First Name:</label><br />
			<input type="text" name="firstName" value="<?php echo @$_POST['firstName']; ?>" />
		</p>

		<p>
			<label for="lastName">Last Name:</label><br />
			<input type="text" name="lastName" value="<?php echo @$_POST['lastName']; ?>" />
		</p>

		<p>
			<label for="password">Password:</label><br />
			<input type="password" name="password" />
		</p>

		<p>
			<label for="passwordConfirm">Confirm Password:</label><br />
			<input type="password" name="passwordConfirm" />
		</p>

		<p>
			<label for="level">User Level:</label>
			<br />
			<select name="level" id="">
				<option value="1">Read Only</option>
				<option value="10">Mid-Level</option>
				<option value="50">Department Head</option>
				<option value="75">Manager</option>
				<option value="100" disabled="disabled">SU</option>
			</select>
		</p>

		<input type="submit" name="addUser" value="Add User" />
	</form>
</body>
</html>