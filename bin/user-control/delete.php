<?php 

$id = $_POST['id'];

$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');	
$stmt = $dbh->prepare("DELETE FROM users WHERE id=?");
$stmt->bindValue(1, $id);
$stmt->execute();

?>