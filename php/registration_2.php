<?php

	include('../class/connect.php');
	include('../class/class.php');
	if(isset($_SESSION['name']) && isset($_SESSION['username']) && isset($_SESSION['phn'])){
?>
	<input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>">
<?php 
	}else{
		header('Location: registration.html');
	}
?>

