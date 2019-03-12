<?php 
	include('../class/connect.php');
?>

<div class="row">
<?php 

	$core = Core::getInstance();


	$q = "SELECT a.*,b.* FROM hospital_master a INNER JOIN hospital_det b ON a.h_id=b.h_id LIMIT 12";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetchObject()){
?>	
				<div class="col-md-2 col-sm-6 col-xs-6 col-lg-2 py-1" >
				<div class="card border-info" style="height: 200px;">
				  <img class="card-img-top" src="<?php echo $r->dp; ?>" style="height: 70%" >
				  <div class="card-body">
				    <h6><?php echo $r->h_name; ?></h6>
				  </div>
				</div> 
				</div>





<?php 

		}
		
	}

?>
</div>
