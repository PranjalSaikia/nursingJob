<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$pass1 = addslashes(strip_tags(trim($_POST['pass1'])));
	$pass2 = addslashes(strip_tags(trim($_POST['pass2'])));
	$pass3 = addslashes(strip_tags(trim($_POST['pass3'])));

	if($pass2 == $pass3){
		$q = "SELECT * FROM nurse_master WHERE n_id=:n_id AND n_password=:password";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
		$stmt->bindParam(':password',$pass1,PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount() == 1){
			$q1 = "UPDATE nurse_master SET n_password=:password WHERE n_id=:n_id";
			$stmt1=$core->dbh->prepare($q1);
			$stmt1->bindParam(':password',$pass2,PDO::PARAM_STR);
			$stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
			$stmt1->execute();
		}
	}



?>