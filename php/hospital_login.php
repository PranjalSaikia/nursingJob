<?php 
	

	include('../class/connect.php');

	$core = Core::getInstance();

	$u_name = addslashes(strip_tags(trim($_POST['u_name'])));
	$pass = addslashes(strip_tags(trim($_POST['pass'])));

	$q = "SELECT * FROM hospital_master WHERE h_username=:username AND h_password=:pass AND is_verified='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':username',$u_name,PDO::PARAM_STR);
	$stmt->bindParam(':pass',$pass,PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount() >0){
		$r = $stmt->fetchObject();
		$_SESSION['user_token'] = $r->access_token;
		$_SESSION['h_id'] = $r->h_id;

		//setcookie("session_key_hospital", $r->access_token , time() + 60*60*24*120);

		$time1 = time();

		//find client IP

		$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

		$q1 = "SELECT * FROM session_log_hospital WHERE access_token=:access_token";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':access_token',$r->access_token,PDO::PARAM_STR);
		$stmt1->execute();
		if($stmt1->rowCount() >0){
			$q2 = "UPDATE session_log_hospital SET in_time=:time1, is_active='1', ip=:ip WHERE access_token=:token";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':time1',$time1,PDO::PARAM_STR);
			$stmt2->bindParam(':token',$r->access_token,PDO::PARAM_STR);
			$stmt2->bindParam(':ip',$ip,PDO::PARAM_STR);
			$stmt2->execute();
		}else{
			$q2 = "INSERT INTO session_log_hospital(access_token,in_time,is_active,ip) VALUES(:access_token,:in_time,'1',:ip)";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':access_token',$r->access_token,PDO::PARAM_STR);
			$stmt2->bindParam(':in_time',$time1,PDO::PARAM_STR);
			$stmt2->bindParam(':ip',$ip,PDO::PARAM_STR);
			$stmt2->execute();
		}



		echo true;
	}else{
		echo false;
	}





?>