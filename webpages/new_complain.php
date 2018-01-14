<!--Complainica Student Dashboard Page-->
<!--By:iLLuMinaTi-->
<?php
    session_start();
    require_once '../core/init.php';
    $errorMsg="";
    $successMsg="";
    if(isset($_SESSION['regNo']) || (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=="no")){
        if(isset($_POST['yesButton'])){
            $email=$_SESSION['email'];
            $area=$_POST['area'];
            $type=$_POST['type'];
            $subject=trim($_POST['subject']);
            $particulars=trim($_POST['particulars']);
            $need=$_POST['need'];
            $startTime=$_POST['startTime'];
            $endTime=$_POST['endTime'];
            if($subject==NULL || $particulars==NULL || strlen($subject)>60 || strlen($particulars)>300 || $startTime==$endTime){
                $errorMsg="Failed to file complain";
            }
            else{
                $date = date_default_timezone_set('Asia/Kolkata');
                $date=date('Y-m-d');
                $status="Pending";
                require_once '../core/config.php';
                $sql="INSERT INTO complainInfo (`email`,`area`,`type`,`subject`,`particulars`,`need`,`date`,`startTime`,`endTime`,`status`) VALUES ('$email','$area','$type','$subject','$particulars','$need','$date','$startTime','$endTime','$status')";
                if (mysqli_query($conn, $sql)) {
                    $successMsg="Your complain has been filed successfully";
                }
                else{
                    $errorMsg="Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

        }
    }
    /*else if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=="no"){
        if(isset($_POST['yesButton'])){
            $email=$_SESSION['email'];
            $area=$_POST['area'];
            $type=$_POST['type'];
            $subject=trim($_POST['subject']);
            $particulars=trim($_POST['particulars']);
            $need=$_POST['need'];
            $startTime=$_POST['startTime'];
            $endTime=$_POST['endTime'];
            if($subject==NULL || $particulars==NULL || strlen($subject)>60 || strlen($particulars)>300 || $startTime==$endTime){
                $errorMsg="Failed to file complain";
            }
            else{
                $date = date_default_timezone_set('Asia/Kolkata');
                $date=date('Y-m-d');
                $status="Pending";
                require_once '../core/config.php';
                $sql="INSERT INTO complainInfo (`email`,`area`,`type`,`subject`,`particulars`,`need`,`date`,`startTime`,`endTime`,`status`) VALUES ('$email','$area','$type','$subject','$particulars','$need','$date','$startTime','$endTime','$status')";
                if (mysqli_query($conn, $sql)) {
                    $successMsg="Your complain has been filed successfully";
                }
                else{
                    $errorMsg="Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

        }

    }*/
    else{
        session_unset();
        session_destroy();
        header('Location:login-register.php');
        exit();
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title> My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../stylesheets/header.css">
    <link rel="stylesheet" href="../stylesheets/student_profile.css">
    <link rel="stylesheet" href="../stylesheets/content_frame.css">
    <link rel="stylesheet" href="../stylesheets/new_complain.css">
    <script src="../lib/jquery-3.1.1.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../scripts/nav_click.js"></script>
    <!-- <script src="../scripts/confirm_submission.js"></script> -->
    <!-- <script src="../scripts/new_comp_nav.js"></script> -->
    <style>  /*Used if page opened without resize*/
      #newC {
            width: 130%;
            z-index: 0;
            height: 65px;
        }
        @media screen and  (max-width:902px){
            #newC{
                height:50px;
                width:400%;
                z-index:0;
            }
            #newC:hover{
                z-index: 1;
            }
        }
    </style>
</head>
<body>

    <script>
       function fadeTrans()
       {
            console.log("Here");
            $("#suc-msg").animate({opacity:'0'},5000,function(){
                $("#suc-msg").css({'display':'none'});
                $("#suc-msg").animate({height:'0'},500);
            });
       }
       function fadeTrans1()
       {
            console.log("Here");
            $("#error-msg").animate({opacity:'0'},3000,function(){
                $("#error-msg").css({'display':'none'});
                $("#error-msg").animate({height:'0'},400);
            });
       }

    </script>

<img  id="bg" src="../images/grad-1.jpg"> <!--background-->
<div id="dp" >
    <img src="../images/icon2.png" id="dp_img" alt="user-icon" title="Your Profile Picture">
    <div id="name-reg"  align="center"><?php echo $_SESSION['firstName']." ".$_SESSION['lastName'];?><br><?php if(isset($_SESSION['regNo'])){echo $_SESSION['regNo'];}else{echo $_SESSION['employeeId'];} ?></div>

</div>

<div class="header"> <!--Heading-->
    <img src="../images/logo.jpg" id="logo" title="Complainica">
    <div id="heading">Hi,<?php echo $_SESSION['firstName'];?>!!</div>
    <!--        <button class="btn btn-info" id="logout">Logout&nbsp<span class="glyphicon glyphicon-log-out"></span> </button>-->
    <a href="logout.php" id="logout" title="Logout">Logout&nbsp;<span class="glyphicon glyphicon-log-out" title="Logout" style="text-decoration: underline"></span> </a>
    <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right" title="MNNIT">
</div>

<div id="nav-bar">
    <a href="<?php if(isset($_SESSION['regNo'])){ echo "edit_profile.php";} else{ echo "employee_edit_profile.php";}?>" ><div id="edit" class="nav-elements">&nbsp; <span class="glyphicon glyphicon-pencil"></span> <span class="nav-span">Edit Profile</span> </div></a>
    <a href="#"> <div id="newC" class="nav-elements">&nbsp; <span class="glyphicon glyphicon-plus-sign"></span> <span class="nav-span">New Complain</span> </div>
        <a href="my_complains.php" ><div id="pastC" class="nav-elements" >&nbsp;<span class="glyphicon glyphicon-time"></span> <span class="nav-span">My Complains</span></div></a>
        <a href="coming_soon.php" ><div id="chat" class="nav-elements" >&nbsp;<span class="glyphicon glyphicon-comment"></span> <span class="nav-span">Chat</span></div></a>
</div>

<!--New Complain-->
<div class="container">
    <div id="form-div">
        <div class="panel panel-default" style="border-style: none">
            <div id="title" class="panel-heading"><h4>Lodge A New Complain:</h4> </div>
            <div class="panel-body" id="new-complain-form">
                <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >

                    <?php
                        if(isset($_POST['yesButton'])){
                            if($errorMsg<>NULL){
                                echo '<div class="alert alert-danger" id="error-msg">';
                                echo $errorMsg;
                                echo '</div><script> fadeTrans1() </script>';
                            }
                            else if($successMsg<>NULL){
                                echo '<div class="alert alert-success" id="suc-msg">';
                                echo $successMsg;
                                echo '</div><script> fadeTrans() </script>';
                            }
                        }
                    ?>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="area">Area of Complain:</label>
                        <div class="col-md-6">
                            <select class="form-control" id="area" name="area">
                                <option>Academics</option>
                                <option>Hostel</option>
                                <option>Colony</option>
                            </select>
                        </div>
                    </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="type">Complain Type:</label>
                            <div class="col-md-6">
                                <select class="form-control" id="type" name="type">
                                    <option value="Civil">Civil (Related to Infrastructure)</option>
                                    <option value="Electrical">Electrical (Related to electronic appliances)</option>
                                    <option value="Green Campus">Green Campus (Related to Hygiene and Cleanliness)</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="subject">Subject:</label>
                        <div class=col-md-6>
                            <input type="text" required name="subject" class="form-control" id="subject" maxlength="60">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="description">Particulars of Complain:</label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="8" id="description" name="particulars" maxlength="300"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Time of your Availability:</label>
                        <div class="col-md-7"></div>
                            <p class="form-control-static"></p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-3 control-label" for="ftime">From:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control" id="ftime" name="startTime">
                               <option>12:00 am</option>

                            </select>
                            </div>
                        </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-3 control-label" for="ttime">To:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control" id="ttime" name="endTime">
                                <option>12:00 am</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="need">Item needs to be:</label>
                        <div class="col-md-7" id="need">
                            <label class="radio-inline" id="replaced"><input type="radio"   name="need"  checked ="checked" value="Repaired" >Repaired</label>
                            <label class="radio-inline" id="repaired"><input type="radio"  name="need" value="Replaced">Replaced</label>
                            <label class="radio-inline" id="NA"><input type="radio"  name="need" value="NA">NA</label>
                        </div>
                    </div>

                    <div class="alert alert-danger" id="error_msg">

                    </div>

                    <div class="form-group">
                        <div>
                            <br>
                            <button type="button" id="file-btn" class="btn btn-info" name="submitButton">File Complain</button>
                            <input type="reset" id="reset-btn" class="btn btn-info" value="Reset">
                        </div>
                    </div>
                    <div id="full">

                    </div>
                    <div id="confirm-div">
                        <div id="msg" align="center">Are you sure you want to file the complaint?</div>
                        <button type="submit" class="btn btn-success" id="cnf-btn" name="yesButton">Yes</button>
                        <button  type="button" class="btn btn-danger" id="can-btn" name="noButton">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>



</body>

<!--Nav Bar Animation-->
<script>


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
           // $(this).stop("",true,true);
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

</script>

<script>
    function time_op(selec)
    {

        for(var i=1;i<24;i++)
        {
            if(i<13)
            {
                if(i!=12)
                    if(i<10)
                        $(selec).append('<option >0'+i+':00 am</option>');
                    else
                        $(selec).append('<option>'+i+':00 am</option>');

                else
                    $(selec).append('<option>12:00 pm</option>');

            }
            else
            {
                if(i%12<10)
                    $(selec).append('<option>0'+i%12+':00 pm</option>');
                else
                    $(selec).append('<option>'+i%12+':00 pm</option>');
            }
        }
    }
</script>
<script>
            $("#file-btn").click(function(){
            if(isSafe()) {
            $("#full").css("display", "block");
            $("#full").animate({"opacity": "0.6"}, 100, function () {
            $("#confirm-div").css("display", "block");
            });
            $("#confirm-div").animate({"left": "35%"}, 200);
            }
            });


            $("#can-btn").click(function(){
            $("#confirm-div").animate({"left":"-30%"},200,function(){
            $("#confirm-div").css({"display":"none"});
                $("#full").animate({"opacity":"0"},10);
                $("#full").css({"display":"none"});
            });
            });


            function isSafe(){
            if($("#subject").val()=="")
            {
            $("#error_msg").show();
            $("#error_msg").html("<strong>Attention!!</strong> &nbsp;Subject cannot be left empty!");
            return 0;
            }
            if($("#description").val()=="")
            {
            $("#error_msg").show();
            $("#error_msg").html("<strong>Attention!!</strong>&nbsp;Particulars  of complain cannot be left empty!");
            return 0;
            }
            if($("#ftime").val()==$("#ttime").val())
            {
            $("#error_msg").show();
            $("#error_msg").html("<strong>Attention!!</strong>&nbsp;Time Cannot be Same!");
            return 0;
            }
            $("#error_msg").hide();
            return 1;
            }
            </script>

            <script>
                time_op("#ttime");
                time_op("#ftime");
</script>

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


</html>