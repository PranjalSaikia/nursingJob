<?php 

	
	include('../class/connect.php');

	$core = Core::getInstance();

	$p1 = addslashes(strip_tags(trim($_POST['p1'])));
	$token = addslashes(strip_tags(trim($_POST['token'])));
	$isv  = 1;

	$q = "UPDATE nurse_master SET n_password=:pass,is_verified=:isv WHERE access_token=:token";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':pass',$p1,PDO::PARAM_STR);
	$stmt->bindParam(':isv',$isv,PDO::PARAM_INT);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->execute();

	if($stmt == true){
		echo true;
	}else{
		echo false;
	}




?>