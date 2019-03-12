<?php 
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$h_id = addslashes(strip_tags(trim($_POST['h_id'])));

    $q = "SELECT a.*,b.* FROM hospital_master a INNER JOIN hospital_det b ON a.h_id=b.h_id WHERE a.h_id=:h_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':h_id',$h_id,PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $r = $stmt->fetchObject();



?>

<div class="container">
    <div class="row">
        <div class="col-md-12" align="left">
            <h2><?php echo $r->h_name; ?></h2>
            <h6><?php echo $r->city; ?>, <?php echo $r->state; ?></h6>
        </div>


        <div class="col-md-12" align="justify">
            <p>Short Description: <?php echo stripslashes($r->h_des_short); ?></p>
        </div>


        <div class="col-md-12" align="justify">
            <p>Long Description: <?php echo stripslashes($r->h_des_long); ?></p>
        </div>


        
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-12">
            <?php 

                $q2 = "SELECT * FROM interested_nurse WHERE n_id=:n_id AND h_id=:h_id";
                $stmt2=$core->dbh->prepare($q2);
                $stmt2->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
                $stmt2->bindParam(':h_id',$r->h_id,PDO::PARAM_INT);
                $stmt2->execute();
                if($stmt2->rowCount()==0){

            ?>
            <button type="button" onclick="req_from_nurse('<?php echo $r->h_id; ?>')" class="btn btn-warning">Send a request</button> (You need to send a request to the recruiter to get the contact details)
            <?php 

                }else{

                    $r2 = $stmt2->fetchObject();
                    if($r2->seen == 0){
                        echo '<button type="button" class="btn btn-success"><i class="fa fa-check"></i> Request Sent</button> (contact details will be available after acceptence of the request)';
                    }elseif($r2->seen == 1){

            ?>


                <div class="col-md-12">
                    <p>Address:<br>
                    City: <?php echo $r->city; ?>, <?php echo $r->district; ?>, <?php echo $r->state; ?><br>
                    Pin: <?php echo $r->pin; ?><br>
                    Contact: <?php echo $r->h_phn; ?><br>
                    Email: <?php echo $r->h_email; ?>
                    </p>
                </div>
            

            <?php 

                }
            }

            ?>
        </div>
    </div>

    <hr/>
    <div class="container">
        <form class="form" id="req1" method="post">
            <input type="hidden" name="h_id" id="h_id" value="<?php echo $r->h_id; ?>">
            <div class="form-group">
                <label>Leave a message</label>
                <textarea class="form-control" name="message" rows="5" placeholder="Type your message here . . . . . . "></textarea>
            </div>
            <div class="form-group" align="right">
                <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-send"></i> Send</button> or 
                <a href="javascript:void(0)" onclick="request_a_video_call('<?php echo $r->h_id; ?>')"><button class="btn btn-sm btn-info" type="button"><i class="fa fa-skype"></i> Request a video call</button></a>
            </div>
        </form>
    </div>
</div>

<?php
    }else{
        echo 'This recruiter has not updated the profile yet.';
    }

?>


<script type="text/javascript">
    $("#req1").submit(function(event){

        event.preventDefault();

        $.ajax({
            url: "php/leave_a_message.php",
            type: "POST",
            data: $(this).serialize(),
            success:function(resp){
                if(resp == true){
                    $.alert("Message Successfullly sent");
                    $("#req1")[0].reset();
                }         
            }
        })

});
</script>
