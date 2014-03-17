<?php
	$error = false;
	
	if($_POST['uid'] == null) {
		$error = true;
		$return .= 'You must enter a username.<br />';
	}
	if($_POST['pass'] == null) {
		$error = true;
		$return .= 'You must enter a password.<br />';
	} elseif($_POST['pass'] !== $_POST['password_confirm']) {
		$error = true;
		$return .= 'Your passwords do not match.<br />';
	}
	
	if($error === false) {
		
		$_POST['reset'] = 1;
		$_POST['passDate'] = date('Y-m-d');
		
		$_POST['pass'] = sha1($_POST['pass']);
		
		unset($_POST['password_confirm']);
		
		$keys = array_keys($_POST);
		$values = array_values($_POST);
		
		foreach($keys as &$key) {
			if (strlen($columns) > 0) {$columns .= ', ';}
    		$columns .= $key;
		}
		
		//echo $columns;
		
		foreach($values as $value) {
			if (strlen($marks) > 0) {$marks .= ', ';}
			$marks .= '?';
		}
		
		//echo $marks;
		
		$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');	
		
		$stmt = $dbh->prepare("INSERT INTO users ($columns) VALUES ($marks)");
		$i = 1;
		foreach($values as $value) {
			$stmt->bindValue($i, $value);
			//echo '$stmt->bindValue('.$i.', '.$value.');<br />';
			$i++;
		}
		$stmt->execute();
		$check = $stmt->rowCount();
		
		#echo "\nPDO::errorInfo():\n";
    	#print_r($stmt->errorInfo());
	
		if($check == 1) {
			header('Location: user-settings/add-user/1');
		} else {
			echo 'Oops';
		}
	} else {
		header('Location: user-settings/add-user/2');
		echo $return;
		die();
	}
?>