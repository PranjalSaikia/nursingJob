<?php 

	include('../class/connect.php');

	$core = Core::getInstance();


	$q = "SELECT * FROM nurse_det WHERE n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()==0){ 
		echo 1;
	}else{
		echo 0;
	}

?>