<?php 

	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');


	$core = Core::getInstance();


	$h_id= addslashes(strip_tags(trim($_POST['h_id'])));
	$message = preg_replace('/(\r?\n){2,}/', '', addslashes(strip_tags(trim($_POST['message']))));

	$q = "INSERT INTO message (n_id,h_id,message,direction) VALUES(:n_id,:h_id,:message,'0')";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt->bindParam(':message',$message,PDO::PARAM_STR);
	$stmt->execute();


	echo true;

?>