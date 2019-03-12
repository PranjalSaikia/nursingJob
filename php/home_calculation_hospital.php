<?php 
	

	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$q = "SELECT * FROM hospital_master WHERE access_token=:token";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':token',$token,PDO::PARAM_STR);
	$stmt->execute();
	$r = $stmt->fetchObject();

	$h_id = $r->h_id;

    $q2 = "SELECT sum(job_no) as job_no2 FROM job_post_h WHERE h_id=:h_id AND active='1'";
    $stmt2=$core->dbh->prepare($q2);
    $stmt2->bindParam(':h_id',$h_id,PDO::PARAM_INT);
    $stmt2->execute();
    $r2 = $stmt2->fetchObject();




?>

				
                                	<?php 

                                		$e = 1;
                                		$q1 = "SELECT a.*,b.*,sum(a.job_no) as job_no1 FROM job_post_h a INNER JOIN nurse_category b ON a.job_cat=b.cat_id WHERE a.active='1' AND a.h_id=:h_id GROUP BY a.job_cat";
                                		$stmt1=$core->dbh->prepare($q1);
                                		$stmt1->bindParam(':h_id',$h_id,PDO::PARAM_INT);
                                		$stmt1->execute();
                                		if($stmt1->rowCount()>0){
                                			while($r1 = $stmt1->fetchObject()){

                                	?>
                                    <div class="col-md-2" style="padding-bottom: 10px;">
                                    <div class="card">
                                        <h4 class="card-title" id="card_title_1"><?php echo $r1->cat_name; ?></h4>
                                        <div class="card-body" align="center">
                                            <p><?php echo $r1->job_no1; ?></p> Vacancies
                                        </div>
                                    </div>
                                    </div>
                                    <?php 

                                    		}
                                    	}


                                    ?>
                                