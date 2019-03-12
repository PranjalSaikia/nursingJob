<?php
session_start();
$user_category='';
if(isset($_SESSION['category']))
{
	

	$user_category=$_SESSION['category'];
	if($user_category=='1')
	{
		$username=$_SESSION['username'];
		
		 

	}
	else if($user_category=='2')
	{
		$username=$_SESSION['username'];
		 
	}
	echo true;
	 
}

else if(!isset($_SESSION['category']))
{
header('location:index.html');
echo false;
}

?>