<?php 
	include('../class/connect.php');
	include('../class/class.php');


	


	if(isset($_POST['cat_id'])){
		$cat_id = addslashes(strip_tags(trim($_POST['cat_id'])));
	}else{
		$cat_id = "";
	}


	if(isset($_POST['h_id1'])){
		$h_id = addslashes(strip_tags(trim($_POST['h_id1'])));
	}else{
		$h_id = "";
	}

	if(isset($_POST['location'])){
		$location = addslashes(strip_tags(trim($_POST['location'])));
	}else{
		$location = "";
	}


	if($cat_id == "" && $h_id == "" && $location == ""){}else{

	$core = Core::getInstance();

	if($cat_id != "" && $location == "" && $h_id == ""){

		$q = "SELECT a.*,b.*,c.*,d.*,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND d.cat_des LIKE :cat_id";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':cat_id',$cat_id,PDO::PARAM_STR);
		$stmt->execute();

	}

	if($location != "" && $cat_id == "" && $h_id == ""){
		$q = "SELECT a.*,b.*,c.*,a.time_stamp as time_stamp1,d.* FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN nurse_category c ON a.job_cat=c.cat_id INNER JOIN hospital_det d ON a.h_id=d.h_id WHERE a.active='1' AND a.job_location=:location";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':location',$location,PDO::PARAM_STR);
		$stmt->execute();
	}


	if($h_id != "" && $cat_id == "" && $location == ""){
		$q = "SELECT a.*,b.*,c.*,d.*,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND b.h_name LIKE :h_id";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':h_id',$h_id,PDO::PARAM_STR);
		$stmt->execute();


	}

	if($h_id != "" && $cat_id != "" && $location == ""){
		$q = "SELECT a.*,b.*,c.*,d.*,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND d.cat_des LIKE :cat_id AND b.h_name=:h_id";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':cat_id',$cat_id,PDO::PARAM_STR);
		$stmt->bindParam(':h_id',$h_id,PDO::PARAM_STR);
		$stmt->execute();


	}


	if($h_id != "" && $location != "" && $cat_id == ""){
		$q = "SELECT a.*,b.*,c.*,d.*,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND a.job_location LIKE :location AND b.h_name=:h_id";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':h_id',$h_id,PDO::PARAM_STR);
		$stmt->bindParam(':location',$location,PDO::PARAM_STR);
		$stmt->execute();


	}


	if($cat_id != "" && $location != "" && $h_id == ""){
		$q = "SELECT a.*,b.*,c.*,d.*,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND a.job_location LIKE :location AND d.cat_des=:cat_id";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':cat_id',$cat_id,PDO::PARAM_STR);
		$stmt->bindParam(':location',$location,PDO::PARAM_STR);
		$stmt->execute();


	}


	if($cat_id != "" && $location != "" && $h_id != ""){
		$q = "SELECT a.*,b.*,c.*,d.*,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND a.job_location LIKE :location AND d.cat_des=:cat_id AND b.h_name LIKE :h_id";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':cat_id',$cat_id,PDO::PARAM_STR);
		$stmt->bindParam(':location',$location,PDO::PARAM_STR);
		$stmt->bindParam(':h_id',$h_id,PDO::PARAM_STR);
		$stmt->execute();


	}

	

	if($stmt->rowCount()>0){
		echo '<h2>Search results</h2><section class="row">';
		while($r = $stmt->fetchObject()){
?>	

<div class="nurse-card col-md-4 col-sm-4 col-xs-4" style="cursor: pointer;" data-toggle="modal" data-target="#view_job_modal" onclick="get_job_det('<?php echo $r->job_id; ?>');">
    <div class="hcard-text-nurse">
    	<span style="color: blue; font-size: 12pt"><?php echo $r->job_title; ?></span><br>
    	<span align="justify" style="line-height: 13px; font-size: 10pt"><?php echo substr($r->job_des,0,70); ?>...</span><br>
        <?php echo date('d', strtotime($r->time_stamp1))." ".date('F', strtotime($r->time_stamp1)).", ".date('Y', strtotime($r->time_stamp1)); ?>, By <?php echo $r->h_name; ?><br>
        <h6>Location: <?php echo $r->job_location; ?> | Salary: <?php echo $r->min_sal; ?></h6>
    </div>
    <div class="apply-status">
    	<?php 

    		$n = new master;
    		$a1 = $n->check_apply_status($r->job_id);

    		if($a1 != "no"){
    	?>

    	<button class="btn btn-success"><i class="fa fa-check" title="Applied"></i> Applied</button>
    	<?php 
    		
    		}

    	?>
    </div>
</div>

<?php 

		}
		
	}else{
		echo '</section><hr>';
	}

}

?>



