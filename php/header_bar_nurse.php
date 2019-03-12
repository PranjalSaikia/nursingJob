<?php 
    
    include('../class/connect.php');

    $core = Core::getInstance();

    $q = "SELECT * FROM nurse_master  WHERE n_id=:n_id ";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()>0){
    $r = $stmt->fetchObject();


    $q121 = "SELECT * FROM nurse_det WHERE n_id=:n_id";
    $stmt121 = $core->dbh->prepare($q121);
    $stmt121->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
    $stmt121->execute();
    if($stmt121 ->rowCount()>0){
        $r121 = $stmt121->fetchObject();
        if($r121->dp != ""){
            $dp = $r121->dp;
        }else{
            $dp = 'images/default-dp.png';
        }
        
    }else{
        $dp = 'images/default-dp.png';
    }

?>

<h3><img src="images/logo.png" width="80px"></h3>
    
    <ul class="list-unstyled" id="top_nav">
        <li>

            <div class="dropdown" id="profile_tour_2">
              <a class="dropdown-toggle" data-toggle="dropdown" id="nav_button">
               <span id="nos" class="badge badge-danger">1</span> Notification
              </a>
              <div class="dropdown-menu" id="notification_bar_menu">
                
              </div>
            </div>

       </li>

       <li>

            <div class="dropdown" id="profile_tour_1">
              <a class="dropdown-toggle" data-toggle="dropdown" id="nav_button"><span id="pro_image"><img src="<?php echo $dp; ?>"></span>
               <?php echo $r->n_name; ?>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="edit_profile_nurse.html"><tag class="fa fa-pencil"></tag> Edit Profile</a>
                <a class="dropdown-item" href="class/logout_n.php"><tag class="fa fa-sign-out"></tag> Logout</a>


              </div>
            </div>

       </li>
    
    </ul>
     <span id="mobile_bars_n"><a onclick="myf_1()"><i class="fa fa-bars fa-2x"></i></a></span>


     <?php 

            }else{
                //echo '<script>window.location.href="edit_profile_nurse.html";</script>';
            }

     ?>

    
     <script>
        $(document).ready(function(){
            refresh_list_att();
            setInterval(function(){ refresh_list_att(); }, 15000);

        });


        function refresh_list_att(){
            $("#notification_bar_menu").load('php/notification_bar_menu.php');
            $("#nos").load('php/notification_bar_menu_counter.php');
        }
        
     		
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


            function change_status(m){

                $.ajax({
                    url: "php/set_seen_status.php",
                    type: "POST",
                    data:{
                        "id" : m
                    },
                    success:function(resp){
                        $("#nav_button").click();
                        refresh_list_att();

                    }
                });
            }

     </script>