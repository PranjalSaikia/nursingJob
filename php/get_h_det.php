<?php 

	

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$h_id = addslashes(strip_tags(trim($_POST['n'])));


	$q = "SELECT a.*,b.*,c.*, sum(a.job_no) as job_no1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id WHERE a.active='1' AND b.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()>0){
		$r = $stmt->fetchObject();

?>	
	

	<h4><small>Name of the Hospital:</small> <?php echo $r->h_name; ?></h4>


	<h6>Vacancy List:</h6>
	<br>
	<table class="table tabl-bordered">
		<thead>
			<tr>
				<td>#</td>
				<td>Category</td>
				<td>Vacancies</td>
				<td>Apply</td>
			</tr>
		</thead>
		<tbody>
			<?php 

					$e = 1;
					$q1 = "SELECT a.*,b.*,sum(a.job_no) as job_no1 FROM job_post_h a INNER JOIN nurse_category b ON a.job_cat=b.cat_id WHERE a.h_id=:h_id GROUP BY a.job_cat";
					$stmt1=$core->dbh->prepare($q1);
					$stmt1->bindParam(':h_id',$h_id,PDO::PARAM_INT);
					$stmt1->execute();
					if($stmt1->rowCount()>0){
						while($r1 = $stmt1->fetchObject()){


			?>
			<tr>
				<td><?php echo $e;$e++; ?></td>
				<td><?php echo $r1->cat_name; ?> - <?php echo $r1->cat_des; ?></td>
				<td><?php echo $r1->job_no1; ?> nos</td>
				<td>apply</td>
			</tr>
			<?php 

					}
				}


			?>
		</tbody>
	</table>


<?php 
		
		}

?>