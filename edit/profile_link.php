<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$slink = addslashes(strip_tags(trim($_POST['slink'])));
	//$mlink = addslashes(strip_tags(trim($_POST['mlink'])));
	$n = $_SESSION['n_id'];

	$q = "UPDATE nurse_det SET slink=:slink WHERE n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$n,PDO::PARAM_INT);
	$stmt->bindParam(':slink',$slink,PDO::PARAM_STR);
	$stmt->execute();


?>