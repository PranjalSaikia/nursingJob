<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();

	$file_type = addslashes(strip_tags(trim($_POST['file_type'])));
	$location = addslashes(strip_tags(trim($_POST['location'])));
	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));

	if($file_type == 1){
		$str = 'company_profile';
		$str1 = 'company_profile_status';
	}else if($file_type == 2){
		$str = 'videos_h';
		$str1 = 'videos_h_status';
	}
	if($location == ""){
		echo "<h3 align='center'>Not Uploaded</h3>";
	
	}else{
		
	


?>
<iframe src="<?php echo '../'.$location; ?>" width="100%" height="600px;"></iframe>
<br/>
<br/>
<br/>
<div class="container">
	<div class="row">
		<div class="col-md-12" align="center" id="s3">
			<?php 

				$q = "SELECT * FROM hospital_det WHERE h_id=:h_id";
				$stmt=$core->dbh->prepare($q);
				$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
				$stmt->execute();
				if($stmt->rowCount()>0){
					$r = $stmt->fetchObject();
					if($r->$str1 == 0){

			?>
			<button class="btn btn-success" type="button" onclick="change_to_verified('<?php echo $file_type; ?>','<?php echo $h_id; ?>')">Mark as verified</button>
			<?php 
					}else{
						echo '<button class="btn btn-success"><i class="fa fa-check"> Verified</i></button>';
					}
				}

			?>
		</div>
	</div>
</div>

<?php 
	
	}

?>