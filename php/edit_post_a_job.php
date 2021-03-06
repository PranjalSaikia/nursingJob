<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$job_id = addslashes(strip_tags(trim($_POST['job_id'])));
	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));
	$job_title = addslashes(strip_tags(trim($_POST['job_title'])));
	$job_cat = addslashes(strip_tags(trim($_POST['job_cat'])));
	$job_des = $_POST['ed1'];
	$job_no = addslashes(strip_tags(trim($_POST['job_no'])));
	$min_exp = addslashes(strip_tags(trim($_POST['min_exp'])));
	$min_sal = addslashes(strip_tags(trim($_POST['min_sal'])));
	$job_location = addslashes(strip_tags(trim($_POST['job_location'])));



		$q1 = "UPDATE job_post_h SET job_title=:job_title, job_cat=:job_cat,job_des=:job_des,job_no=:job_no,min_exp=:min_exp,min_sal=:min_sal,job_location=:job_location WHERE job_id=:job_id";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':job_id',$job_id,PDO::PARAM_INT);
		$stmt1->bindParam(':job_title',$job_title,PDO::PARAM_STR);
		$stmt1->bindParam(':job_cat',$job_cat,PDO::PARAM_INT);
		$stmt1->bindParam(':job_des',$job_des,PDO::PARAM_STR);
		$stmt1->bindParam(':job_no',$job_no,PDO::PARAM_STR);
		$stmt1->bindParam(':min_exp',$min_exp,PDO::PARAM_STR);
		$stmt1->bindParam(':min_sal',$min_sal,PDO::PARAM_STR);
		$stmt1->bindParam(':job_location',$job_location,PDO::PARAM_STR);
		$stmt1->execute();
	


?>
	
	<?php 


			$q2 = "SELECT a.*,b.*,c.* FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN nurse_category c ON a.job_cat=c.cat_id WHERE a.h_id=:h_id AND a.active='1' ORDER BY a.time_stamp DESC";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':h_id',$h_id,PDO::PARAM_INT);
			$stmt2->execute();
			if($stmt2->rowCount()>0){
				echo '<div class="row">';

				while($r2 = $stmt2->fetchObject()){

	?>


						
	        			
		        			<div class="col-md-4 p-3">
		        				<div class="card" style="height: 400px; ">

		        					<div class="card-header" style="background: linear-gradient(45deg, #26D0CE, #1A2980);"><h5 ><h5 style="color: white; "><?php echo $r2->job_title; ?></h5></div>
								  
								  <div class="card-body" align="left" style="overflow-y: auto">

								  <b>Description:</b> &nbsp;<?php echo $r2->job_des; ?>
								  <br>
								  <b>Category:</b> &nbsp;<?php echo $r2->cat_name; ?>
								  <br>
								  <b>No of vacancies:</b> &nbsp;<?php echo $r2->job_no; ?>
								  <br>
								  <b>Minimum Experience:</b> &nbsp;<?php echo $r2->min_exp; ?> Years
								  <br>
								  <b>Minimum Salary:</b> &nbsp;<?php echo $r2->min_sal; ?> 
								  <br>
								  <b>Job location:</b> &nbsp;<?php echo $r2->job_location; ?>
								  <br>
								  <b>Posted on:</b> &nbsp;<?php echo date('d-m-Y',strtotime($r2->time_stamp)); ?>

								  	

								    
								  </div>

								  <div class="card-footer" align="center">
								  	<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_job_modal" onclick="edit_job('<?php echo $r2->job_id; ?>')"><i class="fa fa-pencil"> Edit JOB</i></button>
								  	<button class="btn btn-danger" type="button" onclick="delete_job('<?php echo $r2->job_id; ?>')"><i class="fa fa-trash"> Delete Job</i></button>
								  </div>
								
								</div>
		        			</div>
	        			

	        			<?php 
	        					}

	        				}
	        				
	        		?>
	        		<div>