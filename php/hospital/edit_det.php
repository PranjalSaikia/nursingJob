<?php 

	include('../../class/connect.php');
	include('../../class/sessioncheck_h.php');
	include('../../class/class.php');

	$core = Core::getInstance();

	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));
	$h_des_short = addslashes(strip_tags(trim($_POST['h_des_short'])));
	$h_des_long = addslashes(strip_tags(trim($_POST['h_des_long'])));
	$region = addslashes(strip_tags(trim($_POST['region'])));
	$city = addslashes(strip_tags(trim($_POST['city'])));
	$state = addslashes(strip_tags(trim($_POST['state'])));
	$pin = addslashes(strip_tags(trim($_POST['pin'])));

	echo $h_id;
	//check token

	$q = "SELECT * FROM hospital_master WHERE h_id=:h_id AND access_token=:token";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->bindParam(':h_id',$h_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount() > 0){


		// check for already exists table values
		$q1 = "SELECT * FROM hospital_det WHERE h_id=:h_id";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':h_id',$h_id,PDO::PARAM_INT);
		$stmt1->execute();
		if($stmt1->rowCount()>0){
			//update
			$q2 = "UPDATE hospital_det SET h_des_short=:hs, h_des_long=:hl, region=:region, city=:city, state=:state, pin=:pin WHERE h_id=:h_id";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':hs',$h_des_short,PDO::PARAM_STR);
			$stmt2->bindParam(':hl',$h_des_long,PDO::PARAM_STR);
			$stmt2->bindParam(':region',$region,PDO::PARAM_STR);
			$stmt2->bindParam(':city',$city,PDO::PARAM_STR);
			$stmt2->bindParam(':state',$state,PDO::PARAM_STR);
			$stmt2->bindParam(':pin',$pin,PDO::PARAM_STR);
			$stmt2->bindParam(':h_id',$h_id,PDO::PARAM_INT);
			$stmt2->execute();
		}else{
			//insert..

			$q2 = "INSERT INTO hospital_det(h_id,h_des_short,h_des_long,region,city,state,pin,dp) VALUES(:h_id,:hs,:hl,:region,:city,:state,:pin,'')";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':hs',$h_des_short,PDO::PARAM_STR);
			$stmt2->bindParam(':hl',$h_des_long,PDO::PARAM_STR);
			$stmt2->bindParam(':region',$region,PDO::PARAM_STR);
			$stmt2->bindParam(':city',$city,PDO::PARAM_STR);
			$stmt2->bindParam(':state',$state,PDO::PARAM_STR);
			$stmt2->bindParam(':pin',$pin,PDO::PARAM_STR);
			$stmt2->bindParam(':h_id',$h_id,PDO::PARAM_INT);
			$stmt2->execute();
		}


		//image upload

		if($_FILES['dp']['name'] != ""){
			$dir_r = "../../uploads/hospital/";
			$temp_dp= "";
			$n = new master;
			$temp_dp = $n->file_upload($dir_r,'dp',$h_id);
			$temp_dp = substr($temp_dp, 6);

			$q21 = "UPDATE hospital_det SET dp=:dp WHERE h_id=:h_id";
			$stmt21=$core->dbh->prepare($q21);
			$stmt21->bindParam(':dp',$temp_dp,PDO::PARAM_STR);
			$stmt21->bindParam(':h_id',$h_id,PDO::PARAM_INT);
			$stmt21->execute();

		}

	}

?>