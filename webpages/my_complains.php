<!--Complainica Student Dashboard Page-->
<!--By:iLLuMinaTi-->
<?php 
    session_start();
    require_once '../core/init.php';
    $errMsg="";
    $successMsg="";
    if(isset($_SESSION['regNo']) || (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=="no")){
        $email=$_SESSION['email'];
        if(isset($_POST['yesButton'])){
            require_once '../core/config.php';
            $sql="DELETE FROM complainInfo WHERE complainId='".$_POST['id']."'";
            if(mysqli_query($conn,$sql)){
                $successMsg="Complain deleted successfully.";
            }
            else{
                $errMsg="Sorry unable to delete right now.";
            }
        }
    }
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
    <link rel="stylesheet" href="../stylesheets/my_complains.css">
    <script src="../lib/jquery-3.1.1.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../scripts/nav_click.js"></script>

    <!--Clicked element styling-->
    <style>
        #pastC {  /*When clicked and opened (without resizing)*/
            width: 130%;
            z-index: 0;
            height: 75px;
        }
        @media screen and  (max-width:902px){
            #pastC{
                height:50px;
                width:400%;
                z-index:0;
            }
            #pastC:hover{
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
                $("#suc-msg").animate({height:'0'},400);
            });
       }
       function fadeTrans1()
       {
            console.log("Here");
            $("#error-msg").animate({opacity:'0'},5000,function(){
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
    <a href="logout.php" id="logout" title="Logout">Logout&nbsp<span class="glyphicon glyphicon-log-out" title="Logout" style="text-decoration: underline"></span> </a>
    <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right" title="MNNIT">
</div>

<div id="nav-bar">
    <a href="<?php if(isset($_SESSION['regNo'])){ echo "edit_profile.php";} else{ echo "employee_edit_profile.php";}?>" ><div id="edit" class="nav-elements">&nbsp;<span class="glyphicon glyphicon-pencil"></span> <span class="nav-span">Edit Profile</span> </div></a>

    <a href="new_complain.php"> <div id="newC" class="nav-elements">&nbsp;<span class="glyphicon glyphicon-plus-sign"></span> <span class="nav-span">New Complain</span> </div> </a>

    <a href="#" ><div id="pastC" class="nav-elements" >&nbsp;<span class="glyphicon glyphicon-time"></span> <span class="nav-span">My Complains</span></div></a>

    <a href="coming_soon.php" ><div id="chat" class="nav-elements" >&nbsp;<span class="glyphicon glyphicon-comment"> </span><span class="nav-span">Chat</span></div></a>
</div>

<div class="container">
    <div id="form-div">
        <div class="panel panel-default" style="border-style: none">
            <div id="title" class="panel-heading"><h4>Your Complains:</h4> </div>
            <?php
                if(isset($_POST['yesButton'])){
                    if($errMsg<>NULL){
                        echo '<div class="alert alert-danger" id="error-msg">';
                        echo $errMsg;
                        echo '</div><script> fadeTrans1() </script>';
                    }
                    else if($successMsg<>NULL){
                        echo '<div class="alert alert-success" id="suc-msg">';
                        echo $successMsg;
                        echo '</div><script> fadeTrans() </script>';
                    }
                }
            ?>
            <div class="panel-body" id="my-complain-panel">
                <div id="my-complain-div">
                    <div id="full">

                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active" id="pending-tab"><a data-toggle="tab" href="#pending-comp">Pending</a></li>
                        <li id="past-tab"><a data-toggle="tab" href="#past-comp">Past</a></li>
                    </ul>

                    <div id="tab-body" class="tab-content">

<!--                        Pending Complains-->

                        <div id="pending-comp" class="tab-pane fade active">
                            <div class="panel-group" id="pending-accordion">

<!--                               Here Complain Accordions will show up by javascript-->
                                <?php
                                require_once '../core/config.php';
                                $pendingComplains=array();
                                $sql="SELECT * FROM complainInfo WHERE `email`='$email' AND `status`='Pending' ORDER BY `date` DESC";
                                $result=mysqli_query($conn,$sql);
                                $i=1;
                                if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_assoc($result)) {
                                        foreach ($row as $key => $value) {
                                            $pendingComplains[$key] = $value;
                                        } ?>

                                        <div class="panel panel-default">
                                            <div class="panel-heading comp-head">
                                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#pending-accordion" href="#c<?php echo $i; ?>">
                                                        <div class="c-head-div" id="hc"<?php echo $i; ?>>
                                                            <div
                                                                class="sub-head"><?php echo $pendingComplains['subject']; ?></div>
                                                            <span
                                                                class="time"><?php echo $pendingComplains['date']; ?></span>
                                                        </div>
                                                    </a></h4>
                                            </div>
                                            <div id="c<?php echo $i; ?>" class="panel-collapse collapse ">
                                                <div class="panel-body comp-desc">
                                                    <form class="form-horizontal" id="comp-desc-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                        <div class="form-group"><label class="control-label col-md-3">Area
                                                                of Complain:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static">
                                                                &nbsp;&nbsp;<?php echo $pendingComplains['area']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Complain
                                                                Type:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static">
                                                                &nbsp;&nbsp;<?php echo $pendingComplains['type']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Description:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static desc">
                                                                &nbsp;&nbsp;<?php echo $pendingComplains['particulars']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Available Time:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static">
                                                                &nbsp;&nbsp;<?php echo $pendingComplains['startTime']; ?> to <?php echo $pendingComplains['endTime']; ?></p>
                                                            </div>
                                                            </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Item
                                                                needs to be :</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static">
                                                                &nbsp;&nbsp;<?php echo $pendingComplains['need']; ?></p>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id" value="<?php echo $pendingComplains['complainId']; ?>">
                                                        <button type="button" class="btn btn-danger solve-btn" name="delete" id="delete-btn-<?php echo $i; ?>">Delete Complain
                                                        </button>
                                                        <div class="confirm-div">
                                                            <div class="msg" align="center">Are you sure you want to
                                                                delete the complaint?
                                                            </div>
                                                            <button type="submit" class="btn btn-success cnf-btn" name="yesButton">Yes</button>
                                                            <button type="button" class="btn btn-danger can-btn" name="noButton">No</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i = $i + 1;
                                    }
                                }
                                else{
                                    ?>
                                    <div> <div class="jumbotron" id="no-complain"><h2>No pending complains.. :-)</h2></div></div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>

<!--                        Past Complains-->

                        <div id="past-comp" class="tab-pane fade">
                            <div class="panel-group" id="past-accordion">

                                <!-- Here  past accordions will be printed by javascript-->
                                <?php
                                require_once '../core/config.php';
                                $pastComplains=array();
                                $sql="SELECT * FROM complainInfo WHERE `email`='$email' AND `status`='Resolved' ORDER BY `date` DESC";
                                $result=mysqli_query($conn,$sql);
                                $i=1;
                                if(mysqli_num_rows($result)>0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        foreach ($row as $key => $value) {
                                            $pastComplains[$key] = $value;
                                        } ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading comp-head">
                                                <h4 class="panel-title"><a data-toggle="collapse"
                                                                           data-parent="#past-accordion"
                                                                           href="#pc<?php echo $i; ?>">
                                                        <div class="c-head-div" id="hpc<?php echo $i; ?>">
                                                            <div
                                                                class="sub-head"><?php echo $pastComplains['subject']; ?></div>
                                                            <span
                                                                class="time"><?php echo $pastComplains['date']; ?></span>
                                                        </div>
                                                    </a></h4>
                                            </div>
                                            <div id="pc<?php echo $i; ?>" class="panel-collapse collapse">
                                                <div class="panel-body comp-desc">
                                                    <form class="form-horizontal" id="comp-desc-form">
                                                        <div class="form-group"><label class="control-label col-md-3">
                                                                Resolved on:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['resolvedDate']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Area
                                                                of Complain:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['area']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Complain
                                                                Type:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['type']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Description:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['particulars']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Available Time:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['startTime']; ?> to <?php echo $pastComplains['endTime']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Item
                                                                needs to be :</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['need']; ?></p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i = $i + 1;
                                    }
                                }
                                else{
                                    ?>
                                    <div> <div class="jumbotron" id="no-complain"><h2><span></span>Oops.. No resolved complains yet!!</h2></div></div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>

                    </div>


            </div>
        </div>
    </div>



</div>
    </div>
</body>

<script>

    function print_pending()
    {



    }

    function print_past()
    {

    }

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
<!--Confirm_Submission-->
<script>
    $(".solve-btn").click(function(){
        $("#full").css("display", "block");
        $("#full").animate({"opacity": "0.6"}, 100, function () {
            $(".confirm-div").css("display", "block");

        });
        $(".confirm-div").animate({"left": "35%"}, 200);
    });


    $(".can-btn").click(function(){
        $(".confirm-div").animate({"left":"-30%"},200,function(){
            $(".confirm-div").css({"display":"none"});
            $("#full").animate({"opacity":"0"},10);
            $("#full").css({"display":"none"});
        });
    });
</script>
<!--Nav bar Animation-->
<script>
    var f = "My Complains";
    console.log(f);
    $(".nav-elements").hover(function () {
        console.log($(this).children("span.nav-span").text());
        if($(window).width()>="902") {
            //console.log("Mouse on  Past Complains.")
            $(".nav-elements").stop(false, true);
            $(this).animate({width: "130%"}, 500);
            $(this).css({'z-index':'1'});
        }
        else{
            $(this).css({'width': "400%",'z-index':"1"});
        }
    }, function () {
        if($(window).width()>="902") {
            //console.log("Mouse off  Past Complain")
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
            $("#pastC").css({
                "height": "50px",
                'width': '400%',
                'z-index': '0'
            });
        }
        else
        {
            $("#pastC").css({
                'width': '130%',
                'z-index': '0',
                'height': '75px'
            });
        }
    });
</script>


</html>