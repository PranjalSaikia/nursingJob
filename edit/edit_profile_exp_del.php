<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$id = addslashes(strip_tags(trim($_POST['id'])));

	$q = "DELETE FROM job_exp_profile WHERE id=:id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':id',$id,PDO::PARAM_INT);
	$stmt->execute();


?>

<table class="table table-bordered">
	<thead>
		<tr>
			<td width="5%">#</td>
			<td>Job Title / Designation</td>
			<td>Organisation</td>
			<td>Period</td>
			<td>Total Exp</td>
			<td width="40%">Description</td>
			<td width="5%"></td>
		</tr>
	</thead>
	<tbody>
		<?php 
				$e=1;
				$q1 = "SELECT * FROM job_exp_profile WHERE n_id=:n_id";
				$stmt1=$core->dbh->prepare($q1);
				$stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
				$stmt1->execute();
				if($stmt1->rowCount()>0){

					while($r1 = $stmt1->fetchObject()){

		?>
		<tr <?php if($r1->current == 1){ ?>class="text-success" <?php } ?>>
			<td><?php echo $e; $e++; ?></td>
			<td><?php echo $r1->job_title; ?></td>
			<td><?php echo $r1->job_org; ?></td>
			<td><?php echo $r1->period; ?></td>
			<td><?php echo $r1->job_exp; ?></td>
			<td><?php echo $r1->job_det; ?></td>
			<td><a onclick="delete_exp('<?php echo $r1->id; ?>')"><i class="fa fa-trash"></i></a></td>
			
		</tr>

		<?php 

				}
			}

		?>
	</tbody>
</table>