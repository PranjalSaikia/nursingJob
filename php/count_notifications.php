<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$q = "SELECT * FROM interested WHERE n_id=:n_id AND seen='0'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->execute();

	echo $stmt->rowCount();
	

?>
