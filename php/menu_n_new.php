<?php 
        
        include('../class/connect.php');
        include('../class/sessioncheck_n.php');
        include('../class/class.php');

        $core = Core::getInstance();

        if(!isset($_POST['n'])){
            $n = 1;
        }else{
            $n = trim($_POST['n']);
        }


        $q = "SELECT * FROM nurse_master WHERE n_id=:n_id";
        $stmt=$core->dbh->prepare($q);
        $stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount()>0){

            $r = $stmt->fetchObject();

            $q1 = "SELECT * FROM nurse_det WHERE n_id=:n_id";
            $stmt1=$core->dbh->prepare($q1);
            $stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
            $stmt1->execute();
            if($stmt1->rowCount()>0){
                $r1 = $stmt1->fetchObject();
                if($r1->dp != ""){
                    $dp = $r1->dp;    
                }else{
                    $dp = "images/dummyimage.png";
                }
                
            }else{
                $dp = "images/dummyimage.png";
            }

?>


    <header class="p-3">
            <!-- <div class="profile-image" onmouseover="show_edit()" onmouseout="hide_edit()">
                <img src="<?php echo $dp; ?>" width="100%">
            </div> -->
            
            
        </header>
        <div style="overflow-y: auto;">
        <ul class="list-unstyled" id="nav_list">
            <a href="profile_nurse.html"><li id="item_1"><tag class="fa fa-home"></tag> Home <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="jobs_applied.html"><li id="item_2"><tag class="fa fa-users"></tag> Applied Jobs <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="rec_interested.html"><li><tag class="fa fa-users"></tag> Interested <span><i class="fa fa-angle-right"></i></span></li></a>
            <hr>
            <label class="nav-label">Career With us</label>
            <a href="online_education.html"><li id="item_3"><tag class="fa fa-book"></tag> Online Education <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="career_counselling.html"><li id="item_4"><tag class="fa fa-info-circle"></tag> Career Counselling <span><i class="fa fa-angle-right"></i></span></li></a>

            <a href="team.html"><li id="item_5"><tag class="fa fa-grav"></tag> Team <span><i class="fa fa-angle-right"></i></span></li></a>
            <hr>
            <label class="nav-label">Profile</label>
            <a href="edit_profile_nurse.html"><li id="item_6"><tag class="fa fa-pencil"></tag> Edit Profile <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="design_video.html"><li id="item_7"><tag class="fa fa-video-camera"></tag> Design your video <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="class/logout_n.php"><li><tag class="fa fa-sign-out"></tag> Logout</li></a>
        </ul>
        
        </div>

        <div style="position: absolute; bottom: 0; left: 0; text-align: center; width: 100%;background-color: #2f2f2f; color: white; font-size: 7pt;padding: 8px" >
            &copy;jobforsure.in | All rights reserved
        </div>

        <?php 

            }

        ?>

        <script type="text/javascript">
            function show_edit(){
                document.getElementById('edit_butt').style.display='block';
            }

            function hide_edit(){
                document.getElementById('edit_butt').style.display='none';
            }

            var j = <?php echo $n; ?>;
            document.getElementById('item_'+j).className += ' active';

        </script>