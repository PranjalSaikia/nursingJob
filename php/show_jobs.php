<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$n = addslashes(strip_tags(trim($_POST['n'])));
	$n = ($n-1)*6;

	$q = "SELECT * FROM hospital_master WHERE access_token=:token";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->execute();
	$r = $stmt->fetchObject();

	$h_id = $r->h_id;

	$q2 = "SELECT a.*,b.*,c.* FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN nurse_category c ON a.job_cat=c.cat_id WHERE a.h_id=:h_id AND a.active='1' ORDER BY a.time_stamp DESC LIMIT :n,6 ";
	$stmt2=$core->dbh->prepare($q2);
	$stmt2->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt2->bindParam(':n',$n,PDO::PARAM_INT);
	$stmt2->execute();
	if($stmt2->rowCount()>0){
		echo '<div class="row">';

		while($r2 = $stmt2->fetchObject()){

	?>


						
	        			
		        			<div class="col-md-4 p-3">
		        				<div class="card" style="height: 450px; ">

		        					<div class="card-header" style="background: linear-gradient(45deg, #26D0CE, #1A2980);"><h5 style="color: white; "><?php echo $r2->job_title; ?></h5></div>
								  
								  <div class="card-body" align="left" style="overflow-y: auto">

								  <b>Description:</b> &nbsp;<?php echo $r2->job_des; ?>
								  <br>
								  <b>Category:</b> &nbsp;<?php echo $r2->cat_name; ?>
								  <br>
								  <b>No of vacancies:</b> &nbsp;<?php echo $r2->job_no; ?>
								  <br>
								  <b>Minimum Experience:</b> &nbsp;<?php echo $r2->min_exp; ?> Years
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
	        	</div>
