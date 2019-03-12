<?php 
	include('../class/connect.php');
	include('../class/class.php');

	$n = addslashes(strip_tags(trim($_POST['n'])));
	$sorted = addslashes(strip_tags(trim($_POST['sorted'])));
	//$n = ($n-1)*6;
	//$n = $n-8;
	$n = $n - 2;
	//echo '<script>console.log('.$sorted.');</script>';
	$str = "";
	if($sorted == '1'){
		$str = "ORDER BY a.time_stamp DESC";
	}else if($sorted == '2'){
		$str = "ORDER BY a.job_location DESC";
	}else if($sorted == '3'){
		$str = "ORDER BY a.min_exp DESC";
	}

?>
	
	


<?php 

	$core = Core::getInstance();


	$q = "SELECT a.*,b.*,c.*,d.*, sum(a.job_no) as job_no1,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1'  GROUP BY a.job_id $str LIMIT 2 OFFSET :n ";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n',$n,PDO::PARAM_INT);
	//$stmt->bindParam(':str',$str,PDO::PARAM_STR);
	$stmt->execute(); $count = $stmt->rowCount();
	if($stmt->rowCount()>0){
		echo '<section class="row">';
		while($r = $stmt->fetchObject()){
?>	

<div class="nurse-card" style="cursor: pointer;" data-toggle="modal" data-target="#view_job_modal" onclick="get_job_det('<?php echo $r->job_id; ?>');" class="col-md-4 col-sm-4 col-xs-4 py-2">
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
		echo '</section>';
	}else{
		echo false;
	}
	?>