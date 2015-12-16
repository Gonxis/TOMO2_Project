// JavaScript Document

window.onload = function() {
  
    function bgadj(){
         
        var videoActualWidth = video.getBoundingClientRect().width;
        var videoActualHeight = video.getBoundingClientRect().height;
              
        var ratio =  videoActualWidth / videoActualHeight;         
         
        if ((window.innerWidth / window.innerHeight) < ratio){
          
            video.setAttribute("style", "width: auto");
            video.setAttribute("style", "height: 100%");
              
            <!-- si el vídeo es mas ancho que la ventana lo centro. Esta parte es opcional -->
            if (videoActualWidth > window.innerWidth){
              
                var ajuste = (window.innerWidth - videoActualWidth)/2;                
                
                video.setAttribute("style", "left:"+ajuste+"px");          
            }
          
        }
        else{ 
          
            video.setAttribute("style", "width: 100%");
            video.setAttribute("style", "height: auto");
            video.setAttribute("style", "left: 0");
  
        }
          
    }
 
    <!-- vuelvo a llamar a la función  bgadj() al redimensionar la ventana -->
    window.onresize = function() {
        bgadj();
  
    }
  
}

(function ($) {
  $(document).ready(function(){
 
    // hide .navbar first
    $("#navbar").hide();
 
    // fade in .navbar
    $(function () {
        $(window).scroll(function () {
            // set distance user needs to scroll before we fadeIn navbar
            if ($(this).scrollTop() > 100) {
                $('#navbar').fadeIn();
            } else {
                $('#navbar').fadeOut();
            }
        });

 
    });

});

  }(jQuery));