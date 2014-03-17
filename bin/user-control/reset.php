<?php
if($_SERVER["HTTP_REFERER"] !== '/reset-pass') {
	header("Location: login-error/99");
} elseif($_POST['hash'] === sha1('salt')) {
	$ans1 = $_POST['q1'];
	$ans2 = $_POST['q2'];
	$uid = $_POST['uid'];
	
	
	
	$dbh = new PDO('mysql:host=localhost;dbname=vault', 'root', '');
	
	$sth = $dbh->prepare("SELECT secA1, secA2, level FROM users WHERE uid = ?");
	$sth->bindParam(1, $uid, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	
	$dba1 = $result['secA1'];
	$dba2 = $result['secA2'];
	$level = sha1($result['level']);
	
	/* Testing Stuff
	echo $ans1.'<br />';
	echo $dba1;
	echo '<br /><br />';
	echo $ans2.'<br />';
	echo $dba2;
	echo '<br /><br />';
	*/
	
	if($ans1 == $dba1 && $ans2 == $dba2) {
		#echo 'Whatever';
		
		$length = 10;
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    	$string = "";    
    	for ($p = 0; $p < $length; $p++) {
        	$string .= $characters[mt_rand(0, strlen($characters))];
    	}
		
		#echo $string;
		
		$newPass = sha1($string);
    	
		$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');
	
		$sth = $dbh->prepare("UPDATE users SET pass=? WHERE uid = ?");
		$sth->bindParam(1, $newPass, PDO::PARAM_STR);
		$sth->bindParam(2, $uid, PDO::PARAM_STR);
		$sth->execute();
		
		$time = date('h:ia');
		$date = date('m/d/Y');
		$log = 'Password was reset.';

		$logUp = $dbh->prepare("INSERT INTO logs (`uid`, `time`, `date`, `log`) VALUES (?, ?, ?, ?)");		
		$logUp->bindParam(1, $uid);
		$logUp->bindParam(2, $time, PDO::PARAM_STR);
		$logUp->bindParam(3, $date, PDO::PARAM_STR);
		$logUp->bindParam(4, $log);
		$logUp->execute();
		
		$dbh = null;
		
		setcookie('DACC', $uid, time()+900, '/', '192.168.10.2');
		
		header('Location: /user-settings/pass-reset');
	} else {
		#echo 'It fucked up';
		header('Location: /reset-pass/2');
	}
} else {
	header('Location: /login-error/99');
}

?>