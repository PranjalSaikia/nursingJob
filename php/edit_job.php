<?php 
		


		include('../class/connect.php');
		include('../class/sessioncheck_h.php');
		include('../class/class.php');

		$core = Core::getInstance();

		$job_id = addslashes(strip_tags(trim($_POST['n'])));

		$q = "SELECT * FROM job_post_h WHERE job_id = :job_id";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':job_id',$job_id,PDO::PARAM_STR);
		$stmt->execute();

		while($r = $stmt->fetchObject()){
?>	
	


				<input type="hidden" name="h_id" id="h_id" value="<?php echo $r->h_id; ?>">
				<input type="hidden" name="job_id" id="job_id" value="<?php echo $r->job_id; ?>">
						  		<div class="row">
						  			<div class="form-group col-md-4">
						  				<label>Job Title</label>
						  			</div>
						  			<div class="form-group col-md-8">
						  				<input type="text" class="form-control" name="job_title" id="job_title" placeholder="Choose a title"  value="<?php echo $r->job_title; ?>">
						  			</div>
						  		</div>

						  		<div class="row" >
						  			<div class="form-group col-md-4">
						  				<label>Job Category</label>
						  			</div>
						  			<div class="form-group col-md-8">
						  				<select name="job_cat" id="job_cat" class="form-control" required>
						  					<option value="">Choose one</option>
						  					<?php 

						  						$q1 = "SELECT * FROM nurse_category";
						  						$stmt1=$core->dbh->prepare($q1);
						  						$stmt1->execute();
						  						if($stmt1->rowCount()>0){
						  							while($r1 = $stmt1->fetchObject()){

						  					?>

						  					<option value="<?php echo $r1->cat_id; ?>" <?php if($r1->cat_id == $r->job_cat){ echo "selected"; } ?>><?php echo $r1->cat_name; ?> - <?php echo $r1->cat_des; ?></option>

						  					<?php 
						  							}
						  						}
						  					?>

						  				</select>
						  			</div>
						  		</div>

						  		<div class="row">
						  			<div class="form-group col-md-4">
						  				<label>Job Description</label>
						  			</div>
						  			<div class="form-group col-md-8">
						  				<input type="text" name="textid" id="textid" readonly style="display:none" value="" /> 
							          <textarea name="ed1" id="ed1"><?php echo $r->job_des; ?></textarea> 
							           <script>

							              CKEDITOR.replace( 'ed1', { height:400, 
							                
							                   allowedContent: true
							                   
							              } );

							            </script>
						  			</div>
						  		</div>

						  		<div class="row">
						  			<div class="form-group col-md-4">
						  				<label>No of Vacancies</label>
						  			</div>
						  			<div class="form-group col-md-8">
						  				<input type="number" class="form-control" name="job_no" id="job_no" placeholder="Number of vacancies" value="<?php echo $r->job_no; ?>">
						  			</div>
						  		</div>

						  		<div class="row">
						  			<div class="form-group col-md-4">
						  				<label>Minimum Experience</label>
						  			</div>
						  			<div class="form-group col-md-8">
						  				<input type="number" class="form-control" name="min_exp" id="min_exp" placeholder="Minimum year of Experience (in years e.g. 1.5)" value="<?php echo $r->min_exp; ?>">
						  			</div>
						  		</div>

						  		<div class="row">
						  			<div class="form-group col-md-4">
						  				<label>Minimum Salary</label>
						  			</div>
						  			<div class="form-group col-md-8">
						  				<input type="text" class="form-control" name="min_sal" id="min_sal" placeholder="Minimum Salary to be offered)" value="<?php echo $r->min_sal; ?>">
						  			</div>
						  		</div>

						  		<div class="row">
						  			<div class="form-group col-md-4">
						  				<label>Job Location</label>
						  			</div>
						  			<div class="form-group col-md-8">
						  				<input type="text" class="form-control" name="job_location" id="job_location" placeholder="Job location (Name of the city)" value="<?php echo $r->job_location; ?>">
						  			</div>
						  		</div>



<?php 

	}

?>