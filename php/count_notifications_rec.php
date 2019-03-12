<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$q = "SELECT * FROM interested_nurse WHERE h_id=:h_id AND seen='0'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
	$stmt->execute();

	echo $stmt->rowCount();
	

?>
