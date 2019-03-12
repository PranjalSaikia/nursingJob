<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$job_id = addslashes(strip_tags(trim($_POST['job_id'])));

	$q = "SELECT * FROM nurse_master WHERE active_flag='0' AND is_verified='1' AND access_token=:token";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount() > 0){

		$r = $stmt->fetchObject();

		$status = 0;
		$q1 = "INSERT INTO job_apply(job_id,n_id,status) VALUES(:job_id,:n_id,:status)";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':job_id',$job_id,PDO::PARAM_INT);
		$stmt1->bindParam(':n_id',$r->n_id,PDO::PARAM_INT);
		$stmt1->bindParam(':status',$status,PDO::PARAM_INT);
		$stmt1->execute();



		?>	

		<small><i class="fa fa-check text-green" style="color: green"></i><span style="color: green">Applied</span>&nbsp;&nbsp;
			|&nbsp;&nbsp;<a style="color: red;cursor: pointer" onclick="cancel_apply('<?php echo $job_id; ?>')"><i class="fa fa-close text-green"></i>Cancel</a></small>


		<?php
		


	}



?>