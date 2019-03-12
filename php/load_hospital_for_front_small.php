<?php 
	include('../class/connect.php');
?>
	<section class="featured-hospitals">
	


<?php 

	$core = Core::getInstance();


	$q = "SELECT a.*,b.*,c.*, sum(a.job_no) as job_no1 FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN hospital_det c ON a.h_id=c.h_id WHERE a.active='1' GROUP BY a.h_id limit 4";
	$stmt=$core->dbh->prepare($q);
	$stmt->execute();
	if($stmt->rowCount()>0){
		while($r = $stmt->fetchObject()){
?>	

<div class="hospital-card">
    <div class="top-image">
        <img src="<?php echo $r->dp; ?>">
    </div>
    <div class="hcard-text">
        <h4><?php echo $r->h_name; ?></h4>
        <h6><i class="fa fa-map-marker"></i> <?php echo $r->city; ?></h6>
    </div>
    <div class="row">
    	<div class="col-md-6" style=" padding-right: 0px;">
    		<button class="btn btn-info" type="button" data-toggle="modal" data-target="#hospital_display" style="border-radius: 0px; width: 100%" onclick="get_rec_det('<?php echo $r->h_id; ?>')">view profile</button>
    	</div>
    	<div class="col-md-6" style="padding-left: 0px;">
    		<button class="btn btn-default" style="border-radius: 0px; width: 100%" onclick="request_a_video_call('<?php echo $r->h_id; ?>')"><small><i class="fa fa-video-camera"></i> Request a call</small></button>
    	</div>
    </div>
    
</div>

<?php 

		}
		
	}

?>


</section>




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