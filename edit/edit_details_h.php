<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();
	
		$h_name = addslashes(strip_tags(trim($_POST['h_name'])));
		$h_des_short = $_POST['ed'];
		$h_des_long = $_POST['ed1'];
		$city = addslashes(strip_tags(trim($_POST['city'])));
		$district = addslashes(strip_tags(trim($_POST['district'])));
		$state = addslashes(strip_tags(trim($_POST['state'])));
		$pin = addslashes(strip_tags(trim($_POST['pin'])));


		$q2 = "SELECT * FROM hospital_det WHERE h_id=:h_id";
		$stmt2=$core->dbh->prepare($q2);
		$stmt2->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
		$stmt2->execute();
		if($stmt2->rowCount()>0){


				$q = "UPDATE hospital_det SET h_des_short=:h_des_short, h_des_long=:h_des_long, district=:district, city=:city, state=:state, pin=:pin WHERE h_id=:h_id";
				$stmt=$core->dbh->prepare($q);
				$stmt->bindParam(':h_des_short',$h_des_short,PDO::PARAM_STR);
				$stmt->bindParam(':h_des_long',$h_des_long,PDO::PARAM_STR);
				$stmt->bindParam(':district',$district,PDO::PARAM_STR);
				$stmt->bindParam(':city',$city,PDO::PARAM_STR);
				$stmt->bindParam(':state',$state,PDO::PARAM_STR);
				$stmt->bindParam(':pin',$pin,PDO::PARAM_STR);
				$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
				$stmt->execute();

				$q1 = "UPDATE hospital_master SET h_name=:h_name WHERE h_id=:h_id";
				$stmt1=$core->dbh->prepare($q1);
				$stmt1->bindParam(':h_name',$h_name,PDO::PARAM_STR);
				$stmt1->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
				$stmt1->execute();

		}else{


			$q = "INSERT INTO hospital_det (h_id,h_des_short,h_des_long,district,city,state,pin) VALUES(:h_id,:h_des_short,:h_des_long,:district,:city,:state,:pin)";
			$stmt=$core->dbh->prepare($q);
			$stmt->bindParam(':h_des_short',$h_des_short,PDO::PARAM_STR);
			$stmt->bindParam(':h_des_long',$h_des_long,PDO::PARAM_STR);
			$stmt->bindParam(':district',$district,PDO::PARAM_STR);
			$stmt->bindParam(':city',$city,PDO::PARAM_STR);
			$stmt->bindParam(':state',$state,PDO::PARAM_STR);
			$stmt->bindParam(':pin',$pin,PDO::PARAM_STR);
			$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
			$stmt->execute();

		}
		

		echo true;



?>