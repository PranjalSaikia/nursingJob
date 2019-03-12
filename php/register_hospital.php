<?php 

	include('../class/connect.php');
	include('../class/class.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	

	$core = Core::getInstance();

	$otp = addslashes(strip_tags(trim($_POST['name'])));
	$q1 = "SELECT * from verify_otp where otp=:otp order by id desc";
	$stmt1 = $core->dbh->prepare($q1);
	$stmt1->bindParam(':otp',$otp,PDO::PARAM_STR);
	$stmt1->execute();
	if($stmt1->rowCount()>0)
	{
	$r1 = $stmt1->fetchObject();
	$name = $r1->name;
	$email = $r1->email;
	$phn = $r1->phn;
	$license = $r1->license;
	$bank = $r1->bank;

	//do someting here

	$q = "SELECT * FROM hospital_master WHERE h_name=:h_name AND h_email=:h_email";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_name',$name,PDO::PARAM_STR);
	$stmt->bindParam(':h_email',$email,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount() == 0){
	
	//Generate an access token
	$token = bin2hex(openssl_random_pseudo_bytes(20));

	$q1 = "INSERT INTO hospital_master(h_name,h_address,h_phn,h_email,h_username,h_password,access_token,active_flag,is_verified) VALUES(:h_name,'',:h_phn,:h_email,:h_email,'',:access_token,'0','0')";
	$stmt1=$core->dbh->prepare($q1);
	$stmt1->bindParam(':h_name',$name,PDO::PARAM_STR);
	$stmt1->bindParam(':h_email',$email,PDO::PARAM_STR);
	$stmt1->bindParam(':h_phn',$phn,PDO::PARAM_STR);
	$stmt1->bindParam(':access_token',$token,PDO::PARAM_STR);
	if(!$stmt1->execute()) print_r($stmt1->errorInfo());

	$q2 = "SELECT max(h_id) as h_id FROM hospital_master";
	$stmt2=$core->dbh->prepare($q2);
	$stmt2->execute();
	if($stmt2->rowCount()>0){
		$r2 = $stmt2->fetchObject();
		$h_id = $r2->h_id;
	}else{
		$h_id = 1;
	}

	$q3 = "SELECT * FROM hospital_det WHERE h_id=:h_id";
	$stmt3=$core->dbh->prepare($q3);
	$stmt3->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt3->execute();
	if($stmt3->rowCount()==0){
		$q4 = "INSERT INTO hospital_det (h_id,h_des_short,h_des_long,region, city, district, state, pin, dp, letter_inc, bank_det) VALUES(:h_id,'','','','','','','','',:letter_inc, :bank_det)";
		$stmt4=$core->dbh->prepare($q4);
		$stmt4->bindParam(':h_id',$h_id,PDO::PARAM_INT);
		$stmt4->bindParam(':letter_inc',$license,PDO::PARAM_STR);
		$stmt4->bindParam(':bank_det',$bank,PDO::PARAM_STR);
		$stmt4->execute();
	}else{
		$q4 = "UPDATE hospital_det SET letter_inc=:letter_inc, bank_det=:bank_det WHERE h_id=:h_id";
		$stmt4=$core->dbh->prepare($q4);
		$stmt4->bindParam(':h_id',$h_id,PDO::PARAM_INT);
		$stmt4->bindParam(':letter_inc',$license,PDO::PARAM_STR);
		$stmt4->bindParam(':bank_det',$bank,PDO::PARAM_STR);
		$stmt4->execute();
	}
	
		$q2 = "TRUNCATE verify_otp";
		$stmt2 = $core->dbh->prepare($q2);
		if($stmt2->execute())
			{
		//$link = "https://www.jobforsure.in/login_hospital_first.html?token=".$token;

		$link = "login_hospital_first.html?token=".$token;
		//send mail for username and password set

		ini_set('max_execution_time', 9000);
		
		require 'src/Exception.php';
		require 'src/PHPMailer.php';
		require 'src/SMTP.php';
		


		$to_email = $email;
		$message = "<html><body>";
		$message .= "<br>";
		$message .= "<h2>Welcome to jobforsure.in . Thank you for registering with us.<br></h2><br>";
		$message .= "<h3>Your documents will be verified very soon. Please go throught the following link to set the password for your account.</h3><br>";
		$message .="<a href='".$link."'>Click Here</a>";
		$message .= '<p>Ignore this Link if already done.</p>';
		$message .="</body></html>";
		
		
		//emailer

		$email = new PHPMailer();

		$email->IsHTML(true);
		$email->isSMTP();
		$email->SMTPDebug = false;
		$email->SMTPAuth = true;
		$email->SMTPSecure = 'ssl';
		$email->Host = "smtp.gmail.com";
		$email->Mailer = "smtp";
		$email->Port = 465;
		$email->Username = "jobforsurein@gmail.com";
		$email->Password = "Corexx@123";
		$email->SetFrom('jobforsurein@gmail.com');
		$email->Subject   = 'Welcome to - Jobforsure.in';
		$email->Body      = $message;
		$email->AddAddress( $to_email );
		$email->Send();
		echo $link;
			}
		else echo 0;
	}


	
	else echo 0;
}
else echo 0;
?>