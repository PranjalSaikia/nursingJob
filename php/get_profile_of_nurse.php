<?php 
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));

	$q = "SELECT a.*,b.* FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id WHERE a.n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()>0){	
		$r = $stmt->fetchObject();
?>

	<table width="100%">
		<tr>
			<td align="center" >
				<img class="rounded" style="width: 100%" src="<?php echo $r->dp; ?>">
			</td>
		</tr>
		<tr>
			<td align="center" >
				<table width="90%">
					<tr>
						<td width="10%">Name:</td>
						<td><?php echo $r->n_name; ?></td>
					</tr>
					<tr>
						<td width="10%" valign="top">Bio:</td>
						<td><?php echo $r->n_des; ?></td>
					</tr>
					<tr>
						<td width="10%">City:</td>
						<td><?php echo $r->city; ?></td>
					</tr>

					<tr>
						<td width="10%">District:</td>
						<td><?php echo $r->district; ?></td>
					</tr>

					<tr>
						<td width="30%">State:</td>
						<td><?php echo $r->state; ?></td>
					</tr>

					<tr>
						<td width="30%">Pin:</td>
						<td><?php echo $r->pin; ?></td>
					</tr>
					<tr>
						<td width="30%">Contact:</td>
						<td><a href="tel:<?php echo $r->n_phn; ?>"><?php echo $r->n_phn; ?></a></td>
					</tr>

					<tr>
						<td width="30%">Email:</td>
						<td><a href="mailto:<?php echo $r->n_email; ?>"><?php echo $r->n_email; ?></a></td>
					</tr>

					<tr>
						<td width="30%">Skype:</td>
						<td><a href="skype:<?php echo $r->slink; ?>"><?php echo $r->slink; ?></a></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td colspan="2" align="center">
				<?php 
					$e=1;
					$q1 = "SELECT * FROM job_exp_profile WHERE n_id=:n_id";
					$stmt1=$core->dbh->prepare($q1);
					$stmt1->bindParam(':n_id',$n_id,PDO::PARAM_INT);
					$stmt1->execute();
					if($stmt1->rowCount()>0){


				?><br><br>
				<label><h4>Experience Table</h4></label>
				<table width="100%" class="table table-bordered">
					<tr class="alert-success">
						<td>#</td>
						<td>Job Title</td>
						<td>Organisation</td>
						<td>Period</td>
						<td>Experience in years</td>
						<td>Job details</td>
					</tr>
					<?php

						while($r1 = $stmt1->fetchObject()){

					?>
					<tr>
						<td><?php echo $e; $e++; ?></td>
						<td><?php echo $r1->job_title; ?> <?php if($r1->current == 1){echo " (current)";} ?></td>
						<td><?php echo $r1->job_org; ?></td>
						<td><?php echo $r1->period; ?></td>
						<td><?php echo $r1->job_exp; ?></td>
						<td><?php echo $r1->job_det; ?></td>
					</tr>

					<?php 

							}

					?>
				</table>
				<?php 

					}

				?>
			</td>
		</tr>
	</table>


<?php 

	}

?>