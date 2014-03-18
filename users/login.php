<?php
require_once('class.usercontrol.php');

$auth = new UserControl(0, 'login');

if($_POST) {
	$auth->login($_POST['username'], $_POST['password'], 'admin.php');
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>

	<?php if($auth->getErrors() !== false) : ?>
	<div class="errors">
		<?php
		foreach($auth->getErrors() as $error) {
			echo $error .'<br />';
		}
		?>
	</div>
	<?php endif; ?>

	<form action="" method="post">
		<p>
			<label for="username">Username:</label>
			<br />
			<input type="text" name="username" />
		</p>
		<p>
			<label for="password">Password:</label>
			<br />
			<input type="password" name="password" />
		</p>
		<input type="submit" name="login" value="Login" />
	</form>
</body>
</html>