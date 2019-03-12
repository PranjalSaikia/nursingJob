<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();

	$file_type = addslashes(strip_tags(trim($_POST['file_type'])));
	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));

	if($file_type == 1){
		$str = 'company_profile';
		$str1 = 'company_profile_status';
	}else if($file_type == 2){
		$str = 'videos_h';
		$str1 = 'videos_h_status';
	}

	$q = "UPDATE hospital_det SET $str1='1' WHERE h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt->execute();

	echo '<button class="btn btn-success"><i class="fa fa-check"> Verified</i></button>';



?>