<?php 
    
    include('../class/connect.php');

    $core = Core::getInstance();

    $q = "SELECT a.*,b.* FROM hospital_master a INNER JOIN hospital_det b ON a.h_id=b.h_id WHERE a.h_id=:h_id ";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
    $stmt->execute();
    $r = $stmt->fetchObject();

?>


<h3><img src="images/logo.png" width="80px"></h3>
    
    <ul class="list-unstyled" id="top_nav">
        
        <li>

            <div class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" id="nav_button"><span id="pro_image"><img src="<?php echo $r->dp; ?>"></span>
               <?php echo $r->h_name; ?>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="edit_profile_hospital.html"><tag class="fa fa-pencil"></tag> Edit Profile</a>
                <a class="dropdown-item" href="class/logout_h.php"><tag class="fa fa-sign-out"></tag> Logout</a>


              </div>
            </div>

       </li>
    </ul>

    <span id="mobile_bars_n"><a onclick="myf_1()"><i class="fa fa-bars fa-2x"></i></a></span>


     <script>
     		
     		function myf_1(){
     			$('.side-nav').css({
     				left: '0px',
     			});

     			$('#mobile_bars_n').html('<a onclick="myf_2()"><i class="fa fa-close fa-2x"></i></a>');
     		}


     		function myf_2(){
     			$('.side-nav').css({
     				left: '-400px',
     			});

     			$('#mobile_bars_n').html('<a onclick="myf_1()"><i class="fa fa-bars fa-2x"></i></a>');
     		}

     </script>