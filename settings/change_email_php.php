<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$email = addslashes(strip_tags(trim($_POST['email'])));

	$q = "INSERT INTO email_change_req (n_id,email,status) VALUES(:n_id,:email,'0')";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_STR);
	$stmt->bindParam(':email',$email,PDO::PARAM_STR);
	$stmt->execute();


?>