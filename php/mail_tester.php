<?php
	ini_set('max_execution_time', 9000);
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require 'src/Exception.php';
	require 'src/PHPMailer.php';
	require 'src/SMTP.php';
	
	$to_email = "chandan.khalepara100@gmail.com";
	$message = "<html><body>";
	$message .= "<br>";
	$message .= "<h2>Welcome to jobforsure.in . Thank you for registering with us.<br></h2><br>";
	$message .= "<h3>Your documents will be verified very soon. Please go throught the following link to set the password for your account. You have to complete your profile information afterwards before searching jobs.</h3><br>";
	$message .="<a href='hey'>Click Here</a>";
	$message .= '<p>Ignore this Link if already done.</p>';
	$message .="</body></html>";
	
	
	//emailer

	$email = new PHPMailer();

	$email->IsHTML(true);
	$email->isSMTP();
	$email->SMTPDebug = 1;
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


?>