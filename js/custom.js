
// Wrap every letter in a span
$('.ml1 .letters').each(function(){
  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
});

anime.timeline({loop: true})
  .add({
    targets: '.ml1 .letter',
    scale: [0.3,1],
    opacity: [0,1],
    translateZ: 0,
    easing: "easeOutExpo",
    duration: 600,
    delay: function(el, i) {
      return 70 * (i+1)
    }
  }).add({
    targets: '.ml1 .line',
    scaleX: [0,1],
    opacity: [0.5,1],
    easing: "easeOutExpo",
    duration: 700,
    offset: '-=875',
    delay: function(el, i, l) {
      return 80 * (l - i);
    }
  }).add({
    targets: '.ml1',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });



  //for multistep form


// Preloader
  $(window).on('load', function() {
    $('#preloader').delay(100).fadeOut('slow',function(){$(this).remove();});
  });

                wow = new WOW(
                      {
                      boxClass:     'wow',      // default
                      animateClass: 'animated', // default
                      offset:       0,          // default
                      mobile:       false,       // default
                      live:         true        // default
                    }
                    )
                    wow.init();


    $(document).ready(function(){
        $("#side_menu").hide();    
        
        
        
        
        
    })


window.onload = function(){
    
    
        
}
    



	function myFunction(){
		$("#side_menu").toggle();
	}




  function myFunction_1(){
    $(".side-nav").toggle();
  }



$(document).ready(function() {

  function close_accordion_sections() {
    $('.ribbon-wrap').removeClass('open');
    $('.ribbon-content').slideUp(300).removeClass('open');
  }

  $('.ribbon-wrap').click(function(e) {
    close_accordion_sections();
    $(this).addClass('open');
    $(this).children('.ribbon-content').slideDown(300);
    e.preventDefault();
  });

});




            


