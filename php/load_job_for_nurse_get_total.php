<?php 
	include('../class/connect.php');


	$core = Core::getInstance();


	$q = "SELECT a.*,b.*,c.*,d.*, sum(a.job_no) as job_no1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' GROUP BY a.job_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute(); 
	$count = $stmt->rowCount();
	echo $count;

	?>