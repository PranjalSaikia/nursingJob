<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$apply_id = addslashes(strip_tags(trim($_POST['m'])));
	$status = addslashes(strip_tags(trim($_POST['n'])));


	$q = "UPDATE job_apply SET status=:status WHERE apply_id=:apply_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':apply_id',$apply_id,PDO::PARAM_INT);
	$stmt->bindParam(':status',$status,PDO::PARAM_INT);
	$stmt->execute();



?>