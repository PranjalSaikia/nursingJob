<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$a = array();

	$i=0;
	$q = "SELECT * FROM nurse_category";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while ($r= $stmt->fetchObject()) {
			$a[$i][0] = $r->cat_id;
			$a[$i][1] = $r->cat_name;
			$a[$i][2] = $r->cat_des;
			$i++;
		}

		
	}else{
		$a[0] = "no";
	}

	echo json_encode($a);


?>