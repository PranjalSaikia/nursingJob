<?php 
	
	include('../class/connect.php');

	$core = Core::getInstance();


	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));
	$link = addslashes(strip_tags(trim($_POST['link'])));
	$h_email = addslashes(strip_tags(trim($_POST['h_email'])));



		ini_set('max_execution_time', 9000);
		
		require 'src/Exception.php';
		require 'src/PHPMailer.php';
		require 'src/SMTP.php';
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;




		$to_email = $h_email;
		$message = "<html><body>";
		$message .= "<br>";
		$message .= "<h2>Document Verification Process Completed<br></h2><br>";
		$message .= "<h3>Your documents have been verified. Please go throught the following link to set the password for your account</h3><br>";
		$message .="<a href='".$link."'>Click Here</a>";
		$message .= '<p>Dear Recruiter, <br> Please respond to this mail.</p>';
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
		$email->Subject   = 'Documents verified - Job for Sure';
		$email->Body      = $message;
		$email->AddAddress( $to_email );
		$email->Send();

		echo "succesfully sent";

?>
