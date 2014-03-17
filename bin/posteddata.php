<!DOCTYPE html>
<?php

if (!empty($_POST))
{
	foreach ( $_POST as $key => $value )
	{
		if ( ( !is_string($value) && !is_numeric($value) ) || !is_string($key) )
			continue;

		if ( get_magic_quotes_gpc() )
			$value = htmlspecialchars( stripslashes((string)$value) );
		else
			$value = htmlspecialchars( (string)$value );

	}
}
$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');	
		
		$stmt = $dbh->prepare("INSERT INTO users ($columns) VALUES ($marks)")
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

*/
?>

</body>
</html>
