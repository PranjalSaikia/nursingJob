<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$ty = addslashes(strip_tags(trim($_POST['ty'])));

	if($ty == 1){
		$dir = '../uploads/Resume/';
	}elseif($ty == 2){
		$dir = '../uploads/License/';
	}elseif($ty == 3){
		$dir = '../uploads/videos/';
	}elseif($ty == 4){
		$dir = '../uploads/hospital/';
	}elseif($ty == 10){
		$dir = '../uploads/company_profile/';
	}elseif($ty == 11){
		$dir = '../uploads/videos_h/';
	}

	$fname = "file".$ty;

	$n = new master;
	$a1 = $n->file_upload($dir, $fname, $_SESSION['h_id']);

	$a2 = substr($a1, 3);

	if($ty == 1){
		$q21 = "UPDATE nurse_det SET resume=:fi WHERE n_id=:n_id";
		$stmt21=$core->dbh->prepare($q21);
		$stmt21->bindParam(':fi',$a2,PDO::PARAM_STR);
		$stmt21->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
		$stmt21->execute();	
	}elseif($ty == 2){
		$q21 = "UPDATE nurse_det SET slicense=:fi WHERE n_id=:n_id";
		$stmt21=$core->dbh->prepare($q21);
		$stmt21->bindParam(':fi',$a2,PDO::PARAM_STR);
		$stmt21->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
		$stmt21->execute();
	}elseif($ty == 3){
		$q21 = "UPDATE nurse_det SET svideo=:fi WHERE n_id=:n_id";
		$stmt21=$core->dbh->prepare($q21);
		$stmt21->bindParam(':fi',$a2,PDO::PARAM_STR);
		$stmt21->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
		$stmt21->execute();
	}elseif($ty == 4){
		$q21 = "UPDATE hospital_det SET dp=:fi WHERE h_id=:h_id";
		$stmt21=$core->dbh->prepare($q21);
		$stmt21->bindParam(':fi',$a2,PDO::PARAM_STR);
		$stmt21->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
		$stmt21->execute();
	}elseif($ty == 10){
		$q21 = "UPDATE hospital_det SET company_profile=:fi WHERE h_id=:h_id";
		$stmt21=$core->dbh->prepare($q21);
		$stmt21->bindParam(':fi',$a2,PDO::PARAM_STR);
		$stmt21->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
		$stmt21->execute();
	}elseif($ty == 11){
		$q21 = "UPDATE hospital_det SET videos_h=:fi WHERE h_id=:h_id";
		$stmt21=$core->dbh->prepare($q21);
		$stmt21->bindParam(':fi',$a2,PDO::PARAM_STR);
		$stmt21->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
		$stmt21->execute();
	}				
	

?>