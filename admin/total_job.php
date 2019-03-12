<?php 

	
	include('class/connect.php');
	include('class/sessioncheck.php');


?>


<!DOCTYPE html>
<html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Job for sure</title>
	<link rel="icon" href="image/favicon.png">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
	<meta property="og:title" content="">
	<meta property="og:image" content="">
	<meta property="og:url" content="">
	<meta property="og:site_name" content="">
	<meta property="og:description" content="">

	<!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="">
	<meta name="twitter:title" content="">
	<meta name="twitter:description" content="">
	<meta name="twitter:image" content="">

	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="css/chat.css">

    <style type="text/css">
    	#mod{

		  /*background: #1A2980; 
		  background: -webkit-linear-gradient(45deg, #26D0CE, #1A2980);  
		  background: linear-gradient(45deg, #26D0CE, #1A2980); */

		  

		}

		.parallax{

			background-image: url('images/21.jpg');
			  background-size: 100%;
			  height: 610px;

		  	background-attachment: fixed;
		    background-position: center;
		    background-repeat: no-repeat;
		    background-size: cover;

		}


		@media only screen and (max-width: 600px) {
		 
		  #big1{
		    display: none;
		  }

		  #small1{
		    display: block !important;
		    padding-top: 15px;
		  }
		  
		 #image_logo{
		  	width: 25% !important;
		  }



		}

		.owl-carousel .owl-stage, .owl-carousel.owl-drag .owl-item{
    		-ms-touch-action: auto;
        	touch-action: auto;
		}

		.btn1{
			background: none;
			border: solid;
			border-width: 0.5px;
			border-color: white;
			padding: 5px;
			border-radius: 5px;
			width: 120px;
			color: white;

		}


		.btn2{
			background: none;
			border: solid;
			border-width: 0.5px;
			border-color: white;
			padding: 5px;
			border-radius: 5px;
			width: 170px;


		}

		.btn3{
			background: none;
			border: solid;
			border-width: 0.5px;
			border-color: white;
			padding: 5px;
			border-radius: 5px;
			color: white;
		}

		#box{
			color: #1A2980;
			text-align: center;
			background-color: white;
			padding: 20px;
			width: 200px;
			height: 200px;
		}

		footer{
			bottom: 0;
			position: fixed;
			width: 100%
		}

		
		


    </style>

</head>
<body>
	

		<div id="menu"></div>

		<ol class="breadcrumb">
		  <li class="breadcrumb-item active">Total Job Posted</li>
		</ol>

		<div id="mod">
	
	<div class="container-fluid">


		<table class="table table-bordered" width="100%" id="myTable">
			<thead>
				<tr>
					<td>#</td>
					<td>Posted by</td>
					<td>Posted on</td>
					<td>Category</td>
					<td>Title</td>
					<td>No of Vacancies</td>
					<td>Minimum Experience</td>
					<td>Min Salary</td>
					<td>Location</td>
					<td>Description</td>
					<td>Application received</td>
					<td>Application Shortlisted</td>
					<td>Application Accepted</td>
					<td>Application Rejected</td>
				</tr>
			</thead>
			<tbody>
				<?php 

					$core = Core::getInstance();
					$e = 1;
					$q = "SELECT a.*,b.*,c.* FROM job_post_h a INNER JOIN hospital_master b ON a.h_id=b.h_id INNER JOIN nurse_category c ON a.job_cat=c.cat_id";
					$stmt=$core->dbh->prepare($q);
					$stmt->execute();
					if($stmt->rowCount()>0){
						while($r = $stmt->fetchObject()){
				?>
				<tr>
					<td><?php echo $e; $e++; ?></td>
					<td><?php echo $r->h_name; ?></td>
					<td><?php echo $r->time_stamp; ?></td>
					<td><?php echo $r->cat_name; ?></td>
					<td><?php echo $r->job_title; ?></td>
					<td><?php echo $r->job_no; ?></td>
					<td><?php echo $r->min_exp; ?></td>
					<td><?php echo $r->min_sal; ?></td>
					<td><?php echo $r->job_location; ?></td>
					<td><?php echo $r->job_des; ?></td>

					<?php 

							$count_rec = 0; $count_sh=0; $count_ac = 0; $count_rej=0;
							$q1  = "SELECT * FROM job_apply WHERE job_id=:job_id";
							$stmt1=$core->dbh->prepare($q1);
							$stmt1->bindParam(':job_id',$r->job_id,PDO::PARAM_INT);
							$stmt1->execute();
							if($stmt1->rowCount()>0){
								while($r1 = $stmt1->fetchObject()){
									if($r1->status == 1){
										$count_sh++;
									}

									if($r1->status == 2){
										$count_ac++;
									}

									if($r1->status == 3){
										$count_rej++;
									}
								}
							}


					?>
					<td><?php echo $stmt1->rowCount(); ?></td>
					<td><?php echo $count_sh; ?></td>
					<td><?php echo $count_ac; ?></td>
					<td><?php echo $count_rej; ?></td>


					<?php 


					?>
					
				</tr>

				<?php 		

							}

						}

				?>
			</tbody>
		</table>


		
		

	</div>


	<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="s2">
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>




	<footer class="site-footer">
		<div class="container-fluid" style="background-color: #2f2f2f" align="center">
				<div class="text-white">All right reserved @ Jobforsure <br>&copy; 2018</div>
		</div>
	</footer>


	
	

</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/anime.min.js"></script>
<script src="js/wow.js"></script>
<script src="js/custom.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript">	
	$(document).ready(function(){
		
		$("#menu").load('php/menu.php');
		$("#view_nurse").load('php/view_nurse.php');

		$("#myTable").DataTable();
		
	});
	
	
	

	function change_status(m,n){

		$.ajax({
			url: "php/change_status_nurse.php",
			type: "POST",
			data:{
				"n_id" : m,
				"status" : n,
			},
			success:function(resp){
				$("#view_nurse").html(resp);
			},
			error:function(resp){
				alert(resp);
			}
		});

	}


	function verification(m,n,o){
		$.ajax({
			url: "php/get_ver.php",
			type: "POST",
			data:{
				"file_type" : o,
				"location" : m,
				"n_id": n
			},
			success:function(resp){
				$("#s2").html(resp);
			}
		});
	}


	function change_to_verified(m,n){
		$.ajax({
			url: "php/get_ver_status.php",
			type: "POST",
			data:{
				"file_type" : m,
				"n_id": n
			},
			success:function(resp){
				$("#s3").html(resp);
			}
		});
	}


	

</script>
</html>