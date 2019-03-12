<?php 

	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$job_title = addslashes(strip_tags(trim($_POST['job_title'])));
	$job_org = addslashes(strip_tags(trim($_POST['job_org'])));
	$period1 = addslashes(strip_tags(trim($_POST['period1'])));
	$period2 = addslashes(strip_tags(trim($_POST['period2'])));
	if(isset($_POST['current'])){
		$current = 1;
	}else{
		$current = 0;
	}
	

	$period = $period1. " - " .$period2;
	$job_exp = addslashes(strip_tags(trim($_POST['job_exp'])));
	$job_det = addslashes(strip_tags(trim($_POST['job_det'])));
	$n = $_SESSION['n_id'];

	$q = "INSERT INTO job_exp_profile(n_id,job_title,job_org,period,current,job_exp,job_det) VALUES(:n_id,:job_title,:job_org,:period,:current,:job_exp,:job_det)";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$n,PDO::PARAM_INT);
	$stmt->bindParam(':job_title',$job_title,PDO::PARAM_STR);
	$stmt->bindParam(':job_org',$job_org,PDO::PARAM_STR);
	$stmt->bindParam(':period',$period,PDO::PARAM_STR);
	$stmt->bindParam(':current',$current,PDO::PARAM_STR);
	$stmt->bindParam(':job_exp',$job_exp,PDO::PARAM_STR);
	$stmt->bindParam(':job_det',$job_det,PDO::PARAM_STR);
	$stmt->execute();


?>

<table class="table table-bordered">
	<thead>
		<tr>
			<td width="5%">#</td>
			<td>Job Title / Designation</td>
			<td>Organisation</td>
			<td>Period</td>
			<td>Total Exp</td>
			<td width="40%">Description</td>
			<td width="5%"></td>
		</tr>
	</thead>
	<tbody>
		<?php 
				$e=1;
				$q1 = "SELECT * FROM job_exp_profile WHERE n_id=:n_id";
				$stmt1=$core->dbh->prepare($q1);
				$stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
				$stmt1->execute();
				if($stmt1->rowCount()>0){

					while($r1 = $stmt1->fetchObject()){

		?>
		<tr <?php if($r1->current == 1){ ?>class="text-success" <?php } ?>>
			<td><?php echo $e;$e++; ?></td>
			<td><?php echo $r1->job_title; ?></td>
			<td><?php echo $r1->job_org; ?></td>
			<td><?php echo $r1->period; ?></td>
			<td><?php echo $r1->job_exp; ?></td>
			<td><?php echo $r1->job_det; ?></td>
			<td><a onclick="delete_exp('<?php echo $r1->id; ?>')"><i class="fa fa-trash"></i></a></td>
			
		</tr>

		<?php 

				}
			}

		?>
	</tbody>
</table>