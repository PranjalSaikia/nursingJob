<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
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
		$dir = '../uploads/nurse/';
	}

	$fname = "file".$ty;

	$n = new master;
	$a1 = $n->file_upload($dir, $fname, $_SESSION['n_id']);

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
		$q21 = "UPDATE nurse_det SET dp=:fi WHERE n_id=:n_id";
		$stmt21=$core->dbh->prepare($q21);
		$stmt21->bindParam(':fi',$a2,PDO::PARAM_STR);
		$stmt21->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
		$stmt21->execute();
	}		
	

?>