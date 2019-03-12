<?php
	
	include('../class/connect.php');


?>

<div style="height: 60px;" >
			<div class="container-fluid fixed-top" style="height: 60px;  background-color:#1A2980">
				<div class="container-fluid">
					<a href="home.html"><img id="image_logo" src="images/logo.png" style="width: 7%; padding-top: 15px;"></a>

					<span class="pull-right align-middle" id="big1" style="padding-top: 15px;">
						

						<a href="class/logout.php"><button  class="btn1">Logout</button></a>

					</span>

					<div class="pull-right" id="small1" style="display: none;">
						<a onclick="myFuntion()"><i style="color: white" class="fa fa-bars fa-2x"></i></a>
					</div>


						

				</div>
			</div>
		</div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		
		</button>

		<div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto navbar-right">
		  <li class="nav-item">
		    <a class="nav-link" href="home.html">Home</a>
		  </li>
		  <?php 

		  		if($_SESSION['category'] == '1'){

		  ?>
		  <li class="nav-item">
		    <a class="nav-link" href="view_nurse.html">Nurses</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="view_rec.html">Recruiters</a>
		  </li>

		  <?php 

		  		}

		  ?>

		  <li class="nav-item">
		    <a class="nav-link" href="chat.html">Chat</a>
		  </li>
		  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      Dropdown
		    </a>
		    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		      <a class="dropdown-item" href="#">Action</a>
		      <a class="dropdown-item" href="#">Another action</a>
		      <div class="dropdown-divider"></div>
		      <a class="dropdown-item" href="#">Something else here</a>
		    </div>
		  </li>
		</ul>
		</div>
		</nav>			
		<div id="side_menu">
		<div class="container-fluid bg-light" style="position: fixed; z-index: 101; height: 100%;">
			<ul class="list-unstyled" style="text-align: center; padding: 20px;">
				<li style="padding-top: 20px;"><a href="../index.html">Go Back</a></li>
				<li style="padding-top: 20px;"><a href="view_nurse.html"><i class="fa fa-user"></i> Nurses</a></li>
				<li style="padding-top: 20px;"><a href="view_rec.html"><i class="fa fa-user"></i> Recruiters</a></li>
				<li style="padding-top: 20px;"><a href="chat.html"><i class="fa fa-user"></i> Chat</a></li>
				<li style="padding-top: 20px;"><a href="class/logout.php"><i class="fa fa-user"></i> Logout</a></li>
				<li style="padding-top: 20px;"><a href="#">About us</a></li>
				<li style="padding-top: 20px;"><a href="#">Contact us</a></li>
				
			</ul>
		</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#side_menu").hide();

				$.ajax({
					url: "php/session_check.php",
					success:function(resp){
						if(resp == true){
							
						}else{
							window.location.href="index.html";
						}
					},
					error:function(resp){
						window.location.href="index.html";
					}
				});
			});



			function myFuntion(){
				$("#side_menu").toggle();
			}
		</script>