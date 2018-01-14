/*
 * Created by iLLuMinaTi on 29-Mar-17.
 */
$(".nav-elements").click(function () {
    if($(window).width()>="902") {
        // f = $(this).children("span.nav-span").text();
        console.log("Clicked on "+$(this).children("span.nav-span").text());
        $(this).css({"width": "130%", "z-index": "0"});
        /*console.log($(this).parent().siblings().children());*/
        $(this).parent().siblings().children().css({"width": "100%"});
        console.log("Width of siblings  changed to "+$(this).parent().siblings().children().width());
        $(this).parent().siblings().children().animate({"height": "41.4px"}, 100);
        $(this).animate({height: "75px"}, 100);
    }

});
