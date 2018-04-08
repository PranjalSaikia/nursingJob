<?php 
	
	include('../class/connect.php');
	include('../class/class.php');

	if(isset($_SESSION['user'])){
		echo '1';
	}else{
		echo '0';
	}


?>