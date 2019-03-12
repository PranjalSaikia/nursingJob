<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

?>
<datalist id="list2">
<?php
	$q = "SELECT * FROM job_post_h GROUP BY job_location";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r=$stmt->fetchObject()){
?>
<option value="<?php echo $r->job_location; ?>"><?php echo $r->job_location; ?></option>
<?php 
		
		}
	}

?></datalist>
