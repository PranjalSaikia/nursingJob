<?php 

	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$q = "SELECT a.*,b.* FROM job_apply a INNER JOIN job_post_h b ON a.job_id=b.job_id WHERE b.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_STR);
	$stmt->execute();
	echo $stmt->rowCount();


	



?>