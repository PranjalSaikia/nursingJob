<?php
 	include('connect.php');

 	$core = Core::getInstance();

 	$q = "UPDATE session_log_hospital SET is_active='0' WHERE access_token=:token";
 	$stmt=$core->dbh->prepare($q);
 	$stmt->bindParam(':token',$_SESSION['user_token'],PDO::PARAM_STR);
 	$stmt->execute();


 	session_destroy();
 	header('location: ../hospital_login.html');
 ?>