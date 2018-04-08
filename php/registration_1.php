<?php

	include('../class/connect.php');
	include('../class/class.php');
	if(isset($_SESSION['name']) && isset($_SESSION['username'])){
?>
	<input type="hidden" name="name" id="name" value="<?php echo $_SESSION['name']; ?>">
	<input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>">
<?php 
	}else{
		header('Location: index.html');
	}
?>

