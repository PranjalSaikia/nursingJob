<?php 
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');



	$core = Core::getInstance();

	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));

	$q = "SELECT a.*,b.* FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id WHERE a.active_flag='0' AND a.n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	//$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()>0){
		$r = $stmt->fetchObject();


		/*$a[0] = $r->n_id;
		$a[1] = $r->n_name;
		$a[2] = $r->n_des;
		//$a[3] = $r->h_des_long;
		$a[4] = $r->district;
		$a[5] = $r->city;
		$a[6] = $r->state;
		$a[7] = $r->pin;
		$a[8] = $r->dp;
		$a[9] = $r->n_email;
		$a[10] = $r->n_phn;
		$a[11] = $r->exp;
		$a[12] = $r->resume;
		$a[13] = $r->slicense;
		$a[14] = $r->slink;*/
?>
<label><b>Personal Details</b></label>
<table width="100%">
	<tr>
		<td rowspan="5" colspan="2">
			<img src="<?php echo $r->dp; ?>" style="width: 50%">
		</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>:</td>
		<td><?php echo $r->n_name; ?></td>
	</tr>
	<tr>
		<td>Description</td>
		<td>:</td>
		<td><?php echo $r->n_des; ?></td>
	</tr>
	<tr>
		<td>Contact</td>
		<td>:</td>
		<td><?php echo $r->n_phn; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><?php echo $r->n_email; ?></td>
	</tr>

	<tr>
		<td colspan="2">&nbsp;</td>
		<td>Address</td>
		<td>:</td>
		<td><?php echo $r->city; ?>, <?php echo $r->district; ?>, <?php echo $r->state; ?>, Pin: <?php echo $r->pin; ?></td>
	</tr>
</table>
<?php
	
	$q1 = "SELECT * FROM job_exp_profile WHERE n_id=:n_id";
	$stmt1=$core->dbh->prepare($q1);
	$stmt1->bindParam(':n_id',$n_id,PDO::PARAM_STR);
	$stmt1->execute();
	if($stmt1->rowCount()>0){
?>
<hr>
<label><b>Professional Details</b></label>
<table width="100%" class="table">
	<tr>
		<td>#</td>
		<td>Post Title</td>
		<td>Period</td>
		<td>Details</td>
	</tr>
	<?php 
		$e = 1;
		while($r1 = $stmt1->fetchObject()){

	?>
	<tr>
		<td><?php echo $e;$e++; ?></td>
		<td><?php echo $r1->job_title; ?></td>
		<td><?php echo $r1->period; ?></td>
		<td><?php echo $r1->job_det; ?></td>
	</tr>

	<?php 

			}

	?>
</table>

<?php
	
	}

?>


<hr>
<label><b>Files</b></label>

<div class="row">
	<div class="col-md-4" align="center" id="item_d">
		<a href="<?php echo $r->resume; ?>"><button class="btn btn-primary" type="button">Resume <i class="fa fa-download"></i></button></a>
	</div>
	<div class="col-md-4" align="center" id="item_d">
		<a href="<?php echo $r->slicense; ?>"><button class="btn btn-primary" type="button">License <i class="fa fa-download"></i></button></a>
	</div>
	<div class="col-md-4" align="center" id="item_d">
		<a href="<?php echo $r->svideo; ?>"><button class="btn btn-primary" type="button">Video <i class="fa fa-download"></i></button></a>
	</div>
</div>






<?php 

	}

?>