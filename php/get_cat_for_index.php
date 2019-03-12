<?php 

	include('../class/connect.php');

	$core = Core::getInstance();

	$a = array();

	$q = "SELECT * FROM nurse_category";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
			$a[] = $r;
		}

		echo json_encode($a);
	}else{
		echo false;
	}




?>