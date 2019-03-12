<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$a = array();

	$q = "SELECT a.*,b.*,c.* FROM interested_nurse a INNER JOIN nurse_master b ON a.n_id=b.n_id INNER JOIN nurse_det c ON a.n_id=c.n_id WHERE a.h_id=:h_id AND a.seen='0' ORDER BY a.time_stamp DESC";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
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
