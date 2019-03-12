<?php
	
	include('../class/connect.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$token = addslashes(strip_tags(trim($_POST['token'])));

	$q = "SELECT * FROM hospital_master WHERE access_token=:token";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		echo true;
	}else{
		echo false;
	}

	

?>