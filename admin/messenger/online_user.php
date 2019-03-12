<?php
	
	include('../class/connect.php');

	$core = Core::getInstance();

	$q = "SELECT DISTINCT ip FROM chat WHERE user='2' ORDER BY time_stamp DESC";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){


?>

		<ul class="list-unstyled" id="list1">
			<?php 	
					$e = 1;
					while($r = $stmt->fetchObject()){

			?>
			<li id="e_<?php echo $e; ?>"><a style="cursor: pointer" onclick="load_msg('<?php echo $r->ip; ?>');make_active('<?php echo $e; $e++; ?>')"><?php echo $r->ip; ?> <span>active status</span></a></li>
			<?php 

					}

			?>
		</ul>



<?php 

		}

?>