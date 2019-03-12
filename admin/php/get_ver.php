<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();

	$file_type = addslashes(strip_tags(trim($_POST['file_type'])));
	$location = addslashes(strip_tags(trim($_POST['location'])));
	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));

	if($file_type == 1){
		$str = 'resume';
		$str1 = 'resume_status';
	}else if($file_type == 2){
		$str = 'slicense';
		$str1 = 'slicense_status';
	}else if($file_type == 3){
		$str = 'svideo';
		$str1 = 'svideo_status';
	}

	if($location == ""){
		echo "<h3 align='center'>Not Uploaded</h3>";

	}else{
		
	}


?>
<iframe src="<?php echo '../'.$location; ?>" width="100%" height="600px;"></iframe>
<br/>
<br/>
<br/>
<div class="container">
	<div class="row">
		<div class="col-md-12" align="center" id="s3">
			<?php 

				$q = "SELECT * FROM nurse_det WHERE n_id=:n_id";
				$stmt=$core->dbh->prepare($q);
				$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
				$stmt->execute();
				if($stmt->rowCount()>0){
					$r = $stmt->fetchObject();
					if($r->$str1 == 0){

			?>
			<button class="btn btn-success" type="button" onclick="change_to_verified('<?php echo $file_type; ?>','<?php echo $n_id; ?>')">Mark as verified</button>
			<?php 
					}else{
						echo '<button class="btn btn-success"><i class="fa fa-check"> Verified</i></button>';
					}
				}

			?>
		</div>
	</div>
</div>