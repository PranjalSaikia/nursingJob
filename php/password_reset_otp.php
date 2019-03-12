<?php 
	include('../class/connect.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$otp = addslashes(strip_tags(trim($_POST['name'])));
	
	$q = "SELECT * from verify_otp where otp=:otp";
	$stmt = $core->dbh->prepare($q);
	$stmt->bindParam(':otp',$otp,PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount()>0)
	{
		$r = $stmt->fetchObject();
		$name = $r->name;
		$q1 = "SELECT access_token from nurse_master where n_username=:name and is_verified='1'";
		$stmt1 = $core->dbh->prepare($q1);
		$stmt1->bindParam(':name',$name,PDO::PARAM_STR);
		$stmt1->execute();
		if($stmt1->rowCount()>0)
		{	$r1 = $stmt1->fetchObject();
			$q2 = "delete from verify_otp where name=:name";
			$stmt2 = $core->dbh->prepare($q2);
			$stmt2->bindParam(':name',$name,PDO::PARAM_STR);
			if($stmt2->execute())
			{
			//$link = "https://www.jobforsure.in/login_nurse_first.html?token=".$r1->access_token;
			$link = 'login_nurse_first.html?token='.$r1->access_token;
			echo $link;
			}
		}
		else
		{
		$q1 = "SELECT access_token from hospital_master where h_username=:name and is_verified='1'";
		$stmt1 = $core->dbh->prepare($q1);
		$stmt1->bindParam(':name',$name,PDO::PARAM_STR);
		$stmt1->execute();
		if($stmt1->rowCount()>0)
		{	$r1 = $stmt1->fetchObject();
			$q2 = "delete from  verify_otp where name=:name";
			$stmt2 = $core->dbh->prepare($q2);
			$stmt2->bindParam(':name',$name,PDO::PARAM_STR);
			if($stmt2->execute())
			{
			//$link = "https://www.jobforsure.in/login_hospital_first.html?token=".$r1->access_token;
			$link = 'login_hospital_first.html?token='.$r1->access_token;
			echo $link;
			}
		}	
		}
	}
	else echo 0;
?>