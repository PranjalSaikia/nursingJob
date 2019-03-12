<?php 

	include('../class/connect.php');

	$core = Core::getInstance();


	$q = "SELECT * FROM hospital_det WHERE h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()>0){ 
		$r = $stmt->fetchObject();

		if($r->h_des_short == "" && $r->h_des_long == "" && $r->region == "" && $r->city == "" && $r->district == "" && $r->state == "" && $r->pin == "" && $r->dp == ""){
			echo 1;
		}else{
			echo 0;
		}
	}else{
		echo 0;
	}

?>