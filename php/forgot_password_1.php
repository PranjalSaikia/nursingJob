<?php 

	include('../class/connect.php');

	$core = Core::getInstance();

	$email = addslashes(strip_tags(trim($_POST['email'])));

	$q = "SELECT * FROM hospital_master WHERE n_email=:email AND is_verified='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':email',$email,PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount()>0){
		
		$r = $stmt->fetchObject();

		$to_email = $email;
		$subject = "Password Reset: Nursing Job Portal";
		$headers = "From: nursingjob@gmail.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$message = "<html><body>";
		$message .= "<br>";
		$message .= "<h1>Please click here to reset your password<br></h1><br>";
		$message .= '<a href="http://nursing.bahonafeedback.com/login_nurse_first.html?token='.$r->access_token.'&s=1"><b>Click Here</b></a>';
		$message .="</body></html>";
		
		mail($to_email,$subject,$message,$headers);


		echo '<h4>A password reset link has been sent to your email.</h4>';


	}else{
		echo '<h6>You have entered a wrong email address.</h6>';
	}


?>