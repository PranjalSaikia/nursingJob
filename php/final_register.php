<?php 

	include('../class/connect.php');
	include('../class/class.php');

		$core = Core::getInstance();

		$phn = addslashes(strip_tags(trim($_POST['phn'])));
		$address = addslashes(strip_tags(trim($_POST['address'])));
		$exp_1 = addslashes(strip_tags(trim($_POST['exp_1'])));
		$exp_2 = addslashes(strip_tags(trim($_POST['exp_2'])));

		$q3 = "SELECT * FROM nurse WHERE nurse_name=:name AND username=:username";
		$stmt3=$core->dbh->prepare($q3);
		$stmt3->bindParam(':name',$_SESSION['name'],PDO::PARAM_STR);
		$stmt3->bindParam(':username',$_SESSION['username'],PDO::PARAM_STR);
		$stmt3->execute();
		if($stmt3->rowCount() == 0){

				$q = "INSERT INTO nurse(nurse_name,username,password,address,phno,license_no,exp_1,exp_2,image_resume,image_license) VALUES(:nurse_name,:username,'',:address,:phno,'',:exp_1,:exp_2,'','')";
				$stmt=$core->dbh->prepare($q);
				$stmt->bindParam(':nurse_name',$_SESSION['name'],PDO::PARAM_STR);
				$stmt->bindParam(':username',$_SESSION['username'],PDO::PARAM_STR);
				$stmt->bindParam(':address',$address,PDO::PARAM_STR);
				$stmt->bindParam(':exp_1',$exp_1,PDO::PARAM_STR);
				$stmt->bindParam(':exp_2',$exp_2,PDO::PARAM_STR);
				$stmt->bindParam(':phno',$phn,PDO::PARAM_STR);
				$stmt->execute();

				$q1 = "SELECT max(nurse_id) as nurse_id FROM nurse";
				$stmt1=$core->dbh->prepare($q1);
				$stmt1->execute();
				$r1 = $stmt1->fetchObject();
				$id = $r1->nurse_id;

				//file upload: Resume

				$fileName_r = "fileUpload1";
				$fileName_l = "fileUpload2";
				$dir_r = "../uploads/Resume/";
				$dir_l = "../uploads/License/";

				$n = new master;


				$temp_resume = $n->file_upload($dir_r,$fileName_r,$id);
				$temp_license = $n->file_upload($dir_l,$fileName_l,$id);

				$q2 = "UPDATE nurse SET image_resume=:image_resume, image_license=:image_license WHERE nurse_id=:id";
				$stmt2=$core->dbh->prepare($q2);
				$stmt2->bindParam(':image_resume',$temp_resume,PDO::PARAM_STR);
				$stmt2->bindParam(':image_license',$temp_license,PDO::PARAM_STR);
				$stmt2->bindParam(':id',$id,PDO::PARAM_INT);
				$stmt2->execute();

				if($stmt2 == true){

						$_SESSION['phn'] = $phn;
					
					}

		}else{



		}






?>