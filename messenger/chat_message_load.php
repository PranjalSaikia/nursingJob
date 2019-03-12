<?php
	
	include('../class/connect.php');

	$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);


	$core = Core::getInstance();


	$q1 = "SELECT * FROM chat WHERE ip=:ip ORDER BY time_stamp ASC";
	$stmt=$core->dbh->prepare($q1);
	$stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount() >0){
		while($r = $stmt->fetchObject()){
?>


<?php if($r->user == '2'){ ?>
<div id="tag_user">
	<?php echo $r->message; ?> 
</div>
<?php }else{ ?>
<div id="tag_admin">
	<?php echo $r->message; ?>
</div>
<?php } ?>



<?php 
		
		}
	
	}else{

?>

<?php 
	
	}

?>