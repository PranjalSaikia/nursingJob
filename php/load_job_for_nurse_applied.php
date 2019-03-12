<?php 
	include('../class/connect.php');
	include('../class/class.php');

	$n = addslashes(strip_tags(trim($_POST['n'])));
	//$n = ($n-1)*6;
	$n = $n-8;
	//echo '<script>console.log('.$n.');</script>';


?>
	
	<section class="featured-jobs">


<?php 

	$core = Core::getInstance();


	$q = "SELECT e.*,a.*,b.*,c.*,d.*, sum(a.job_no) as job_no1,a.time_stamp as time_stamp1 FROM job_apply e INNER JOIN job_post_h a ON e.job_id=a.job_id INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' AND e.n_id=:n_id GROUP BY a.job_id ";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_STR);
	$stmt->execute(); $count = $stmt->rowCount();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetchObject()){
?>	

<div class="nurse-card" style="cursor: pointer;" data-toggle="modal" data-target="#view_job_modal" onclick="get_job_det('<?php echo $r->job_id; ?>');">
    <div class="hcard-text-nurse">
    	<span style="color: blue; font-size: 12pt"><?php echo $r->job_title; ?></span><br>
    	<span align="justify" style="line-height: 13px; font-size: 10pt"><?php echo substr($r->job_des,0,70); ?>...</span><br>
        <?php echo date('d', strtotime($r->time_stamp1))." ".date('F', strtotime($r->time_stamp1)).", ".date('Y', strtotime($r->time_stamp1)); ?>, By <?php echo $r->h_name; ?><br>
        <h6>Location: <?php echo $r->job_location; ?> | Salary: <?php echo $r->min_sal; ?></h6>
    </div>
    <div class="apply-status">
    	<?php 
    		$str = "";
    		$n = new master;
    		$a1 = $n->check_apply_status($r->job_id);

    		
    		if($a1 != 'no'){
				if($a1 == 0){
					$str = "<span style='color: black'>Received</span>";
				}elseif($a1 == 1){
					$str = "<span style='color: blue'>MayBe</span>";
				}elseif($a1 == 2){
					$str = "<span style='color: green'>Accepted</span>";
				}elseif($a1 == 3){
					$str = "<span style='color: red'>Rejected</span>";
				}

				echo $str;
			}

				?>
    	
    </div>
</div>

<?php 

		}
		
	}else{

?>
	
	<div class="row">
		
		<div class="col-md-12 col-xs-12" align="right">No more jobs</div>

	</div>


<?php


	}

?>
</section>