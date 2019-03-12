<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$a = array();

	$q = "SELECT a.*,b.*,c.*,d.*,e.*,a.time_stamp as time_stamp1 FROM job_apply a INNER JOIN job_post_h b ON a.job_id=b.job_id INNER JOIN nurse_master c ON a.n_id=c.n_id INNER JOIN nurse_det d ON a.n_id=d.n_id INNER JOIN nurse_category e ON b.job_cat=e.cat_id WHERE b.h_id=:h_id AND a.status='3'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount() == 0){
		echo "0";
	}else{

		while($r = $stmt->fetch(PDO::FETCH_ASSOC)){

			$a[] = $r;
		
		}

		echo json_encode($a);
	
	}
	
?>
