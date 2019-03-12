<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();

	$file_type = addslashes(strip_tags(trim($_POST['file_type'])));
	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));

	if($file_type == 1){
		$str = 'resume';
		$str1 = 'resume_status';
	}else if($file_type == 2){
		$str = 'slicense';
		$str1 = 'slicense_status';
	}else if($file_type == 3){
		$str = 'svideo';
		$str1 = 'svideo_status';
	}

	$q = "UPDATE nurse_det SET $str1='1' WHERE n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
	$stmt->execute();

	echo '<button class="btn btn-success"><i class="fa fa-check"> Verified</i></button>';



?>