<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$job_id = addslashes(strip_tags(trim($_POST['job_id'])));

	$q = "SELECT a.*,b.*,c.*,a.time_stamp as time_stamp1,d.*,a.job_location as city1 FROM job_post_h a INNER JOIN nurse_category b ON a.job_cat=b.cat_id INNER JOIN hospital_master c ON a.h_id=c.h_id INNER JOIN hospital_det d ON a.h_id=d.h_id WHERE a.job_id=:job_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':job_id',$job_id,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount()>0){
		$r = $stmt->fetchObject();


?>
<section class="job-det">
    <div class="job-card">
        <div class="nurse-card">
        <div class="hcard-text-nurse">
            <h5><?php echo $r->job_title; ?></h5> <?php echo date('d',strtotime($r->time_stamp1)); ?> <?php echo date('F',strtotime($r->time_stamp1)); ?>, <?php echo date('Y',strtotime($r->time_stamp1)); ?><br> By <?php echo $r->h_name; ?><br><br><br>

            <?php echo $r->job_no; ?> vacancies
            
        </div>

        <div class="apply-status">
    	<?php 

    		$n = new master;
    		$a1 = $n->check_apply_status($r->job_id);

    		if($a1 != 'no'){
    	?>

    	<button class="btn btn-success"><i class="fa fa-check" title="Applied"></i> Already Applied</button>
    	<?php 
    		
    		}

    	?>
    </div>
    </div>
    </div>
    
    <div class="job-des">
        <h4><?php echo $r->job_title; ?></h4>
        <p align="justify"><?php echo $r->job_des; ?></p>
    </div>
    
    
    <div class="job-des-summary">
        <div class="job-sum-card">
            
            <div>
            <h6> <b>Date posted</b></h6>
            <i class="fa fa-calendar"></i> <?php echo date('d',strtotime($r->time_stamp1)); ?> <?php echo date('F',strtotime($r->time_stamp1)); ?>, <?php echo date('Y',strtotime($r->time_stamp1)); ?> 
            </div>
            
            <div>
            <h6> <b>Location</b></h6>
            <i class="fa fa-map-marker"></i> <?php echo $r->job_location; ?>
            </div>
            
            <div>
            <h6> <b>Category</b></h6>
            <i class="fa fa-gear"></i> <?php echo $r->cat_des; ?> (<?php echo $r->cat_name; ?>) 
            </div>
        
            <div>
            <h6> <b>Salary</b></h6>
            <i class="fa fa-money"></i> <?php echo $r->min_sal; ?> 
            </div>
            
            <div>
            <h6> <b>Experience</b></h6>
            <i class="fa fa-certificate"></i> <?php echo $r->min_exp; ?> Yr 
            </div>

            
           
        </div>
    </div>
    
    <div class="job-action">

    	<?php 

    		$n = new master;
    		$a1 = $n->check_apply_status($r->job_id);

    		if($a1 != "no"){
    	?>

    	<button class="btn btn-success"><i class="fa fa-check"></i> Applied</button>
    	<!-- <button class="btn btn-danger" onclick="cancel_apply('<?php echo $r->job_id; ?>')"><i class="fa fa-close"></i> Cancel application</button> -->
    	<?php 
    		
    		}else{

    	?>
    
        <button class="btn" onclick="apply_job('<?php echo $r->job_id; ?>')">Apply this job</button>

        <?php 

        		}

        ?>
    </div>


</section>

<?php 
		
		}


?>