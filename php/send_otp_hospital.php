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
$n = new master;
$dir = "../uploads/letter_inc/";
$a1 = $n->file_upload($dir, 'myfile1', $otp);
$a1 = substr($a1, 3);

$dir1 = "../uploads/bank_det/";
$a2 = $n->file_upload($dir1, 'myfile2', $otp);
$a2 = substr($a2, 3);

$file_to_attach = "../".$a1;
$file_to_attach1 = "../".$a2;

if($flag['ErrorMessage']==='Success'){
$q = "INSERT INTO verify_otp(otp,name,email,phn,license,bank) values(:otp,:name,:email,:phn,:license,:bank)";
$stmt = $core->dbh->prepare($q);
$stmt->bindParam(':otp',$otp,PDO::PARAM_STR);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':email',$email,PDO::PARAM_STR);
$stmt->bindParam(':phn',$phn,PDO::PARAM_STR);
$stmt->bindParam(':license',$a1,PDO::PARAM_STR);
$stmt->bindParam(':bank',$a2,PDO::PARAM_STR);
if($stmt->execute())
{
	?>
	<p align="justify">An OTP has been sent to your mobile number: <b><?php echo $phn; ?></b>. Please verify your mobile number.Please <a href="send_otp_hospital.html"> click here </a>to verify.</p>
	<?php
}
else echo 'Something went wrong. Please try again';
}
?>