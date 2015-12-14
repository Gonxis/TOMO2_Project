// Material Overlay Animation by balapa.
/* Fox Background by : https://dribbble.com/shots/741958-Foxy-Family?list=searches&tag=polygon&offset=10 */

(function(){
    'use strict';

    var $mainButton = (".main-button"),
        $closeButton = (".close-button"),
        $buttonWrapper = (".button-wrapper"),
        $ripple = (".ripple"),
        $layer = (".layered-content");

    $mainButton.on("click", function(){
        $ripple.addClass("rippling");
        $buttonWrapper.addClass("clicked").delay(1500).queue(function(){
            $layer.addClass("active");
        });
    });

    $closeButton.on("click", function(){
        $buttonWrapper.removeClass("clicked");
        $ripple.removeClass("rippling");
        $layer.removeClass("active");
    });

})();