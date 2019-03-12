<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$pass1 = addslashes(strip_tags(trim($_POST['pass1'])));
	$pass2 = addslashes(strip_tags(trim($_POST['pass2'])));
	$pass3 = addslashes(strip_tags(trim($_POST['pass3'])));

	if($pass2 == $pass3){
		$q = "SELECT * FROM hospital_master WHERE h_id=:h_id AND h_password=:password";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
		$stmt->bindParam(':password',$pass1,PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount() == 1){
			$q1 = "UPDATE hospital_master SET h_password=:password WHERE h_id=:h_id";
			$stmt1=$core->dbh->prepare($q1);
			$stmt1->bindParam(':password',$pass2,PDO::PARAM_STR);
			$stmt1->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
			$stmt1->execute();
		}
	}



?>