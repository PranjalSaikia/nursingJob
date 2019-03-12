<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

?>
<datalist id="list1">
<?php
	$q = "SELECT * FROM nurse_category";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r=$stmt->fetchObject()){
?>
<option value="<?php echo $r->cat_id; ?>"><?php echo $r->cat_des; ?></option>
<?php 
		
		}
	}

?></datalist>
