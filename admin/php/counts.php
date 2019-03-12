<?php 

	include('../class/connect.php');

	$core =Core::getInstance();


	$q = "SELECT * FROM job_post_h WHERE active='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	$no_job = $stmt->rowCount();


	$q1 = "SELECT * FROM hospital_master WHERE active_flag='0'";
	$stmt1=$core->dbh->prepare($q1);
	$stmt1->execute();
	$no_hospital = $stmt1->rowCount(); 


	$q2 = "SELECT * FROM nurse_master WHERE active_flag='0'";
	$stmt2=$core->dbh->prepare($q2);
	$stmt2->execute();
	$no_nurse = $stmt2->rowCount();


	$q3 = "SELECT * FROM job_apply";
	$stmt3=$core->dbh->prepare($q3);
	$stmt3->execute();
	$no_applications = $stmt3->rowCount();

	$a = array();

	$a[0] = $no_job;
	$a[1] = $no_hospital;
	$a[2] = $no_nurse;
	$a[3] = $no_applications;

	echo json_encode($a);


?>