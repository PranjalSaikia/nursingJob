<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$id = addslashes(strip_tags(trim($_POST['id'])));

	$q = "UPDATE interested SET seen='1' WHERE id=:id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':id',$id,PDO::PARAM_INT);
	$stmt->execute();

?>

