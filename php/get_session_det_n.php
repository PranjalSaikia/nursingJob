<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');



	$core = Core::getInstance();

	$a = array();

	$q = "SELECT * FROM nurse_master WHERE access_token=:token AND active_flag='0'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount()>0){
		$r = $stmt->fetchObject();


		$a[0] = $r->n_id;
		$a[1] = $r->n_name;
		/*$a[2] = $r->h_address;*/
		$a[3] = $r->n_phn;
		$a[4] = $r->n_email;
		$a[5] = $r->n_username;

		echo json_encode($a);

	}else{

		$a[0] = "no";

		echo json_encode($a);

	}


?>