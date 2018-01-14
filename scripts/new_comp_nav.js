

var f = "New Complain";
$(".nav-elements").hover(function () {
    if($(window).width()>="902")
    {
        console.log(f);
        $(".nav-elements").stop(false, true);
        $(this).animate({width: "130%"}, 500);
        $(this).css({'z-index':'1'});
    }
    else{
        $(this).css({'width': "400%",'z-index':"1"});
    }
}, function () {
    if($(window).width()>="902") {
        if ($(this).children("span.nav-span").text() != f)
            $(this).animate({width: "100%"}, 500);
        $(this).css({'z-index':'0'});
    }
    else{
        if ($(this).children("span.nav-span").text() != f)
            $(this).css({'width': "100%"});
        $(this).css({'z-index':'0'});
    }
});


$(window).resize(function(){  /*Used when page opened and then resized*/
    if($(window).width()<="902") { //When screen size decreased
        $("#newC").css({
            "height": "50px",
            'width': '400%',
            'z-index': '0'
        });
    }
    else
    {
        $("#newC").css({  //When screen size increased
            'width': '130%',
            'z-index': '0',
            'height': '65px'
        });
    }

});
