<?php 
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');

	$core = Core::getInstance();


	?>

	<div class="row">

	<?php

	$q = "SELECT a.*,b.* FROM hospital_master a INNER JOIN hospital_det b ON a.h_id=b.h_id WHERE a.active_flag='0'";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r=$stmt->fetchObject()){




?>


								<div class="col-md-3 py-3">
                				
                                    <div class="card" style="height: 400px">

                						<img class="card-img-top" src="<?php echo $r->dp; ?>"" alt="Image">
        						  
	        						  <div class="card-body" align="left">
	        						    <h5 class="card-title"><?php echo $r->h_name; ?></h5>
	        						    <p class="card-text"><?php echo $r->h_des_short; ?></p>
	        						  </div>
	        						</div>
        						</div>


                            
            			


            			<?php 

            					}

            				}

            			?>


            		</div>