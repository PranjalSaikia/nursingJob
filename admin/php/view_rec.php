<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();
?>
<style type="text/css">
	#copp{
		opacity: 0;
	}
</style>
<div class="table-responsive">
			<table width="100%" class="table table-bordered table-stripped" id="myTable">
				<thead>
					<tr class="alert-success">
						<td width="5%">#</td>
						<td width="20%">Recruiter</td>
						<td width="20%">Email</td>
						<td width="10%">Letter of Incorporation</td>
						<td width="10%">Bank details</td>
						<td width="20%">Link</td>
						<td width="10%">Company profile</td>
						<td width="10%">Video</td>
						<td>Registered on</td>
						<td>Status</td>
						<td width="11%">Change Status</td>
					</tr>
				</thead>
				<tbody>
				<?php 

					$e = 1;
					$q = "SELECT a.*,b.* FROM hospital_master a INNER JOIN hospital_det b ON a.h_id=b.h_id";
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
					<td><?php echo $e; ?></td>
					<td><?php echo $r->h_name; ?></td>
					<td><a href="mailto:<?php echo $r->h_email; ?>"><?php echo $r->h_email; ?></a></td>
					<td><a href="../<?php echo $r->letter_inc; ?>"><i class="fa fa-download"> LoI</i></a></td>
					<td><a href="../<?php echo $r->bank_det; ?>"><i class="fa fa-download"> Bank</i></a></td>
					<td>


						<input type="text" name="copp_<?php echo $e; ?>" id="copp" value="https://www.jobforsure.in/login_hospital_first.html?token=<?php echo $r->access_token; ?>"> <button class="btn btn-default" type="button" onclick="copyText('<?php echo $e; ?>')">Copy Link</button>


						<button class="btn btn-sm btn-primary" type="button" onclick="initiate_email('<?php echo $r->h_id; ?>','https://www.jobforsure.in/login_hospital_first.html?token=<?php echo $r->access_token; ?>','<?php echo $r->h_email; ?>');">Send email</button>

					</td>
					<td>
						<a data-toggle="modal" data-target="#view_modal" onclick="verification('<?php echo $r->company_profile; ?>','<?php echo $r->h_id; ?>',1)"><i class="fa fa-download"> Profile</i></a>
					</td>
					<td>
						<a data-toggle="modal" data-target="#view_modal" onclick="verification('<?php echo $r->videos_h; ?>','<?php echo $r->h_id; ?>',2)"><i class="fa fa-download"> Video</i></a>
					</td>
					<td><?php echo $r->time_stamp; ?></td>
					<td><?php echo $str1; ?></td>
					<td>
						<select class="form-control" name="active_change" id="active_chage" onchange="change_status('<?php echo $r->h_id; ?>','<?php echo $r->active_flag; ?>')">

							<option value="0" <?php if($r->active_flag == 0){ echo "selected"; } ?>>Activate</option>
							<option value="1" <?php if($r->active_flag == 1){ echo "selected"; } ?>>Deactivate</option>
							
						</select>
					</td>
				</tr>


				<?php 				$e++;
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


			function copyText(n){
				var temp = $("[name=copp_"+n+"]");
				temp.select();
				document.execCommand('copy');
			}
		</script>