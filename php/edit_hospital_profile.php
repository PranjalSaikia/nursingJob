<?php 
	
	include('../class/connect.php');
	include('../class/sessioncheck_h.php');
	include('../class/class.php');

	$core = Core::getInstance();

	$q = "SELECT * FROM hospital_master WHERE h_id=:h_id";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount()>0){
	$r = $stmt->fetchObject();	

	$q1 = "SELECT * FROM hospital_det WHERE h_id=:h_id";
	$stmt1=$core->dbh->prepare($q1);
	$stmt1->bindParam(':h_id',$_SESSION['h_id'],PDO::PARAM_INT);
	$stmt1->execute();
	$c1 = $stmt1->rowCount();
	if($c1 >0){
		$r1= $stmt1->fetchObject();
	}else{
		echo '<script>alertify.logPosition("bottom right");alertify.error("You have to fill up your personal details before uploading the resume, license and videos");</script>';
	}
	
	


?>
<h6>Personal Details</h6>
<section class="profile-edit">
	
	
	<div class="profile-edit-dp" align="center">
		<div>
		<img src="<?php if($c1 > 0){ if($r1->dp != ""){ echo $r1->dp; }else{ echo "images/dummyimage.png"; } }else{ echo "images/dummyimage.png"; } ?>">
		
			<label class="upload-dp">
			+ Upload a new pic
			<form id="r4" method="post" enctype="multipart/form-data">
				<input type="file" name="file4" accept="image/*" onchange="upload_file(4)">
				<input type="hidden" name="ty" value="4">
			</form>
		</label>
		</div>

	</div>

	

	<form method="post" id="f1">

	<div class="profile-edit-text">
		
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="h_name" class="form-control" value="<?php  echo $r->h_name;   ?>">
			</div>	
			<div class="form-group">
				<label>Short Description</label><br/>
				<input type="text" name="textid" id="textid" readonly style="display:none" value="" /> 
          <textarea name="ed" id="ed"><?php if($c1>0){ echo $r1->h_des_short; } ?></textarea> 
           <script>

              CKEDITOR.replace( 'ed', { height:400, 
                
                   allowedContent: true
                   
              } );

            </script>
			</div>	
			<div class="form-group">
				<label>Long Description</label><br/>
				<input type="text" name="textid1" id="textid1" readonly style="display:none" value="" /> 
          <textarea name="ed1" id="ed1"><?php if($c1>0){ echo $r1->h_des_long; } ?></textarea> 
           <script>

              CKEDITOR.replace( 'ed1', { height:400, 
                
                   allowedContent: true
                   
              } );

            </script>
			</div>		
		
	</div>

	<div class="profile-edit-text-1">

		
			<div class="form-group">
				<label>City</label>
				<input type="text" name="city" class="form-control" value="<?php if($c1>0){ echo $r1->city; } ?>">
			</div>

			<div class="form-group">
				<label>District</label>
				<input type="text" name="district" class="form-control" value="<?php if($c1>0){ echo $r1->district; } ?>">
			</div>

			<div class="form-group">
				<label>State</label>
				<input type="text" name="state" class="form-control" value="<?php if($c1>0){ echo $r1->state; } ?>">
			</div>

			<div class="form-group">
				<label>Pin</label>
				<input type="text" name="pin" class="form-control" value="<?php if($c1>0){ echo $r1->pin; } ?>">
			</div>

			<div class="form-group" align="right">
				<button class="btn btn-primary" type="submit" name="update">Update</button>
			</div>				
		
	</div>
	</form>
</section>

<?php 
	
	}

?>

<hr>

<h6>Company profile (Additional)</h6>

<div class="row">

	<div class="col-md-6">
		<label>Please upload</label>
				<label class="upload-button">
			+ Company profile <br>(.pdf only)
			<form id="r10" method="post" enctype="multipart/form-data">
				<input name="file10" type="file" accept="application/pdf" onchange="upload_file(10)">
				<input type="hidden" name="ty" value="10">
			</form>
		</label>
		<?php 

			if($r1->company_profile != ""){
				if($r1->company_profile_status == 1){

		?>
		<a href="<?php echo $r1->company_profile; ?>" target="_blank"><button class="bar" type="button">View Uploaded</button></a>


		<?php 

				}else{


		?>

		<a target="_blank"><button class="bar btn-warning" style="background-color: #FFC107" type="button">Awaiting for verification...</button></a>


		<?php 
				}
				}else{

		?>
		<button class="bar" type="button" style="background-color: #ff4848; color: white">Not Uploaded</button>
		<?php 

				} 

		?>
	</div>


	<div class="col-md-6">
			<label>Please upload</label>
				<label class="upload-button">
			+ Videos <br> (.mp4 only)
			<form id="r11" method="post" enctype="multipart/form-data">
				<input name="file11" type="file" accept="application/pdf" onchange="upload_file(11)">
				<input type="hidden" name="ty" value="11">
			</form>
		</label>

		<?php 

			if($r1->videos_h != ""){
				if($r1->videos_h_status == 1){
		?>
		<a href="<?php echo $r1->videos_h; ?>" target="_blank"><button class="bar" type="button">View Uploaded</button></a>

		<?php 

				}else{

		?>

		<a target="_blank"><button class="bar btn-warning" style="background-color: #FFC107" type="button">Awaiting for verification...</button></a>

		<?php 		
				}
				}else{

		?>
		<button class="bar" type="button" style="background-color: #ff4848; color: white">Not Uploaded</button>
		<?php 

				} 

		?>
			
	</div>

</div>

<hr>

<h6>File Uploaded</h6>

<section class="uploaded-files">


<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="card" align="center" style="height: 100px;padding-top: 40px">
			<a href="<?php echo $r1->letter_inc; ?>" target="_blank"><i class="fa fa-download"> download Letter of Incorporation</i></a>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
	<div class="card" align="center" style="height: 100px;padding-top: 40px">
	<a href="<?php echo $r1->bank_det; ?>" target="_blank"><i class="fa fa-download"> download Bank details</i></a>
		</div>
	</div>
</div>

</section>


<hr>

<h6>Security &amp; General Settings</h6>

<section class="general-settings">
	<div class="sub-nav">
		<ul class="list-unstyled" id="sub_nav">
			<a onclick="get_settings('change_password')"><li>Change Password <i class="fa fa-angle-right"></i></li></a>
			<!--<a onclick="get_settings('change_email')"><li>Change Email <i class="fa fa-angle-right"></i></li></a>
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
	

	function get_settings(n){
		$(".sub-det").load('settings_h/' + n + '.html');
	}


	$("#f1").submit(function(event){
        event.preventDefault();

        for (var i in CKEDITOR.instances) {
        	CKEDITOR.instances[i].updateElement();
    	}

        var t = $(this).serialize();

        $.ajax({
            url: "edit/edit_details_h.php",
            type: "POST",
            data: t,
            success:function(resp){
            	
                if(resp == true){
                	alertify.logPosition("bottom right");
                    alertify.success("Succesfully Updated.");
                    //window.location.href="edit_profile_nurse.html";
                    $('.side-nav').load("php/menu_h_new.php");
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

    	for(var i = 1 ; i < 15 ; i++){
	    $("#r"+i).submit(function(e){

	    	e.preventDefault();

	    		var t = new FormData(this);
		        $.ajax({
		            url: "edit/upload_file_h.php",
		            type: "POST",
		            dataType: 'html',
		            data: t,
		            cache: false,
		            contentType: false,
		            processData: false,
		            success:function(resp){
		            	alertify.logPosition("bottom right");
		                alertify.success("Succesfully Updated");
		                window.location.href="edit_profile_hospital.html";
		                
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
			url: "settings_h/change_password_php.php",
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