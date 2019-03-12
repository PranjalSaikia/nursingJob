
<?php 
	include('../class/connect.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$a = array();

	$q = "SELECT e.*,a.*,b.*,c.*,d.*, sum(a.job_no) as job_no1,a.time_stamp as time_stamp1 FROM job_apply e INNER JOIN job_post_h a ON e.job_id=a.job_id INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND e.n_id=:n_id GROUP BY a.job_id ";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_STR);
	$stmt->execute(); $count = $stmt->rowCount();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)){

			$a[] = $r;

		}

		echo json_encode($a);
	}else{
		echo false;
	}
?>	

