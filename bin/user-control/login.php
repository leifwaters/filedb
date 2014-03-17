<?php
#Comment out when testing is done!
error_reporting(E_ALL);
  try {
	  $dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');
	  
	  $uid = $_POST['uid'];
	  $pass = sha1($_POST['pass']);
  
	  $sth = $dbh->prepare("SELECT pass, level, reset, passDate, color FROM users WHERE uid = ?");
	  $sth->bindParam(1, $uid, PDO::PARAM_STR);
	  $sth->execute();
	  $result = $sth->fetch(PDO::FETCH_ASSOC);
	  
	  if($result == null) {
		  #echo 'That username was not found!';
		  header('Location: /login-error/1');
	  } else {
		  $dbPass = $result['pass'];
		  $reset = $result['reset'];
		  $passDate = $result['passDate'];
		  $color = $result['color'];
		  $level = $result['level'];
		  
		  if($pass !== $dbPass) {
			  #echo 'That pass is incorrect...';
			  header('Location: /login-error/2');
		  } else {
			  date_default_timezone_set('America/New_York');
			  $time = date('h:ia');
			  $date = date('m/d/Y');
			  $log = 'Logged In';
			  
			  $stmt = $dbh->prepare("INSERT INTO logs (`uid`, `time`, `date`, `log`) VALUES (?, ?, ?, ?)");
			  $stmt->bindParam(1, $uid);
			  $stmt->bindParam(2, $time, PDO::PARAM_STR);
			  $stmt->bindParam(3, $date, PDO::PARAM_STR);
			  $stmt->bindParam(4, $log);
			  $stmt->execute();
			  
			  if($reset === 1) {
				  header('Location: /user-settings/pass-reset/1');
				  setcookie('DACC', $uid, time()+300, '/', 'dacc-online.com');
			  } elseif($reset === 2) {
				  header('Location: /user-settings/settings/3');
				  setcookie('DACC', $uid, time()+300, '/', 'dacc-online.com');
			  } elseif(strtotime($passDate) <= strtotime(date('Y-m-d'))) {  
				  header('Location: /user-settings/pass-reset/2');
				  setcookie('DACC', $uid, time()+300, '/', 'dacc-online.com');
				  header('Location: /explorer.php');
				  setcookie('DACC', $uid, time()+1800, '/', 'dacc-online.com');
				  setcookie('DACCLevel', $level, time()+1800, '/', 'dacc-online.com');
				  setcookie('ColorSet', $color, time()+15768000000, '/', 'dacc-online.com');
				  setcookie('WasLogged', 1, time()+36000, '/', 'dacc-online.com');
			  }
		  }
	  }
	  
	  
	  $dbh = null;
  } catch (PDOException $e) {
	  print "Error!: " . $e->getMessage() . "<br />";
	  die();
  }

?>