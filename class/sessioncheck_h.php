<?php
if(!isset($_SESSION)){
		session_start();
}else{	 

$user_category='';
if(isset($_SESSION['user_token']))
{
	$token=$_SESSION['user_token'];	 
}

else if(!isset($_SESSION['category']))
{
header('location: ../hospital_login.html');
}
}
?>