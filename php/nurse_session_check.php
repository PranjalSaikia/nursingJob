<?php 
	

	include('../class/connect.php');
	if(!isset($_SESSION)){
		session_start();
	}else{	 

		if(isset($_SESSION['user_token']))
		{
			$token=$_SESSION['user_token'];
			echo true;	 
		}

		else if(!isset($_SESSION['user_token']))
		{
			echo false;
		
		}
	}




?>