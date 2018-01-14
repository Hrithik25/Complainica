<!--Complainica Student Dashboard Page-->
<!--By:iLLuMinaTi-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title> My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../stylesheets/header.css">
    <link rel="stylesheet" href="../stylesheets/student_profile.css">
    <link rel="stylesheet" href="../stylesheets/content_frame.css">
    <link rel="stylesheet" href="../stylesheets/chat.css">

    <!--Clicked element styling-->
    <style>
        #chat {  /*When clicked and opened (without resizing)*/
            width: 130%;
            z-index: 0;
            height: 75px;
        }
        @media screen and  (max-width:902px){
            #chat{
                height:50px;
                width:400%;
                z-index:0;
            }
            #chat:hover{
                z-index: 1;
            }
        }
    </style>

</head>
<body>

<img  id="bg" src="../images/grad-1.jpg"> <!--background-->
<div id="dp" >
    <img src="../images/icon2.png" id="dp_img" alt="user-icon" title="Your Profile Picture">
    <div id="name-reg"  align="center">Jyot Mehta<br>20154135</div>

</div>

<div class="header"> <!--Heading-->
    <img src="../images/logo.jpg" id="logo" title="Complainica">
    <div id="heading">Hi,Jyot!!</div>
    <!--        <button class="btn btn-info" id="logout">Logout&nbsp<span class="glyphicon glyphicon-log-out"></span> </button>-->
    <a href="" id="logout" title="Logout">Logout&nbsp<span class="glyphicon glyphicon-log-out" title="Logout" style="text-decoration: underline"></span> </a>
    <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right" title="MNNIT">
</div>

<div id="nav-bar">
    <a href="edit_profile.php" ><div id="edit" class="nav-elements">&nbsp <span class="glyphicon glyphicon-pencil"></span> <span class="nav-span">Edit Profile</span> </div></a>
    <a href="new_complain.php"> <div id="newC" class="nav-elements">&nbsp <span class="glyphicon glyphicon-plus-sign"> </span><span class="nav-span">New Complain</span> </div>
        <a href="my_complains.php" ><div id="pastC" class="nav-elements" >&nbsp<span class="glyphicon glyphicon-time"> </span><span class="nav-span">My Complains</span></div></a>
        <a href="#" ><div id="chat" class="nav-elements" >&nbsp<span class="glyphicon glyphicon-comment"></span> <span class="nav-span">Chat</span></div></a>
</div>

<!--Edit-Profile-->
<div class="container">
    <div id="form-div">
        <div class="panel panel-default" style="border-style: none">
            <div id="title" class="panel-heading"><h4>Chat with Administrators:</h4> </div>
            <div class="panel-body" id="">

            </div>
        </div>
    </div>

</div>
</body>
<script src="../lib/jquery-3.1.1.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../scripts/nav_click.js"></script>

<script>
    /*$(".nav-elements").hover(function(){
     if($(window).width()<="902")
     {
     console.log("hrllo");
     $(".nav-elements").stop(true,true);
     $(this).animate({width:'400%'},200, function () {
     $(this).children("span.nav-span").css("display", "inline");
     });
     }
     else
     {
     $(this).animate({width:'120%'},5000);
     }
     },function(){
     if($(window).width()<="902")
     {
     $(this).children("span.nav-span").css("display", "none");
     $(this).animate({width:"100%"},10);
     }
     else
     {
     // $(this).animate({width:'100%'},10);
     }
     });*/
</script>

<!--Nav bar Animation-->
<script>
    var f = "Chat";
    console.log(f);
    $(".nav-elements").hover(function () {
        console.log($(this).children("span.nav-span").text());
        if($(window).width()>="902") {
            //console.log("Mouse on Chat")
            $(".nav-elements").stop(false, true);
            $(this).animate({width: "130%"}, 500);
            $(this).css({'z-index':'1'});
        }
        else{
            $(this).css({'width': "400%",'z-index':"1"});
        }
    }, function () {
        if($(window).width()>="902") {
            //console.log("Mouse off  Chat")
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




    /*Used when page opened and then resized*/
    $(window).resize(function(){
        if($(window).width()<="902") {  //For the element which is clicked
            $("#chat").css({
                "height": "50px",
                'width': '400%',
                'z-index': '0'
            });
        }
        else
        {
            $("#chat").css({
                'width': '130%',
                'z-index': '0',
                'height': '75px'
            });
        }
    });
</script>


</html>