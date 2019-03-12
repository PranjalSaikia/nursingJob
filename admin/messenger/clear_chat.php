<?php 

	include('../class/connect.php');

	$core = Core::getInstance();

	$ip = addslashes(strip_tags(trim($_POST['ip'])));

	$q = "DELETE FROM chat WHERE ip=:ip";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
	$stmt->execute();

	



?>