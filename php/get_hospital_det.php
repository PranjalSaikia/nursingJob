<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');



	$core = Core::getInstance();

	$h_id = addslashes(strip_tags(trim($_POST['n'])));

	$a = array();

	$q = "SELECT a.*,b.* FROM hospital_master a INNER JOIN hospital_det b ON a.h_id=b.h_id WHERE a.access_token=:token AND a.active_flag='0' AND a.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()>0){
		$r = $stmt->fetchObject();


		$a[0] = $r->h_id;
		$a[1] = $r->h_name;
		$a[2] = $r->h_des_short;
		$a[3] = $r->h_des_long;
		$a[4] = $r->region;
		$a[5] = $r->city;
		$a[6] = $r->state;
		$a[7] = $r->pin;
		$a[8] = $r->dp;
		$a[9] = $r->h_email;
		$a[10] = $r->h_phn;

		echo json_encode($a);

	}else{

		$a[0] = "no";

		echo json_encode($a);

	}


?>