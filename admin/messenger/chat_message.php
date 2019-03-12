<?php
	
	include('../class/connect.php');

	$msg = addslashes(strip_tags(trim($_POST['message'])));
	$ip = addslashes(strip_tags(trim($_POST['ip'])));

	$core = Core::getInstance();

	if($ip != ""){
		$q = "INSERT INTO chat(user,ip,message) VALUES('1',:ip,:message)";
		$stmt=$core->dbh->prepare($q);
		$stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
		$stmt->bindParam(':message',$msg,PDO::PARAM_STR);
		$stmt->execute();
	}else{
		echo "<p>Select user first</p>";
	}


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