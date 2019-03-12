<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();


	$q = "SELECT a.*,b.*,c.*,d.*,e.*,a.time_stamp as time_stamp1 FROM job_apply a INNER JOIN job_post_h b ON a.job_id=b.job_id INNER JOIN nurse_master c ON a.n_id=c.n_id INNER JOIN nurse_det d ON a.n_id=d.n_id INNER JOIN nurse_category e ON b.job_cat=e.cat_id WHERE b.h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount() == 0){
		echo "No one applied yet.";
	}else{

?>

<div class="table-responsive">
<small><table class="table table-bordered" id="myTable">
	<thead>
		<tr class="alert-primary">
			<td>#</td>
			<td>Category</td>
			<td>Location</td>
			<td width="10px">Min Exp</td>
			<td>Nurse Name</td>
			<td>Phone No</td>
			<td>Applied on</td>
			<td>Resume</td>
			<td>License</td>
			<td>Current Status</td>
			<td>Change Status</td>
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
			<td><?php echo $r->cat_des; ?></td>
			<td><?php echo $r->job_location; ?></td>
			<td><?php echo $r->min_exp; ?></td>
			<td><a onclick="get_nurse_details('<?php echo $r->n_id; ?>')" data-toggle="modal" data-target="#view_det_nurse"><?php echo $r->n_name; ?></a></td>
			<td><?php echo $r->n_phn; ?></td>
			<td><?php echo date('d-m-Y',strtotime($r->time_stamp1)); ?></td>
			<td align="center"><a href="<?php echo $r->resume; ?>" onclick="change_status('<?php echo $r->apply_id; ?>','1')"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"> Resume</i></button></a></td>
			<td><a href="<?php echo $r->slicense; ?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"> License</i></button></a></td>
			<td><span id="st_<?php echo $r->apply_id; ?>"><?php echo $str; ?></span></td>
			<td>
				<select class="form-control-sm" onchange="change_status('<?php echo $r->apply_id; ?>',this.value)">
					<option value="0" <?php if($r->status == 0 ){ echo "selected"; } ?>>Applied</option>
					<option value="1" <?php if($r->status == 1 ){ echo "selected"; } ?>>Viewed</option>
					<option value="2" <?php if($r->status == 2 ){ echo "selected"; } ?>>Verified</option>
					<option value="3" <?php if($r->status == 3 ){ echo "selected"; } ?>>Accepted</option>
					<option value="10" <?php if($r->status == 10 ){ echo "selected"; } ?>>Rejected</option>
				</select>
			</td>
		</tr>

		<?php 
				}

		?>
	</tbody>
</table>
</small>
</div>


<?php 
	
	}
	
?>


<div class="modal" id="view_det_nurse">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Details of the applicant</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div id="sub3"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
	function get_nurse_details(n){
		$.ajax({
			url: "php/fetch_nurse_det.php",
			type: "POST",
			data: {
				"n_id" : n,
			},
			beforeSend:function(){
				$("#sub3").html('<h6 align="center">Loading...</h6>');
			},
			success:function(resp){
				$("#sub3").html(resp);
				//console.log(resp);
			},
		});
	}
</script>