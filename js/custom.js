/*
* @author: Damola Mabogunje
* @description: Custom Jquery functions
*/

$(document).ready(function(){
    $(".login").mouseover(function(){
        $(".usermenu").show();
    });

    $(".login").mouseout(function(){
        $(".usermenu").hide();
    });

    $("#filter li").click(function(){
        var STYLE_PREFIX = ".category-";
        var cat = $(this).attr("title");

        // Show item as selected
        $("#filter li").removeClass("selected");
        $(this).addClass("selected");

        if(cat) // Show only relevant posts if we have selected a category
        {
            $(".post").fadeOut();
            $(STYLE_PREFIX + cat).fadeIn();
        }
        else
        {
            $(".post").fadeIn();
        }
    });
});
