<?php 

	include('../class/connect.php');
	include('../class/class.php');

	$name = addslashes(strip_tags(trim($_POST['name'])));
	$username = addslashes(strip_tags(trim($_POST['username'])));

	$n = new master;
	$a1 = $n->check_duplicate($username);

	echo $a1;

	if($a1 == 1){
		$_SESSION['name'] = $name; 
		$_SESSION['username'] = $username; 
	}




?>