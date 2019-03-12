<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');


	$core = Core::getInstance();


	$h_id= addslashes(strip_tags(trim($_POST['h_id'])));

	$q = "INSERT INTO skype_req (n_id,h_id,direction) VALUES(:n_id,:h_id,'0')";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt->execute();

	echo true;

?>