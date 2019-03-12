<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();

	$flag = 0;

	$email = addslashes(strip_tags(trim($_POST['email'])));
	$phn = addslashes(strip_tags(trim($_POST['phn'])));

	$q = "SELECT * FROM nurse_master WHERE n_email=:email";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':email',$email,PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount()>0){
		$flag = $flag+1;
	}


	$q1 = "SELECT * FROM hospital_master WHERE h_email=:email";
	$stmt1=$core->dbh->prepare($q1);
	$stmt1->bindParam(':email',$email,PDO::PARAM_STR);
	$stmt1->execute();

	if($stmt1->rowCount()>0){
		$flag = $flag+1;
	}

	echo $flag;




?>