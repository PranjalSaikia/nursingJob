<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$q = "SELECT * FROM nurse_master WHERE n_id=:n_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount()>0){
	$r = $stmt->fetchObject();	

	$q1 = "SELECT * FROM nurse_det WHERE n_id=:n_id";
	$stmt1=$core->dbh->prepare($q1);
	$stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
	$stmt1->execute();
	$c1 = $stmt1->rowCount();
	if($c1 >0){
		$r11= $stmt1->fetchObject();
	}else{
		echo '<script>alertify.logPosition("bottom right");alertify.error("You have to fill up your personal details before uploading the resume, license and videos");</script>';
	}
	
	


?>

<div id="status">
	<?php if($c1==0){ ?>
	<div class="alert alert-warning">
	  <strong>Warning!</strong> Please fill up the necessary details before uploading the files
	</div>
	<?php } ?>
</div>
<h6>Personal Details</h6>
<section class="profile-edit">
	
	
	<div class="profile-edit-dp" align="center">
		<div>
		<img src="<?php if($c1 > 0){ if($r11->dp != ""){ echo $r11->dp; }else{ echo "images/dummyimage.png"; } }else{ echo "images/dummyimage.png"; } ?>">
				
			<?php if($c1>0){ ?>
			<label class="upload-dp">
			+ Upload a new pic
			<form id="r4" method="post" enctype="multipart/form-data">
				<input type="file" name="file4" accept="image/*" onchange="upload_file(4)">
				<input type="hidden" name="ty" value="4">
			</form>
		</label>
		<?php } ?>
		</div>

		<div align="left">
			<span class="text-primary"><b>Tell Us about yourself</b></span>
			<br>

			<?php if($c1>0){ echo $r11->n_des; } ?>
		</div>

	</div>

	

	<form method="post" id="f1">

	<div class="profile-edit-text">
		
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="n_name" class="form-control" value="<?php  echo $r->n_name;   ?>">
			</div>	
			<!-- <div class="form-group">
				<label>Short Description</label>
				<textarea type="text" name="n_des" id="n_des" class="form-control" placeholder="Something about yourself" style="min-height: 173px;"></textarea>
			</div> -->
			<div class="form-group">
				<label>Tell us about yourself</label><br/>
			<input type="text" name="textid" id="textid" readonly style="display:none" value="" /> 
          <textarea name="ed" id="ed"></textarea> 
           <script>

              CKEDITOR.replace( 'ed', { height:400, 
                
                   allowedContent: true
                   
              } );

            </script>	
        </div>

		
	</div>

	<div class="profile-edit-text-1">

		
			<div class="form-group">
				<label>City</label>
				<input type="text" name="city" class="form-control" value="<?php if($c1>0){ echo $r11->city; } ?>">
			</div>

			<div class="form-group">
				<label>District</label>
				<input type="text" name="district" class="form-control" value="<?php if($c1>0){ echo $r11->district; } ?>">
			</div>

			<div class="form-group">
				<label>State</label>
				<input type="text" name="state" class="form-control" value="<?php if($c1>0){ echo $r11->state; } ?>">
			</div>

			<div class="form-group">
				<label>Pin</label>
				<input type="text" name="pin" class="form-control" value="<?php if($c1>0){ echo $r11->pin; } ?>">
			</div>

			<div class="form-group">
				<label>Skype / Messenger Link</label>
				<input type="text" name="slink" class="form-control" id="slink" value="<?php if($c1>0){ echo $r11->slink; } ?>" placeholder="Paste your link here">
			</div>

			<div class="form-group" align="right">
				<button class="btn btn-primary" type="submit" name="update">Update details</button>
			</div>				
		
	</div>
	</form>
</section>

<?php 
	
	}

?>

<hr>
<h6>Professional Details</h6>
<br>

<h6>Work Experience</h6>

<section class="profile-edit-1">
	
	<div class="profile-edit-dp-1">
		<form method="post" id="f2" class="form-own">
			<div class="form-group">
				<label>Job title / Designation</label>
				<input type="text" name="job_title" class="form-control" placeholder="Job Title / Designation">
			</div>

			<div class="form-group">
				<label>Organisation</label>
				<input type="text" name="job_org" class="form-control" placeholder="Organisation">
			</div>

			<div class="form-group">
				<label>Period</label>
				<div class="row" style="padding-left: 15px;">
				<select name="period1" class="form-control col-md-4" onchange="cal_exp()">
					<?php

						for($i = date('Y');$i >= 1970 ;$i--){

					?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>

					<?php 


						}


					?>
				</select>
				<div class="col-md-2" align="center" style="padding-top: 10px;"> - </div>

				<select name="period2" class="form-control col-md-4" onchange="cal_exp()">
					<option value="Present">Present</option>
					<?php

						for($i = date('Y');$i >= 1970 ;$i--){

					?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>

					<?php 


						}


					?>
				</select>
				</div>
				
			</div>	

			<div class="form-group">
				<input type="checkbox" name="current" id="current" value="1" /> Currently I am Working here
			</div>

			<div class="form-group">
				<label>Experience in years</label>
				<input type="text" name="job_exp" class="form-control" placeholder="Experience in years">
			</div>
				
			<div class="form-group">
				<label>Job Description</label>
				<textarea type="text" name="job_det" class="form-control" placeholder="Job Description" style="min-height: 103px;"></textarea>
			</div>

			<div class="form-group" align="right">
				<button class="btn btn-primary" type="submit">Add Experience</button>
			</div>


		</form>
		

	</div>


	<div class="profile-edit-text-1-1" style="overflow: scroll;">
		<div class="table-responsive" > 
		<div id="sub1">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<td width="5%">#</td>
						<td>Job Title / Designation</td>
						<td>Organisation</td>
						<td>Period</td>
						<td>Total Exp</td>
						<td width="40%">Description</td>
						<td width="5%"></td>
					</tr>
				</thead>
				<tbody>
					<?php 
							$e=1;
							$q1 = "SELECT * FROM job_exp_profile WHERE n_id=:n_id";
							$stmt1=$core->dbh->prepare($q1);
							$stmt1->bindParam(':n_id',$_SESSION['n_id'],PDO::PARAM_INT);
							$stmt1->execute();
							if($stmt1->rowCount()>0){

								while($r1 = $stmt1->fetchObject()){

					?>
					<tr <?php if($r1->current == 1){ ?>class="text-success" <?php } ?>>
						<td><?php echo $e;$e++; ?></td>
						<td><?php echo $r1->job_title; ?></td>
						<td><?php echo $r1->job_org; ?></td>
						<td><?php echo $r1->period; ?></td>
						<td><?php echo $r1->job_exp; ?></td>
						<td><?php echo $r1->job_det; ?></td>
						<td><a onclick="delete_exp('<?php echo $r1->id; ?>')"><i class="fa fa-trash"></i></a></td>
						
					</tr>

					<?php 

							}
						}

					?>
				</tbody>
			</table>
		</div>
	</div>
	</div>



</section>

<hr>
<?php if($c1>0){ ?>
<h6>Resume &amp; Videos</h6>

<section class="resume-section">
	
	<div class="resume-upload">
		<label class="upload-button">
			+ Resume
			<form id="r1" method="post" enctype="multipart/form-data">
				<input name="file1" type="file" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf" onchange="upload_file(1)">
				<input type="hidden" name="ty" value="1">
			</form>
		</label>
		<?php 


			if($r11->resume != ""){
				if($r11->resume_status == 1){

		?>
		<a href="<?php echo $r11->resume; ?>" target="_blank"><button class="bar" type="button">View Uploaded</button></a>
		<?php 

				}else{

		?>

		<button class="bar alert-warning" type="button" style="background-color: #FFC107; color: white">Awaiting for verification....</button>

		<?php } ?>

		<?php 
				}else{

		?>
		<button class="bar alert-danger" type="button" style="background-color: #ff4848; color: white">Not Uploaded</button>
		<?php 

				}

		?>
	</div>

	<div class="license-upload">
		<label class="upload-button">
			+ License
			<form id="r2" method="post" enctype="multipart/form-data">
			<input name="file2" type="file" accept="application/pdf, image/*"  onchange="upload_file(2)">
			<input type="hidden" name="ty" value="2">
			</form>
		</label>
		<?php 

			if($r11->slicense != ""){

				if($r11->slicense_status == 1){

		?>
		<a href="<?php echo $r11->slicense; ?>" target="_blank"><button class="bar" type="button">View Uploaded</button></a>

		<?php 

			}else{

		?>

		<button class="bar alert-warning" type="button" style="background-color: #FFC107; color: white">Awaiting for verification....</button>
		<?php 	

				}
				}else{

		?>
		<button class="bar alert-danger" type="button" style="background-color: #ff4848; color: white">Not Uploaded</button>
		<?php 

				}

		?>
	</div>

	<div class="video-upload">
		<label class="upload-button">
			+ Video
			<form id="r3" method="post" enctype="multipart/form-data">
			<input name="file3" type="file" accept="video/*" onchange="upload_file(3)">
			<input type="hidden" name="ty" value="3">
			</form>
		</label>
		<?php 

			if($r11->svideo != ""){
				if($r11->svideo_status == 1){

		?>
		<a href="<?php echo $r11->svideo; ?>" target="_blank"><button class="bar" type="button">View Uploaded</button></a>

		<?php 

			}else{

		?>

		<button class="bar alert-warning" type="button" style="background-color: #FFC107; color: white">Awaiting for verification....</button>

		<?php 
					}

					}else{

		?>
		<button class="bar" type="button" style="background-color: #ff4848; color: white">Not Uploaded</button>
		<?php 

				} 

		?>
	</div>

</section>



<?php } ?>

<hr>

<h6>Security &amp; General Settings</h6>

<section class="general-settings">
	<div class="sub-nav">
		<ul class="list-unstyled" id="sub_nav">
			<a onclick="get_settings('change_password')"><li>Change Password <i class="fa fa-angle-right"></i></li></a>
			<!-- <a onclick="get_settings('change_email')"><li>Change Email <i class="fa fa-angle-right"></i></li></a>
			<a onclick="get_settings('ask_query')"><li>Ask for query <i class="fa fa-angle-right"></i></li></a>
			<a onclick="get_settings('deactivation')"><li>Deactivation <i class="fa fa-angle-right"></i></li></a>
			<a onclick="get_settings('delete')"><li>Delete Account <i class="fa fa-angle-right"></i></li></a> -->
		</ul>
	</div>

	<div class="sub-det">
		<h6>Change Password</h6>
		<form method="post" id="f11">
			<div class="form-group ">
				<label>Old Password</label>
				<input type="password" name="pass1" id="pass1" placeholder="Old Password" class="form-control" required>
			</div>

			<div class="form-group ">
				<label>New Password</label>
				<input type="password" name="pass2" id="pass2" placeholder="New Password" class="form-control" required>
			</div>

			<div class="form-group ">
				<label>Confirm new Password</label>
				<input type="password" name="pass3" id="pass3" placeholder="Confirm new Password" class="form-control" onkeyup="check_cpass(this.value)" required>
				<div id="msg"></div>
			</div>

			<div class="form-group" align="right">
				<button class="btn btn-primary" type="submit" id="sub11">Submit</button>
			</div>
		</form>
	</div>
</section>

<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<script src="js/sha256.js"></script>
<script type="text/javascript">


	$("#f2").submit(function(event){
	    event.preventDefault();

	    var t = $("#f2").serialize();

	    $.ajax({
	        url: "edit/edit_profile_exp.php",
	        type: "POST",
	        data: t,
	        success:function(resp){
	            $("#sub1").html(resp);
	        },
	        error:function(resp){
	            alert(resp);
	        }
	    });

	    $(this)[0].reset();
	});


	function delete_exp(n){
		$.ajax({
        url: "edit/edit_profile_exp_del.php",
        type: "POST",
        data: {
        	"id" : n,
        },
        success:function(resp){
            $("#sub1").html(resp);
        },
        error:function(resp){
            alert(resp);
        }
    });
	}

	function get_settings(n){
		$(".sub-det").load('settings/' + n + '.html');
	}


	$("#f1").submit(function(event){
        event.preventDefault();

        for (var i in CKEDITOR.instances) {
        CKEDITOR.instances[i].updateElement();
    	}

        var t = $(this).serialize();

        //var n_des = CKEDITOR.instances['ed'].getData();
        //console.log(n_des);

        //console.log(t);
        $.ajax({
            url: "edit/edit_details.php",
            type: "POST",
            data: t,
            success:function(resp){
            	console.log(resp);
                if(resp == true){
                	alertify.logPosition("bottom right");
                    alertify.success("Succesfully Updated.");
                    window.location.href="edit_profile_nurse.html";
                    
                }
            },
            error:function(resp){
                alert(resp);
            }
        });
        
    });


    function upload_file(n){

	      $("#r"+n).submit();  
    	
    	
    }

    $(document).ready(function(){

    	for(var i = 1 ; i < 5 ; i++){
	    $("#r"+i).submit(function(e){

	    	e.preventDefault();

	    		var t = new FormData(this);
		        $.ajax({
		            url: "edit/upload_file.php",
		            type: "POST",
		            dataType: 'html',
		            data: t,
		            cache: false,
		            contentType: false,
		            processData: false,
		            beforeSend:function(){
		            	$("#status").html("<div class='uploading'>Uploading...</div>");
		            },
		            success:function(resp){
		            	$("#status").html("");
		            	alertify.logPosition("bottom right");
		                alertify.success("Succesfully Updated");
		                window.location.href="edit_profile_nurse.html";
		                
		            },
		            error:function(resp){
		                alert(resp);
		            }
		        });
	    })

	}

    });
    

	$("#f11").submit(function(event){
		event.preventDefault();

		var t = $(this).serialize();

		var pass1 = sha256($("#pass1").val());
		var pass2 = sha256($("#pass2").val());
		var pass3 = sha256($("#pass3").val());

		$.ajax({
			url: "settings/change_password_php.php",
			type: "POST",
			data: {
				"pass1" : pass1,
				"pass2" : pass2,
				"pass3" : pass3,
			},
			success:function(resp){
				alertify.logPosition("bottom right");
				alertify.success("Succesfully Updated!");
			},
			error: function(resp){
				alert(resp);
			}
		});

		$(this)[0].reset();

		
	});

	function check_cpass(n){
		var m = document.getElementById('pass2').value;

		if(n == m){
			$("#msg").html("<span style='color: green;'>Password Matched</span>");
			$("#sub11").attr('disabled',false);
		}else{
			$("#msg").html("<span style='color: red;'>Password donot matched</span>");
			$("#sub11").attr('disabled',true);
		}
	}



	$("#f100").submit(function(event){
		event.preventDefault();

		var t = $(this).serialize();

		$.ajax({
			url: "edit/profile_link.php",
			type: "POST",
			data: t,
			success:function(resp){
				alertify.logPosition("bottom right");
				alertify.success("Succesfully Updated!");
			},
			error: function(resp){
				alert(resp);
			}
		});

		//$(this)[0].reset();

		
	});


	function cal_exp(){
		 var m3 = document.getElementById('period1');
		 var n3 = document.getElementById('period2');
		 var m = parseFloat(m3.options[m3.selectedIndex].value);
		 var n = parseFloat(n3.options[n3.selectedIndex].value);

		 console.log(m);

		 if(n == "Present"){
		 	var d = new Date();
		 	var n1 = d.getFullYear();
		 	n = n1;
		 }

		 var p = n - m;

		 $("#job_exp").val(p);

	}



	//ckeditor


	function show_txt(){ 
 document.getElementById("txt").value= document.getElementById("txtedit").innerHTML;
}


function text_heading(){
    var op=$( '.text_heading' ).val();
  var highlight = window.getSelection();
  var rep=""; var tg="";
  if(op=="norm"){ 
  if(highlight== $("H1:contains("+ highlight +")").text())
  { tg="H1";   rep="go123</H1>"+highlight+"<H1>go123";
  }else if(highlight== $("H2:contains("+ highlight +")").text())
  { tg="H2";  rep="go123</H2>"+highlight+"<H2>go123";
  }else if(highlight== $("H3:contains("+ highlight +")").text())
  { tg="H3";   rep="go123</H3>"+highlight+"<H3>go123";
  }else if(highlight== $("H4:contains("+ highlight +")").text())
  { tg="H4";   rep="go123</H4>"+highlight+"<H4>go123";
  }else if(highlight== $("H5:contains("+ highlight +")").text())
  { tg="H5";   rep="go123</H5>"+highlight+"<H5>go123";
  }else if(highlight== $("H6:contains("+ highlight +")").text())
  { tg="H6";   rep="go123</H6>"+highlight+"<H6>go123";
  }
    
  // rep="</H1>"+highlight+"<H1>";
  var text = $('.textEditor').html(); 
    $('.textEditor').html(text.replace(highlight, rep));
  if(tg=='H1'){
  $("H1:contains('go123')").remove();
  }if(tg=='H2'){
  $("H2:contains('go123')").remove();
  }if(tg=='H3'){
  $("H3:contains('go123')").remove();
  }if(tg=='H4'){
  $("H4:contains('go123')").remove();
  }if(tg=='H5'){
  $("H5:contains('go123')").remove();
  }if(tg=='H6'){
  $("H6:contains('go123')").remove();
  }
   placeCaretAtEnd($('.textEditor').get(0));
  }else{ if(op=="h1"){
      rep = '<H1>'+highlight+'</H1>';
  }else if(op=="h2"){
    rep = '<H2>'+highlight+'</H2>';
  }else if(op=="h3"){
    rep = '<H3>'+highlight+'</H3>';
  }else if(op=="h4"){
    rep = '<H4>'+highlight+'</H4>';
  }else if(op=="h5"){
    rep = '<H5>'+highlight+'</H5>';
  }else if(op=="h6"){
    rep = '<H6>'+highlight+'</H6>';
  }
  if(op!=""){ 
  var text = $('.textEditor').html(); 
  
    $('.textEditor').html(text.replace(highlight, rep));
   placeCaretAtEnd($('.textEditor').get(0));
  }
  }
  
}
function bld(){
     document.execCommand('bold');
}
/*$('body').on('click','.embolden',function(){
    document.execCommand('bold');
});*/
function itlc(){
    document.execCommand('italic');
}
function undr(){
    document.execCommand('underline');
}

function unordr(){
    var span = '<br/><ul><li></li></ul>';
  $('.textEditor').append(span);
   placeCaretAtEnd($('.textEditor').get(0));
}

function ordr(){
    var span = '<br/><ol><li></li></ol>';
  $('.textEditor').append(span);
   placeCaretAtEnd($('.textEditor').get(0));
}
function placeCaretAtEnd(el) {
    el.focus();
    if (typeof window.getSelection != "undefined"
            && typeof document.createRange != "undefined") {
        var range = document.createRange();
        range.selectNodeContents(el);
        range.collapse(false);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (typeof document.body.createTextRange != "undefined") {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.collapse(false);
        textRange.select();
    }
}

function indent(){
  var highlight = window.getSelection();
   var txt='<span style ="padding-left:30px;">'+ highlight+ '</span>';
  var text = $('.textEditor').html();
    $('.textEditor').html(text.replace(highlight, txt));
  //window
}
function outdent(){
  var highlight = window.getSelection();
   var txt='<span style="margin-left:-30px;">'+ highlight+ '</span>';
  var text = $('.textEditor').html();
    $('.textEditor').html(text.replace(highlight, txt));
  //window
}
function link(){
  var highlight = window.getSelection();
    var span = '<a href="'+highlight+'" style="color:#03F">'+highlight+'</a>';
  var text = $('.textEditor').html();
    $('.textEditor').html(text.replace(highlight, span));
   placeCaretAtEnd($('.textEditor').get(0));
}


	

</script>