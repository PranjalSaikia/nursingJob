<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$q = "SELECT a.*,b.*,c.* FROM interested a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id WHERE a.n_id=:n_id AND a.seen='0'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->execute();
	echo $stmt->rowCount();

	?>