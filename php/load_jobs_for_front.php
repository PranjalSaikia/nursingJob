<?php 
	include('../class/connect.php');
?>
	
	<div class="owl-carousel">


<?php 

	$core = Core::getInstance();


	$q = "SELECT a.*,b.*,c.*,d.*,a.time_stamp as time_stamp1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id INNER JOIN nurse_category d ON a.job_cat=d.cat_id WHERE a.active='1' ORDER BY time_stamp1 DESC";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetchObject()){
?>	

<div>
	
				<div class="card border-primary" style="min-height: 240px;" >
					<div class="card-body" align="left">
						<h5 class="card-title"><?php echo $r->job_title; ?></h5>
						<small class="text-primary">By <?php echo $r->h_name; ?>, <?php echo $r->city; ?></small>
						<div class="card-text">
								Category: <small><b><?php echo $r->cat_des; ?></b></small><br>
								No of vacancies: <b><?php echo $r->job_no; ?></b> nos<br>
								Experience: <b><?php echo $r->min_exp; ?></b> years<br>
								Job Location: <b><?php echo $r->job_location; ?></b><br>
								<!-- Posted On: <b><?php echo date('d-m-Y',strtotime($r->time_stamp1)); ?></b><br> -->
						</div>
					</div>
					<div class="card-footer bg-white" align="right">
						<a href="nurse_login.html"><button type="button" class="btn btn-primary"><b>Login to apply</b></button></a>

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
		    autoplay:true,
		    autoplayTimeout:2000,
    		autoplayHoverPause:true,
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
		            items:4,
		            nav:true,
		            loop:false
		        }
		    }
		})
	});
</script>