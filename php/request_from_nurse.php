<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));

	$q = "SELECT * FROM interested_nurse WHERE h_id=:h_id AND n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()==0){
		$q1 = "INSERT INTO interested_nurse (n_id,h_id,seen) VALUES(:n_id,:h_id,'0')";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
		$stmt1->bindParam(':h_id',$h_id,PDO::PARAM_INT);
		$stmt1->execute();
	}

	?>