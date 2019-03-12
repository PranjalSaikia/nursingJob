<?php 
	include('../class/connect.php');
?>
	
	<div class="row" id="owl1">


<?php 

	$core = Core::getInstance();


	$q = "SELECT a.*,b.*,c.*, sum(a.job_no) as job_no1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id WHERE a.active='1' GROUP BY a.job_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetchObject()){
?>	

<div class="col-md-3 py-3">
	<div class="card border-primary">
		<div class="card-body" align="left">
			<h5 class="card-title"><?php echo $r->h_name; ?></h5>
			<div class="card-text"><?php echo $r->city; ?>
			<p class="card-text">Vacancies: <b><?php echo $r->job_no; ?></b> nos</p>
			<p class="card-text">Experience: <b><?php echo $r->min_exp; ?></b> years</p>
			</div>
		</div>
	</div>
</div> 

<?php 

		}
		
	}

?>

</div>




<script type="text/javascript">
	$(document).ready(function(){

		//$("#s1").load('php/load_hospital_for_front.php');

		$('.owl-carousel').owlCarousel({
		    loop:true,
		    margin:10,
		    responsiveClass:true,
		    responsive:{
		        0:{
		            items:1,
		            nav:true
		        },
		        600:{
		            items:2,
		            nav:false
		        },
		        1000:{
		            items:3,
		            nav:true,
		            loop:false
		        }
		    }
		})
	});
</script>