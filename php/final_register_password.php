<?php 

	include('../class/connect.php');
	include('../class/class.php');

		$core = Core::getInstance();

		$password = md5(addslashes(strip_tags(trim($_POST['pass1']))));

		$q = "UPDATE nurse SET password=:password WHERE username=:username";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':password',$password,PDO::PARAM_STR);
		$stmt->bindParam(':username',$_SESSION['username'],PDO::PARAM_STR);
		$stmt->execute();

		if($stmt == true){
			$_SESSION['user'] = $_SESSION['username'];
		}





?>