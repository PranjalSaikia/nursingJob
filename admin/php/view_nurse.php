<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();


?>
<div class="table-responsive">
			<table width="100%" class="table table-bordered table-stripped" id="myTable">
				<thead>
					<tr class="alert-success">
						<td width="5%">#</td>
						<td width="20%">Nurse Name</td>
						<td width="20%">Email</td>
						<td width="20%">Phone</td>
						<td width="20%">Address</td>
						<td width="10%">Resume</td>
						<td width="10%">License</td>
						<td width="10%">Video</td>
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
					<td><a href="mailto:<?php echo $r->n_email; ?>"><?php echo $r->n_email; ?></a></td>
					<td><a href="tel:<?php echo $r->n_phn; ?>"><?php echo $r->n_phn; ?></a></td>
					<td><?php echo $r->city; ?></td>
					<td><a data-toggle="modal" data-target="#view_modal" onclick="verification('<?php echo $r->resume; ?>','<?php echo $r->n_id; ?>',1)"><i class="fa fa-download"> Resume</i></a></td>
					<td>
						<a data-toggle="modal" data-target="#view_modal" onclick="verification('<?php echo $r->slicense; ?>','<?php echo $r->n_id; ?>',2)"><i class="fa fa-download"> License</i></a>
					</td>
					<td>
						<a data-toggle="modal" data-target="#view_modal" onclick="verification('<?php echo $r->svideo; ?>','<?php echo $r->n_id; ?>',3)"><i class="fa fa-download"> Video</i></a>
					</td>
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