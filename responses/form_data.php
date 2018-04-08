<?php 

	$j = addslashes(strip_tags(trim($_POST['j'])));



	if($j == '1'){
?>

							<div class="form-group row">
								  	<div class="col-sm-3">
								  		License No
								  	</div>
								    <div class="col-sm-9">
								      	<input type="text" name="l_no1" id="l_no1" class="form-control" placeholder="Your License no" required >
								    </div>
								</div>
							  <div class="form-group row">
								  	<div class="col-sm-3">
								  		Upload your license
								  	</div>
								    <div class="col-sm-9">
								      	<input type="file" name="fileUpload1" id="fileUpload1" class="form-control" placeholder="Click here to upload" required >
								    </div>
								</div>

<?php 
	
	}elseif($j == '2'){
?>

						<div class="form-group row">
								  	<div class="col-sm-3">
								  		Receipt No
								  	</div>
								    <div class="col-sm-9">
								      	<input type="text" name="l_no2" id="l_no2" class="form-control" placeholder="Your Receipt no" required >
								    </div>
								</div>
							  <div class="form-group row">
								  	<div class="col-sm-3">
								  		Upload your receipt
								  	</div>
								    <div class="col-sm-9">
								      	<input type="file" name="fileUpload2" id="fileUpload2" class="form-control" placeholder="Click here to upload" required >
								    </div>
								</div>

<?php 
	
	}else{

?>
<?php 
	}
?>