<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$n_id = addslashes(strip_tags(trim($_POST['n_id'])));
	$n_des_short = addslashes(strip_tags(trim($_POST['n_des'])));
	$district = addslashes(strip_tags(trim($_POST['district'])));
	$city = addslashes(strip_tags(trim($_POST['city'])));
	$state = addslashes(strip_tags(trim($_POST['state'])));
	$pin = addslashes(strip_tags(trim($_POST['pin'])));
	$link = addslashes(strip_tags(trim($_POST['link'])));
	$exp = addslashes(strip_tags(trim($_POST['exp'])));



	
	//check token

	$q = "SELECT * FROM nurse_master WHERE n_id=:n_id AND access_token=:token";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->bindParam(':n_id',$n_id,PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount() > 0){




		// check for already exists table values
		$q1 = "SELECT * FROM nurse_det WHERE n_id=:n_id";
		$stmt1=$core->dbh->prepare($q1);
		$stmt1->bindParam(':n_id',$n_id,PDO::PARAM_INT);
		$stmt1->execute();
		if($stmt1->rowCount()>0){

			//update
			$q2 = "UPDATE nurse_det SET n_des=:hs, district=:district, city=:city, state=:state, pin=:pin, slink=:link, exp=:exp WHERE n_id=:n_id";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':hs',$n_des_short,PDO::PARAM_STR);
			$stmt2->bindParam(':district',$district,PDO::PARAM_STR);
			$stmt2->bindParam(':city',$city,PDO::PARAM_STR);
			$stmt2->bindParam(':state',$state,PDO::PARAM_STR);
			$stmt2->bindParam(':pin',$pin,PDO::PARAM_STR);
			$stmt2->bindParam(':n_id',$n_id,PDO::PARAM_INT);
			$stmt2->bindParam(':exp',$exp,PDO::PARAM_STR);
			$stmt2->bindParam(':link',$link,PDO::PARAM_STR);
			$stmt2->execute();
		}else{
			//insert..


			

			$q2 = "INSERT INTO nurse_det(n_id,n_des,district,city,state,pin,exp,resume,slicense,dp,slink) VALUES(:n_id,:hs,:district,:city,:state,:pin,:exp,'','','',:link)";
			$stmt2=$core->dbh->prepare($q2);
			$stmt2->bindParam(':hs',$n_des_short,PDO::PARAM_STR);
			$stmt2->bindParam(':district',$district,PDO::PARAM_STR);
			$stmt2->bindParam(':city',$city,PDO::PARAM_STR);
			$stmt2->bindParam(':state',$state,PDO::PARAM_STR);
			$stmt2->bindParam(':pin',$pin,PDO::PARAM_STR);
			$stmt2->bindParam(':n_id',$n_id,PDO::PARAM_INT);
			$stmt2->bindParam(':exp',$exp,PDO::PARAM_STR);
			$stmt2->bindParam(':link',$link,PDO::PARAM_STR);
			$stmt2->execute();



		}

		echo $n_id;


		//image upload

		if($_FILES['dp']['name'] != ""){

			$dir_r = "../uploads/nurse/";
			$temp_dp= "";
			$n = new master;
			$temp_dp = $n->file_upload($dir_r,'dp',$n_id);
			$temp_dp = substr($temp_dp, 3);

			$q21 = "UPDATE nurse_det SET dp=:dp WHERE n_id=:n_id";
			$stmt21=$core->dbh->prepare($q21);
			$stmt21->bindParam(':dp',$temp_dp,PDO::PARAM_STR);
			$stmt21->bindParam(':n_id',$n_id,PDO::PARAM_INT);
			$stmt21->execute();

		}



		if($_FILES['resume']['name'] != ""){

			$dir_r = "../uploads/Resume/";
			$temp_dp= "";
			$n = new master;
			$temp_dp = $n->file_upload($dir_r,'resume',$n_id);
			$temp_dp = substr($temp_dp, 3);

			$q21 = "UPDATE nurse_det SET resume=:resume WHERE n_id=:n_id";
			$stmt21=$core->dbh->prepare($q21);
			$stmt21->bindParam(':resume',$temp_dp,PDO::PARAM_STR);
			$stmt21->bindParam(':n_id',$n_id,PDO::PARAM_INT);
			$stmt21->execute();

		}


		if($_FILES['license']['name'] != ""){

			$dir_r = "../uploads/License/";
			$temp_dp= "";
			$n = new master;
			$temp_dp = $n->file_upload($dir_r,'license',$n_id);
			$temp_dp = substr($temp_dp, 3);

			$q21 = "UPDATE nurse_det SET slicense=:license WHERE n_id=:n_id";
			$stmt21=$core->dbh->prepare($q21);
			$stmt21->bindParam(':license',$temp_dp,PDO::PARAM_STR);
			$stmt21->bindParam(':n_id',$n_id,PDO::PARAM_INT);
			$stmt21->execute();

			if($stmt21 == true){

			}

		}

	}

?>