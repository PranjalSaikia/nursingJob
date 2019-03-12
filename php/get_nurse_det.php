<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');



	$core = Core::getInstance();

	$n_id = addslashes(strip_tags(trim($_POST['n'])));

	$a = array();

	$q = "SELECT a.*,b.* FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id WHERE a.access_token=:token AND a.active_flag='0' AND a.n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()>0){
		$r = $stmt->fetchObject();


		$a[0] = $r->n_id;
		$a[1] = $r->n_name;
		$a[2] = $r->n_des;
		//$a[3] = $r->h_des_long;
		$a[4] = $r->district;
		$a[5] = $r->city;
		$a[6] = $r->state;
		$a[7] = $r->pin;
		$a[8] = $r->dp;
		$a[9] = $r->n_email;
		$a[10] = $r->n_phn;
		$a[11] = $r->exp;
		$a[12] = $r->resume;
		$a[13] = $r->slicense;
		$a[14] = $r->slink;

		echo json_encode($a);

	}else{

		$a[0] = "no";

		echo json_encode($a);

	}


?>