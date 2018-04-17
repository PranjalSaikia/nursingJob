<?php 
	

	include('../class/connect.php');
	if(!isset($_COOKIE)){
		session_start();
	}else{	 

	if(isset($_COOKIE['session_key_hospital']))
	{
		$token=$_COOKIE['session_key_hospital'];
		echo true;	 
	}

	else if(!isset($_COOKIE['session_key_hospital']))
	{
		echo false;
	
	}
	}




?>