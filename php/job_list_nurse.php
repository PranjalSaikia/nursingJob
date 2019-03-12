<?php 

	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$q = "SELECT a.*,b.*,c.*,d.*, a.time_stamp as time_stamp1 FROM job_apply a INNER JOIN job_post_h b ON a.job_id=b.job_id INNER JOIN nurse_category c ON b.job_cat=c.cat_id INNER JOIN hospital_master d ON b.h_id=d.h_id WHERE a.n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()==0){
		echo "No entries found . . . ";
	}else{

		

?>

	<table class="table table-bordered">
		<thead>
			<tr class="alert-primary">
				<td>#</td>
				<td>Hospital Name</td>
				<td>Category</td>
				<td>Location</td>
				<td>Date of submission</td>
				<td>Status</td>
			</tr>
		</thead>
		<tbody>
			<?php
					$e = 1;
					while($r = $stmt->fetchObject()){

						if($r->status == 0){
							$str = "Applied";
						}elseif($r->status == 1){
							$str = "Viewed";
						}elseif($r->status == 2){
							$str = "Verified";
						}elseif($r->status == 3){
							$str = "Accepted";
						}elseif($r->status == 10){
							$str = "Rejected";
						}

			?>
			<tr>
				<td><?php echo $e;$e++; ?></td>
				<td><?php echo $r->h_name; ?></td>
				<td><?php echo $r->cat_des; ?></td>
				<td><?php echo $r->job_location; ?></td>
				<td><?php echo date('d-m-Y',strtotime($r->time_stamp1)); ?></td>
				<td><?php echo $str; ?></td>
			</tr>
			<?php 


					}


			?>
		</tbody>
	</table>



<?php 
	
		
	}


?>