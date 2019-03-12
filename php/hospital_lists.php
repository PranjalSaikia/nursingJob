<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

?>
<datalist id="list3">
<?php
	$q = "SELECT a.*,b.* FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id GROUP BY a.h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r=$stmt->fetchObject()){
?>
<option value="<?php echo $r->h_id; ?>"><?php echo $r->h_name; ?></option>
<?php 
		
		}
	}

?></datalist>
