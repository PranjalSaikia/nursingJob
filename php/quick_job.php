<?php 

	include('../class/connect.php');

	$core = Core::getInstance();


	$name = addslashes(strip_tags(trim($_POST['name'])));
	$address = addslashes(strip_tags(trim($_POST['address'])));
	$city = addslashes(strip_tags(trim($_POST['city'])));
	$category = addslashes(strip_tags(trim($_POST['category'])));
	$email = addslashes(strip_tags(trim($_POST['email'])));
	$phno = addslashes(strip_tags(trim($_POST['phno'])));



	$q = "INSERT INTO quick_job(name,address,city,category,email,phno,status) VALUES(:name,:address,:city,:category,:email,:phno,'1')";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':name',$name,PDO::PARAM_STR);
	$stmt->bindParam(':address',$address,PDO::PARAM_STR);
	$stmt->bindParam(':city',$city,PDO::PARAM_STR);
	$stmt->bindParam(':category',$category,PDO::PARAM_INT);
	$stmt->bindParam(':email',$email,PDO::PARAM_STR);
	$stmt->bindParam(':phno',$phno,PDO::PARAM_STR);
	$stmt->execute();




?>