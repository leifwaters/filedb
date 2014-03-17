<?php
$uid = $_COOKIE['DACC'];
try {
	$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');
	
	$pass = sha1($_POST['password']);
	$passExp = date('Y-m-d', strtotime('+1 month'));

	$sth = $dbh->prepare("UPDATE users SET pass=?, reset=0, passDate=? WHERE uid = ?");
	$sth->bindParam(1, $pass, PDO::PARAM_STR);
	$sth->bindParam(2, $passExp, PDO::PARAM_STR);
	$sth->bindParam(3, $uid, PDO::PARAM_STR);
	$sth->execute();
	
	$dbh = null;
	
	header('Location: /user-settings/settings/1');
	
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br />";
	die();
}

?>