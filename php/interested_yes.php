<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));
	$e = addslashes(strip_tags(trim($_POST['e'])));

	$q = "SELECT * FROM interested WHERE h_id=:h_id AND n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount()==0){
		$q1 = "INSERT INTO interested(h_id,n_id,seen) VALUES(:h_id,:n_id,'0')";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
		$stmt1->bindParam(':n_id',$n_id,PDO::PARAM_INT);
		$stmt1->execute();
	}


?>

							<?php 

                					$q1 = "SELECT * FROM interested WHERE n_id=:n_id AND h_id=:h_id";
                					$stmt1=$core->dbh->prepare($q1);
                					$stmt1->bindParam(':n_id',$n_id,PDO::PARAM_STR);
                					$stmt1->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
                					$stmt1->execute();
                					if($stmt1->rowCount()>0){
                				?>
                				<i class="fa fa-check" style="color: green;cursor: pointer;" onclick="interested_no('<?php echo $n_id; ?>','<?php echo $e; ?>')"> Show Interest</i>
                				<?php 

                					}else{

                				?>
                					<i style="cursor: pointer;" class="fa fa-check" onclick="interested('<?php echo $n_id; ?>','<?php echo $e; ?>')"> Show Interest</i>
                				<?php

                					}

                				?>