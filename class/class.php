<?php 
	

	/**
	* Master class
	*/
 
	class master
	{
		function send_sms($i,$username,$r){

		$APIKey = "TX9ZtRPkK0WqeyFj9zwBvg";
		$senderid = "JobForSure";
		$number=$i;
		$text=rawurlencode("Dear ".$username.", Your OTP for mobile number verification is: ".$r);
		$url = "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=".$APIKey."&senderid=".$senderid."&channel=2&DCS=0&flashsms=0&number=".$number."&text=".$text."&route=1";

		//echo $url;
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,"");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
		$data = curl_exec($ch);
		//echo '<br/> <br/>';
		return $data; /* result of API call*/
		}

		function check_duplicate($username){
			$core = Core::getInstance();
			$q = "SELECT * FROM nurse WHERE username=:username";
			$stmt=$core->dbh->prepare($q);
			$stmt->bindParam(':username',$username,PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount() == 0){
				return true;
			}else{
				return false;
			}
		}



		function random_string($length) {
		    $key = '';
		    $keys = array_merge(range(0, 9), range('a', 'z'));

		    for ($i = 0; $i < $length; $i++) {
		        $key .= $keys[array_rand($keys)];
		    }

		    return $key;
		}


		function file_upload($dir, $fileName, $id){



			$temp = explode(".", $_FILES[$fileName]["name"]);
			$temp=str_replace("..",".",$temp);
            $newfilename = 'jobforsure-'.$this->random_string(20).'.'.end($temp);

			$target_dir = $dir;
			$target_file = $target_dir . basename($_FILES[$fileName]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image

			    /*$check = getimagesize($_FILES[$fileName]["tmp_name"]);
			    if($check !== false) {
			      
			        $uploadOk = 1;
			    } else {
			       
			        $uploadOk = 0;
			    }*/
			// Check if file already exists
			if (file_exists($target_file)) {
			    //echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES[$fileName]["size"] > 500000000) {
			    //echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    //echo "Sorry, your file was not uploaded.";
			    echo "sorry";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_dir . $newfilename)) {
			        //echo "The file ". basename( $_FILES[$fileName]["name"]). " has been uploaded.";

			        return $target_dir.$newfilename;

			    } else {
			        //echo "Sorry, there was an error uploading your file.";

			        return $uploadok;
			    }
			}

		}







		function check_apply_status($m){


			$core = Core::getInstance();
			$q = "SELECT * FROM job_apply WHERE job_id=:job_id AND n_id=:n_id";
			$stmt=$core->dbh->prepare($q);
			$stmt->bindParam(':job_id',$m,PDO::PARAM_STR);
			$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$r = $stmt->fetchObject();
				return $r->status;
			}else{
				return 'no';
			}


		}




	}



?>