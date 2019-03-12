<?php 

	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

    $a = array();
    $p = array();

    $i=0;
    $q = "SELECT a.*,c.*,c.time_stamp as time_stamp1,b.* FROM nurse_master a INNER JOIN skype_req c ON a.n_id=c.n_id INNER JOIN nurse_det b ON a.n_id=b.n_id WHERE a.active_flag='0' AND c.direction='0' AND c.h_id=:h_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()){
        while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $a[] = $r;
            
        }

        echo json_encode($a);
    }


?>


