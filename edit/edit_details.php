<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();
	
		$n_name = addslashes(strip_tags(trim($_POST['n_name'])));
		$n_des = $_POST['ed'];
		$city = addslashes(strip_tags(trim($_POST['city'])));
		$district = addslashes(strip_tags(trim($_POST['district'])));
		$state = addslashes(strip_tags(trim($_POST['state'])));
		$pin = addslashes(strip_tags(trim($_POST['pin'])));
		$slink = addslashes(strip_tags(trim($_POST['slink'])));


		$q2 = "SELECT * FROM nurse_det WHERE n_id=:n_id";
		$stmt2=$core->dbh->prepare($q2);
		$stmt2->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
		$stmt2->execute();
		if($stmt2->rowCount()>0){


				$q = "UPDATE nurse_det SET district=:district, city=:city, state=:state, pin=:pin, slink=:slink WHERE n_id=:n_id";
				$stmt=$core->dbh->prepare($q);
				$stmt->bindParam(':district',$district,PDO::PARAM_STR);
				$stmt->bindParam(':city',$city,PDO::PARAM_STR);
				$stmt->bindParam(':state',$state,PDO::PARAM_STR);
				$stmt->bindParam(':pin',$pin,PDO::PARAM_STR);
				$stmt->bindParam(':slink',$slink,PDO::PARAM_STR);
				$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
				$stmt->execute();

				if($n_des != ""){
					$q = "UPDATE nurse_det SET n_des=:n_des WHERE n_id=:n_id";
					$stmt=$core->dbh->prepare($q);
					$stmt->bindParam(':n_des',$n_des,PDO::PARAM_STR);
					$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
					$stmt->execute();
				}

				$q1 = "UPDATE nurse_master SET n_name=:n_name WHERE n_id=:n_id";
				$stmt1=$core->dbh->prepare($q1);
				$stmt1->bindParam(':n_name',$n_name,PDO::PARAM_STR);
				$stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
				$stmt1->execute();

		}else{


			$q = "INSERT INTO nurse_det (n_id,n_des,district,city,state,pin,slink) VALUES(:n_id,:n_des,:district,:city,:state,:pin,:slink)";
			$stmt=$core->dbh->prepare($q);
			$stmt->bindParam(':n_des',$n_des,PDO::PARAM_STR);
			$stmt->bindParam(':district',$district,PDO::PARAM_STR);
			$stmt->bindParam(':city',$city,PDO::PARAM_STR);
			$stmt->bindParam(':state',$state,PDO::PARAM_STR);
			$stmt->bindParam(':pin',$pin,PDO::PARAM_STR);
			$stmt->bindParam(':slink',$slink,PDO::PARAM_STR);
			$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
			$stmt->execute();

		}
		

		echo true;



?>