<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$n = addslashes(strip_tags(trim($_POST['n'])));
	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));

	$q = "SELECT * FROM nurse_det WHERE n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_STR);
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