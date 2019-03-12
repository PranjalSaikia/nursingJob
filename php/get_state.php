<?php 
		

		$pin = addslashes(strip_tags(trim($_POST['pin'])));


		
		$ch = fopen('pincode.csv','r');
		$header_row = fgetcsv($ch);
		$row = array();
		while($row = fgetcsv($ch)){
			if(in_array($pin, $row)){
				echo $row[4]."*".$row[9]."*".$row[8];
			}
		}



?>