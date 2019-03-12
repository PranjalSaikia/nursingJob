<?php
if(!isset($_SESSION)){
		session_start();
}else{	 

$user_category='';
if(isset($_SESSION['user_token']) && isset($_SESSION['h_id']))
{
	$token=$_SESSION['user_token'];	 

	//check for user in database

	$core = Core::getInstance();
	$q91 = "SELECT * FROM hospital_master WHERE h_id=:h_id AND access_token=:token AND is_verified = '1' AND active_flag='0'";
	$stmt91=$core->dbh->prepare($q91);
	$stmt91->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
	$stmt91->bindParam(':token',$_SESSION['user_token'],PDO::PARAM_STR);
	$stmt91->execute();
	if($stmt91->rowCount()==0){
		echo '<script>window.location.href="class/logout_h.php";</script>';
	}
}

else if(!isset($_SESSION['user_token']))
{
echo '<script>window.location.href="hospital_login.html";</script>';
}
}
?>