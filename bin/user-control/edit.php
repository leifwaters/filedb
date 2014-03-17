<?php
	$error = false;
	
	if($error === false) {
		
		$keys = array_keys($_POST);
		$values = array_values($_POST);
		
		foreach($keys as &$key) {
			if (strlen($columns) > 0) {$columns .= ', ';}
    		$columns .= $key.'=?';
		}
		
		#echo $columns;
		
		$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');	
		
		$stmt = $dbh->prepare("UPDATE users SET $columns WHERE uid=?");
		$i = 1;
		foreach($values as $value) {
			$stmt->bindValue($i, $value);
			#echo '$stmt->bindValue('.$i.', '.$value.');<br />';
			$i++;
		}
		$stmt->bindValue($i, $_POST['uid']);
		$stmt->execute();
		$check = $stmt->rowCount();
		
		if($check == 1) {
			header('Location: /user-settings/edit-users');
		} else {
			echo "\nPDO::errorInfo():\n";
    		print_r($stmt->errorInfo());
		}
	} else {
		header('Location: /user-settings/add-user/2');
		echo $return;
		die();
	}
?>