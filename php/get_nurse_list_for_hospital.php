<?php 

	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

    $e=1; $a = array(); $p = array();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $m = $request->m;
    $n = $request->n;
    $o = $request->o;

	$e=1;
    if($n == 0 && $o == 0){
	   $q = "SELECT a.*,b.* FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id WHERE a.active_flag='0'";
    }else if($n == 1 && $o == 0){
        $q = "SELECT a.*,b.* FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id WHERE a.active_flag='0' ORDER BY b.city";
    }else if($n == 0 && $o == 1){
        $q = "SELECT a.*,b.*,c.*, sum(c.job_exp) as job_exp1 FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id INNER JOIN job_exp_profile c ON a.n_id=c.n_id WHERE a.active_flag='0' ORDER BY c.job_exp";
    }else if($n == 1 && $o == 1){
        $q = "SELECT a.*,b.*,c.*, sum(c.job_exp) as job_exp1 FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id INNER JOIN job_exp_profile c ON a.n_id=c.n_id WHERE a.active_flag='0' ORDER BY c.job_exp AND b.city";
    }   
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetchObject()){

            $q2 = "SELECT sum(job_exp) as job_exp1 FROM  job_exp_profile WHERE n_id=:n_id";
            $stmt2=$core->dbh->prepare($q2);
            $stmt2->bindParam(':n_id',$r->n_id,PDO::PARAM_INT);
            $stmt2->execute();
            if($stmt2->rowCount()>0){
                $r2 = $stmt2->fetchObject();
                $job_exp = $r2->job_exp1;
            }else{
                $job_exp = "Not Updated";
            }



            //interested

            $q1 = "SELECT * FROM interested WHERE n_id=:n_id AND h_id=:h_id";
            $stmt1=$core->dbh->prepare($q1);
            $stmt1->bindParam(':n_id',$r->n_id,PDO::PARAM_STR);
            $stmt1->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
            $stmt1->execute();
            if($stmt1->rowCount()>0){
                $a["interest"] = 1;
            }else{
                $a["interest"] = 0;
            }

            $a["count"] = $e; 
            $a["city"] = $r->city;
            $a["exp"] = $job_exp;
            $a["n_id"] = $r->n_id;
            $a["m"] = $m;
            $a["n1"] = $n;
            $a["o"] = $o;
	       
            array_push($p, $a);
			$e++;
			}

		}


        echo json_encode($p);


?>


