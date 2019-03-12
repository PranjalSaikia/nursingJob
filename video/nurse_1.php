<?php


	include('../class/connect.php');
	include('../class/sessioncheck_n.php');
	include('../class/class.php');

	$core = Core::getInstance();
?>
<style type="text/css" src="js/wowslider.js"></style>
<style type="text/css">
	
		
	#img_1{
		animation: show 4s;

	}
	

	@keyframes show {
		0%{
			opacity: 0;
		}
		10%{
			opacity: .5
		}
		70%{
			opacity: 1
			
		}
		100%{
			opacity: 1
		}
	}

	#text_1{

		height: 500px;
		width: 500px;
		position: absolute;
		z-index: 3;
		margin-top: -400px;
		margin-left: 150px;
		font-size: 30pt;
		animation: show 4s;

	}
	

</style>


<div class="container">
	<img id="img_1" src="video/images/nurse_1.jpg" width="100%" style="margin-top: 12px;">
	<h1 id="text_1">Hi <br> I am </h1>
</div>

<div id="wowslider-container">
	<div class="ws_images"><ul>
	<li><a href="http://www.wowslider.com/index.html#overview"><img src="images/slide1new.jpg" alt="" title="" id="wows_0"/></a></li>
	<li><a href="http://www.wowslider.com/demo.html"><img src="images/slide2new.jpg" alt="You can add description to slides!" title="You can add description to slides!" id="wows_1"/></a></li>
	<li><a href="http://www.wowslider.com/index.html#download"><img src="images/slide3new.jpg" alt="" title="" id="wows_2"/></a></li>
	</ul></div>
	<div class="ws_bullets"><div>
	<a href="#" title=""><img src="tooltips/slide1new.jpg" alt=""/>1</a>
	<a href="#" title="You can add description to slides!"><img src="tooltips/slide2new.jpg" alt="You can add description to slides!"/>2</a>
	<a href="#" title=""><img src="tooltips/slide3new.jpg" alt=""/>3</a>
	</div></div>
		<a href="#" class="ws_frame"></a>
		<div class="ws_shadow"></div>
	</div>


	<script type="text/javascript">
			$(document).ready(function(){

				$("#wowslider-container").wowSlider({
        effect:"rotate",prev:"",next:"",duration:20*100,delay:20*100,width:580,height:212,autoPlay:true,stopOnHover:false,loop:false,bullets:true,caption:true,captionEffect:"slide",controls:true,logo:"",images:0
    });

			})
			


	</script>

