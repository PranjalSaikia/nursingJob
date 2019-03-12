<?php 
        
        include('../class/connect.php');
        include('../class/sessioncheck_h.php');
        include('../class/class.php');

        $core = Core::getInstance();

        if(!isset($_POST['n'])){
            $n = 1;
        }else{
            $n = trim($_POST['n']);
        }


        $q = "SELECT * FROM hospital_master WHERE h_id=:h_id";
        $stmt=$core->dbh->prepare($q);
        $stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount()>0){

            $r = $stmt->fetchObject();

            $q1 = "SELECT * FROM hospital_det WHERE h_id=:h_id";
            $stmt1=$core->dbh->prepare($q1);
            $stmt1->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
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


    <header>
            <!-- <div class="profile-image" onmouseover="show_edit()" onmouseout="hide_edit()">
                <img src="<?php echo $dp; ?>" width="100%">
                
            </div>
            <div class="profile-name">
                <h6><?php echo $r->h_name; ?></h6>
                <p> <a href="edit_profile_hospital.html"><i class=" fa fa-pencil"></i> Edit Profile</a></p>


            </div> -->
        </header>
        <div><br>
        <ul class="list-unstyled" id="nav_list">
            <a href="profile_hospital.html"><li id="item_1"><tag class="fa fa-home"></tag> Home <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="nurse_list.html"><li id="item_6"><tag class="fa fa-graduation-cap"></tag> Nurse List <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="requests.html"><li id="item_8"><tag class="fa fa-skype"></tag> Requests List <span><i class="fa fa-angle-right"></i></span></li></a>
            <hr>
            <label class="nav-label">Job portal</label>
            <a href="post_job.html"><li id="item_2"><tag class="fa fa-plus"></tag> Add Job <span><i class="fa fa-angle-right"></i></span></li></a>
            <a href="view_apply.html"><li id="item_3"><tag class="fa fa-certificate"></tag> Applications <i class="badge badge-primary" id="bdp">1</i> <span><i class="fa fa-angle-right"></i></span></li></a>
            <!-- <a href="rec_interest_send.html"><li id="item_7"><tag class="fa fa-certificate"></tag> Interests <span><i class="fa fa-angle-right"></i></span></li></a> -->
            <hr>
            <label class="nav-label">About us</label>
            <a href="team_h.html"><li id="item_4"><tag class="fa fa-grav"></tag> Team <span><i class="fa fa-angle-right"></i></span></li></a>
            <hr>
            <label class="nav-label">Profile</label>
            <a href="edit_profile_hospital.html"><li id="item_5"><tag class="fa fa-pencil"></tag> Edit Profile</li></a>
            <a href="class/logout_n.php"><li><tag class="fa fa-sign-out"></tag> Logout</li></a>
        </ul>

        <div style="position: absolute; bottom: 0; left: 0; text-align: center; width: 100%;background-color: #2f2f2f; color: white; font-size: 7pt;padding: 8px" >
            &copy;jobforsure.in | All rights reserved
        </div>
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


            $(document).ready(function(){
                $.ajax({
                    url: "php/get_overview_h_number_only.php",
                    type: "POST",
                    success:function(resp){
                        $("#bdp").html(resp);
                    }
                    });
            });
        </script>