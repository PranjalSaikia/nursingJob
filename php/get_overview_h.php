<?php 

	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$a = array();

	$q = "SELECT a.*,b.* FROM job_post_h a INNER JOIN job_apply b ON a.job_id=b.job_id WHERE b.status='1' AND a.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_STR);
	$stmt->execute();
	$a[0] = $stmt->rowCount(); //Total received


	$q = "SELECT a.*,b.* FROM job_post_h a INNER JOIN job_apply b ON a.job_id=b.job_id WHERE b.status='1' AND a.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_STR);
	$stmt->execute();
	$a[1] = $stmt->rowCount(); //Total Viewed
	

	$q = "SELECT a.*,b.* FROM job_post_h a INNER JOIN job_apply b ON a.job_id=b.job_id WHERE b.status='1' AND a.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_STR);
	$stmt->execute();
	$a[2] = $stmt->rowCount(); //Total Verified

	$q = "SELECT a.*,b.* FROM job_post_h a INNER JOIN job_apply b ON a.job_id=b.job_id WHERE b.status='2' AND a.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_STR);
	$stmt->execute();
	$a[3] = $stmt->rowCount(); //Total Accepted

	$q = "SELECT a.*,b.* FROM job_post_h a INNER JOIN job_apply b ON a.job_id=b.job_id WHERE b.status='3' AND a.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_STR);
	$stmt->execute();
	$a[4] = $stmt->rowCount(); //Total Rejected


	echo json_encode($a);


?>