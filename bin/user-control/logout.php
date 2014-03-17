<?php
#Comment out when testing is done!
#error_reporting(E_ALL);

@$uid = $_COOKIE['DACC'];
$deadSession = $_GET['sessDie'];

try {
    $dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');
	date_default_timezone_set('America/New_York');
	$time = date('h:ia');
	$date = date('m/d/Y');
	$log = 'Logged Out';
	
	setcookie('DACC', '', time()-3600, '/', '192.168.10.2');
	setcookie('DACCLevel', '', time()-3600, '/', '192.168.10.2');
	setcookie('WasLogged', '', time()-3600, '/', '192.168.10.2');
	
	$stmt = $dbh->prepare("INSERT INTO logs (`uid`, `time`, `date`, `log`) VALUES (?, ?, ?, ?)");
	$stmt->bindParam(1, $uid);
	$stmt->bindParam(2, $time, PDO::PARAM_STR);
	$stmt->bindParam(3, $date, PDO::PARAM_STR);
	$stmt->bindParam(4, $log);
	$stmt->execute();
	
	if($deadSession == '1') {
		header('Location: /login-error/4');
	} else {
		header('Location: /login');
	}
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br />";
    die();
}

?>