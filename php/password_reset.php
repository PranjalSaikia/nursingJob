<?php 
	

	include('../class/connect.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$phn = addslashes(strip_tags(trim($_POST['name'])));
	

	$q = "SELECT * FROM nurse_master WHERE n_phn=:n_phn  AND is_verified='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_phn',$phn,PDO::PARAM_STR);
	
	$stmt->execute();

	if($stmt->rowCount() >0){
		$r = $stmt->fetchObject();
		$_SESSION['user_token'] = $r->access_token;
		$_SESSION['n_id'] = $r->n_id;
		$name = $r->n_username;
		$n = new master();
		$otp = bin2hex(openssl_random_pseudo_bytes(3));
		print_r($flag = json_decode($n->send_sms($phn,$name,$otp),true));
		//setcookie("session_key_hospital", $r->access_token , time() + 60*60*24*120);
		
		$q1 ="INSERT INTO verify_otp(name,otp) values(:name,:otp)";
		$stmt1 = $core->dbh->prepare($q1);
		$stmt1->bindParam(':name',$name,PDO::PARAM_STR);
		$stmt1->bindParam(':otp',$otp,PDO::PARAM_STR);
		$stmt1->execute();
		$time1 = time();

		//find client IP

		$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

		$q1 = "SELECT * FROM session_log_nurse WHERE access_token=:access_token";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':access_token',$r->access_token,PDO::PARAM_STR);
		$stmt1->execute();
		if($stmt1->rowCount() >0){
			$q2 = "UPDATE session_log_nurse SET in_time=:time1, is_active='1', ip=:ip WHERE access_token=:token";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':time1',$time1,PDO::PARAM_STR);
			$stmt2->bindParam(':token',$r->access_token,PDO::PARAM_STR);
			$stmt2->bindParam(':ip',$ip,PDO::PARAM_STR);
			$stmt2->execute();
		}else{
			$q2 = "INSERT INTO session_log_nurse(access_token,in_time,is_active,ip) VALUES(:access_token,:in_time,'1',:ip)";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':access_token',$r->access_token,PDO::PARAM_STR);
			$stmt2->bindParam(':in_time',$time1,PDO::PARAM_STR);
			$stmt2->bindParam(':ip',$ip,PDO::PARAM_STR);
			$stmt2->execute();
		}


		if($flag['ErrorMessage']==='Success')
		echo 1;
	}




	$q = "SELECT * FROM hospital_master WHERE h_phn=:h_phn  AND is_verified='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_phn',$phn,PDO::PARAM_STR);
	
	$stmt->execute();

	if($stmt->rowCount() >0){
		$r = $stmt->fetchObject();
		$_SESSION['user_token'] = $r->access_token;
		$_SESSION['h_id'] = $r->h_id;
		$name = $r->h_username;
		$n = new master();
		$otp = bin2hex(openssl_random_pseudo_bytes(3));
		$flag = json_decode($n->send_sms($phn,$name,$otp),true);
		//setcookie("session_key_hospital", $r->access_token , time() + 60*60*24*120);
		//ini_set('max_execution_time', 9000);
		$time1 = time();
		$q1 ="INSERT INTO verify_otp(name,otp) values(:name,:otp)";
		$stmt1 = $core->dbh->prepare($q1);
		$stmt1->bindParam(':name',$name,PDO::PARAM_STR);
		$stmt1->bindParam(':otp',$otp,PDO::PARAM_STR);
		$stmt1->execute();
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



		if($flag['ErrorMessage']==='Success')
		echo 2;
	}

?>