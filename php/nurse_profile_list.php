<?php 

	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

    $a = array();
    $p = array();

    $i=0;
    $q = "SELECT a.*,b.* FROM nurse_master a INNER JOIN nurse_det b ON a.n_id=b.n_id WHERE a.active_flag='0'";
    $stmt=$core->dbh->prepare($q);
    $stmt->execute();
    if($stmt->rowCount()){
        while($r = $stmt->fetch(PDO::FETCH_ASSOC)){

            

            $q1 = "SELECT sum(job_exp) as job_exp1 FROM job_exp_profile WHERE n_id=:n_id";
            $stmt1=$core->dbh->prepare($q1);
            $stmt1->bindParam(':n_id',$r['n_id'],PDO::PARAM_INT);
            $stmt1->execute();
            $r1 = $stmt1->fetch(PDO::FETCH_ASSOC);


            $q2 = "SELECT * FROM interested WHERE n_id=:n_id AND h_id=:h_id";
            $stmt2=$core->dbh->prepare($q2);
            $stmt2->bindParam(':n_id',$r['n_id'],PDO::PARAM_INT);
            $stmt2->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
            $stmt2->execute();
            if($stmt2->rowCount() >0){
                while($r2 = $stmt2->fetchObject()){
                    if($r2->seen == '0'){
                        $count = 1;
                    }else if($r2->seen == '1'){
                        $count = 2;
                    }
                }
                
            }else{
                $count = 0;
            }
        

            
            $a[] = $r;
            $a[$i]['job_exp'] = $r1['job_exp1'];
            $a[$i]['interest'] = $count;



            $i++;
        }

        echo json_encode($a);
    }


?>


