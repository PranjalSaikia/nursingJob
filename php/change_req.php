<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$id = addslashes(strip_tags(trim($_POST['id'])));
	$seen = addslashes(strip_tags(trim($_POST['seen'])));

	$q = "UPDATE interested SET seen=:seen WHERE id=:id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':id',$id,PDO::PARAM_INT);
	$stmt->bindParam(':seen',$seen,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->execute() == true){
		echo true;
	}else{
		echo false;
	}

?>
