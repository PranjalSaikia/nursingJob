<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();

	$u_name = addslashes(strip_tags(trim($_POST['u_name'])));
	$pass = md5(addslashes(strip_tags(trim($_POST['pass']))));

	$q = "SELECT * FROM usermst WHERE username=:u_name AND password=:pass";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':u_name',$u_name,PDO::PARAM_STR);
	$stmt->bindParam(':pass',$pass,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount()>0){
		$r = $stmt->fetchObject();
		$_SESSION['username'] = $r->username;
		$_SESSION['user_id'] = $r->user_id;
		$_SESSION['category'] = $r->category;
		echo true;
	}else{
		echo false;
	}



?>