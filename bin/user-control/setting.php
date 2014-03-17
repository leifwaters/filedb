<?php
$uid = $_COOKIE['DACC'];
#echo 'Username: '.$uid;
try {
	$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');
	
	$email = $_POST['email'];
	$color = $_POST['color'];
	$secQ1 = $_POST['secQ1'];
	$secA1 = $_POST['secA1'];
	$secQ2 = $_POST['secQ2'];
	$secA2 = $_POST['secA2'];
	
	$sth = $dbh->prepare("UPDATE users SET email=?, color=?, secQ1=?, secQ2=?, secA1=?, secA2=?, reset=? WHERE uid = ?");
	$sth->bindParam(1, $email, PDO::PARAM_STR);
	$sth->bindParam(2, $color, PDO::PARAM_INT);
	$sth->bindParam(3, $secQ1, PDO::PARAM_INT);
	$sth->bindParam(4, $secQ2, PDO::PARAM_INT);
	$sth->bindParam(5, $secA1, PDO::PARAM_STR);
	$sth->bindParam(6, $secA2, PDO::PARAM_STR);
	$sth->bindValue(7, '0');
	$sth->bindParam(8, $uid, PDO::PARAM_STR);
	$sth->execute();
	
	$sth = null;
	
	setcookie('ColorSet', $color, time()+157000000, '/', '192.168.10.2');
	
	header('Location: https://localhost/user-settings/settings/2');
	
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br />";
	die();
}


?>