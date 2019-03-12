<?php 

	include('../class/connect.php');
	include('../class/class.php');

	$core = Core::getInstance();

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

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

	//do someting here

	$q = "SELECT * FROM nurse_master WHERE n_email=:n_email";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_email',$email,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount() == 0){
	
	//Generate an access token
	$token = bin2hex(openssl_random_pseudo_bytes(20));

	$q1 = "INSERT INTO nurse_master(n_name,n_phn,n_email,n_username,n_password,access_token,active_flag,is_verified) VALUES(:n_name,:n_phn,:n_email,:n_email,'',:access_token,'0','0')";
	$stmt1=$core->dbh->prepare($q1);
	$stmt1->bindParam(':n_name',$name,PDO::PARAM_STR);
	$stmt1->bindParam(':n_email',$email,PDO::PARAM_STR);
	$stmt1->bindParam(':n_phn',$phn,PDO::PARAM_STR);
	$stmt1->bindParam(':access_token',$token,PDO::PARAM_STR);
	if($stmt1->execute())
	{
		$q2 = "TRUNCATE verify_otp";
		$stmt2 = $core->dbh->prepare($q2);
		if($stmt2->execute())
			{
		$link = "https://www.jobforsure.in/login_nurse_first.html?token=".$token;

		//$link = "login_nurse_first.html?token=".$token;
	//send mail for username and password set

		ini_set('max_execution_time', 9000);
		
		require 'src/Exception.php';
		require 'src/PHPMailer.php';
		require 'src/SMTP.php';
		




		$to_email = $email;
		$message = "<html><body>";
		$message .= "<br>";
		$message .= "<h2>Welcome to jobforsure.in . Thank you for registering with us.<br></h2><br>";
		$message .= "<h3>Your documents will be verified very soon. Please go throught the following link to set the password for your account. You have to complete your profile information afterwards before searching jobs.</h3><br>";
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


	}
	else echo 0;
}
else echo 0;
?>