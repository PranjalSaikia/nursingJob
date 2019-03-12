<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$n = addslashes(strip_tags(trim($_POST['n'])));
	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));

	$q = "SELECT * FROM hospital_det WHERE h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_STR);
	$stmt->execute();

	$r = $stmt->fetchObject();

	if($n == 1){
		if($r->resume != ""){
			echo $r->resume;
		}else{
			echo "";
		}
	}elseif($n == 2){
		if($r->slicense != ""){
			echo $r->slicense;
		}else{
			echo "";
		}
	}else{
		if($r->dp != ""){
			echo $r->dp;
		}else{
			echo "";
		}
	}



?>