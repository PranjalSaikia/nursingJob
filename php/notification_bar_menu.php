<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$q = "SELECT a.*,b.*,c.* FROM interested a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id WHERE a.n_id=:n_id ORDER BY a.id DESC LIMIT 10";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()>0){

		while($r = $stmt->fetchObject()){


?>




<a class="dropdown-item" onclick="change_status('<?php echo $r->id; ?>')" <?php if($r->seen != '0'){ echo 'style="opacity: 0.5"'; } ?>><span><img src="<?php echo $r->dp; ?>" style="width: 40px; height: 40px;"></span> <?php echo $r->h_name; ?> has shown interest in you.</a>




<?php 
		}
	}else{

?>

<a class="dropdown-item disabled" href="#">No new notifications</a>

<?php 
	
	}

?>