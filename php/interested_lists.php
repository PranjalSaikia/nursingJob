<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$a = array();

	$q = "SELECT a.*,b.*,c.* FROM interested a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id WHERE a.n_id=:n_id AND a.seen='0' ORDER BY a.time_stamp DESC";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
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
