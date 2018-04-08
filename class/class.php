<?php 
	

	/**
	* Master class
	*/

	
	class master
	{
		
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


		function file_upload($dir, $fileName, $id){

			$temp = explode(".", $_FILES[$fileName]["name"]);
            $newfilename = $id.'.'.end($temp);

			$target_dir = $dir;
			$target_file = $target_dir . basename($_FILES[$fileName]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image

			    $check = getimagesize($_FILES[$fileName]["tmp_name"]);
			    if($check !== false) {
			        //echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        //echo "File is not an image.";
			        $uploadOk = 0;
			    }
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
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    //echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_dir . $newfilename)) {
			        //echo "The file ". basename( $_FILES[$fileName]["name"]). " has been uploaded.";

			        return $target_dir.$newfilename;

			    } else {
			        //echo "Sorry, there was an error uploading your file.";
			    }
			}

		}

	}



?>