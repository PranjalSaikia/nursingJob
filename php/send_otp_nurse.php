<?php 
include('../class/connect.php');
include('../class/class.php');

$name = addslashes(strip_tags(trim($_POST['name'])));
$email = addslashes(strip_tags(trim($_POST['email'])));
$phn = addslashes(strip_tags(trim($_POST['phn'])));

$n = new master();
$otp = bin2hex(openssl_random_pseudo_bytes(3));
$flag = json_decode($n->send_sms($phn,$name,$otp),true);

$core = Core::getInstance();

if($flag['ErrorMessage']==='Success'){
$q = "INSERT INTO verify_otp(otp,name,email,phn) values(:otp,:name,:email,:phn)";
$stmt = $core->dbh->prepare($q);
$stmt->bindParam(':otp',$otp,PDO::PARAM_STR);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':email',$email,PDO::PARAM_STR);
$stmt->bindParam(':phn',$phn,PDO::PARAM_STR);
if($stmt->execute())
{
	?>
	<p align="justify">An OTP has been sent to your mobile number: <b><?php echo $phn; ?></b>. Please verify your mobile number.Please <a href="send_otp_nurse.html"> click here </a>to verify.</p>
	<?php
}
else echo 'Something went wrong. Please try again';
}
?>