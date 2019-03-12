<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();


	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));
	$status = addslashes(strip_tags(trim($_POST['status'])));

	if($status == 1){
		$active =0;
	}else{
		$active=1;
	}

	$q = "UPDATE nurse_master SET active_flag=:active WHERE n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
	$stmt->bindParam(':active',$active,PDO::PARAM_INT);
	$stmt->execute();



?>
<div class="table-responsive">
			<table width="100%" class="table table-bordered table-stripped" id="myTable">
				<thead>
					<tr class="alert-success">
						<td width="5%">#</td>
						<td width="20%">Nurse Name</td>
						<td width="20%">Email</td>
						<td width="20%">Address</td>
						<td width="10%">View Applications</td>
						<td>Registered on</td>
						<td>Status</td>
						<td width="11%">Change Status</td>
					</tr>
				</thead>
				<tbody>
				<?php 

					$e = 1;
					$q = "SELECT a.*,b.* FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id";
					$stmt=$core->dbh->prepare($q);
					$stmt->execute();
					if($stmt->rowCount()>0){
						while($r = $stmt->fetchObject()){
							if($r->active_flag == 0){
								$str1 = "active";
							}else{
								$str1 = "not active";
							}
				?>

				<tr <?php if($r->active_flag == 1){ echo 'style="background-color: #FA7878"'; } ?>>
					<td><?php echo $e;$e++; ?></td>
					<td><?php echo $r->n_name; ?></td>
					<td><?php echo $r->n_email; ?></td>
					<td><?php echo $r->city; ?></td>
					<td>View</td>
					<td><?php echo $r->time_stamp; ?></td>
					<td><?php echo $str1; ?></td>
					<td>
						<select class="form-control" name="active_change" id="active_chage" onchange="change_status('<?php echo $r->n_id; ?>','<?php echo $r->active_flag; ?>')">

							<option value="0" <?php if($r->active_flag == 0){ echo "selected"; } ?>>Activate</option>
							<option value="1" <?php if($r->active_flag == 1){ echo "selected"; } ?>>Deactivate</option>
							
						</select>
					</td>
				</tr>


				<?php 			
							}

						}

				?>
			</tbody>
			</table>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
		

		$("#myTable").DataTable();
		
	});
		</script>