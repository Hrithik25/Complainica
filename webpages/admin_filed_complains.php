<!--Complainica Student Dashboard Page-->
<!--By:iLLuMinaTi-->
<?php 
    session_start();
    require_once '../core/init.php';
    $successMsg="";
    $errMsg="";
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=="yes"){
        $firstName=$_SESSION['firstName'];
        $lastName=$_SESSION['lastName'];
        $email=$_SESSION['email'];
        $employeeId=$_SESSION['employeeId'];
        $year=$_SESSION['year'];
        $mobileNo=$_SESSION['mobileNo'];
        $address=$_SESSION['address'];
        $department=$_SESSION['department'];
        $division=$_SESSION['division'];
        $post=$_SESSION['post'];
        if(isset($_POST['solved'])){
            require_once '../core/config.php';
            $date = date_default_timezone_set('Asia/Kolkata');
            $date=date('Y-m-d');
            $sql="UPDATE complainInfo SET `status`='Resolved', `resolvedDate`='$date' WHERE complainId='".$_POST['id']."'";
            if(mysqli_query($conn,$sql)){
                $successMsg="Complain marked as resolved.";
            }
            else{
                $errMsg="Sorry, unable to mark it as resolved.";
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
    <title> My Profile(Admin)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../stylesheets/header.css">
    <link rel="stylesheet" href="../stylesheets/student_profile.css">
    <link rel="stylesheet" href="../stylesheets/content_frame.css">
    <link rel="stylesheet" href="../stylesheets/info_filed_comp.css">
    <link rel="stylesheet" href="../stylesheets/my_complains.css">
    <script src="../lib/jquery-3.1.1.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../scripts/nav_click.js"></script>

    <!--Clicked element styling-->
    <style>
        #filedC {  /*When clicked and opened (without resizing)*/
            width: 130%;
            z-index: 0;
            height: 75px;
        }
        @media screen and  (max-width:902px){
            #filedC{
                height:50px;
                width:400%;
                z-index:0;
            }
            #filedC:hover{
                z-index: 1;
            }
        }
    </style>

</head>
<body>

<!--    Fade Trans-->
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

<!--    Show or Hide Info-->
    <script>
          var counter=1;
          var isEmp=[]; //isEmp[counter++]=1 if employee...
          var i=1;
    </script>
<img  id="bg" src="../images/grad-1.jpg"> <!--background-->
<div id="dp" >
    <img src="../images/icon2.png" id="dp_img" alt="user-icon" title="Your Profile Picture">
    <div id="name-reg"  align="center"><?php echo $firstName." ".$lastName."(Admin)";?><br><?php echo $employeeId;?></div>

</div>

<div class="header"> <!--Heading-->
    <img src="../images/logo.jpg" id="logo" title="Complainica">
    <div id="heading">Hi,<?php echo $firstName;?>!!</div>
    <!--        <button class="btn btn-info" id="logout">Logout&nbsp<span class="glyphicon glyphicon-log-out"></span> </button>-->
    <a href="logout.php" id="logout" title="Logout">Logout&nbsp<span class="glyphicon glyphicon-log-out" title="Logout" style="text-decoration: underline"></span> </a>
    <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right" title="MNNIT">
</div>

<div id="nav-bar">
    <a href="admin_edit_profile.php" ><div id="edit" class="nav-elements">&nbsp <span class="glyphicon glyphicon-pencil"></span> <span class="nav-span">Edit Profile</span> </div></a>

    <a href="#" ><div id="filedC" class="nav-elements" >&nbsp<span class="glyphicon glyphicon-time"></span> <span class="nav-span">Filed Complains</span></div></a>

    <a href="coming_soon.php" ><div id="chat" class="nav-elements" >&nbsp<span class="glyphicon glyphicon-comment"> </span><span class="nav-span">Chat</span></div></a>
</div>

<div class="container">
    <div id="form-div">
        <div class="panel panel-default" style="border-style: none">
            <div id="title" class="panel-heading"><h4>Your Complains:</h4> </div>

            <?php
                if(isset($_POST['solved'])){
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

            <div class="panel-body" id="filed-complain-panel">
                <div id="my-complain-div">
                    <div id="full">

                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active" id="pending-tab"><a data-toggle="tab" href="#pending-comp">Pending</a></li>
                        <li id="past-tab"><a data-toggle="tab" href="#past-comp">Past</a></li>
                    </ul>

                    <div id="tab-body" class="tab-content">

                        <!--                        Pending Complains-->

                        <div id="pending-comp" class="tab-pane fade in active">
                            <div class="panel-group" id="pending-accordion">


                                <?php
                                require_once '../core/config.php';
                                require_once '../functions/branchConvert.php';
                                $pendingComplains=array();
                                $sql="SELECT * FROM complainInfo WHERE `type`='$division' AND `status`='Pending' ORDER BY `date` DESC";
                                $result=mysqli_query($conn,$sql);
                                $i=1;
                                

                                if(mysqli_num_rows($result)>0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    //storing the values in an array
                                        foreach ($row as $key => $value) {
                                            $pendingComplains[$key] = $value;
                                        } 
                                        $isEmp=0;
                                        $email=$pendingComplains['email'];
                                        $sql1="SELECT * FROM studentInfo WHERE email='".$email."'";
                                        $result1 = mysqli_query($conn, $sql1);
                                        if(mysqli_num_rows($result1)>0){
                                            $isEmp=0;
                                            ?>
                                            <script>
                                                isEmp[counter]=0; //isEmp[counter++]=1 if employee...
                                                counter++;                                                
                                            </script>
                                            <?php     
                                        }        
                                        else{
                                            $isEmp=1;
                                            ?>
                                            <script>
                                                isEmp[counter]=1; //isEmp[counter++]=1 if employee...
                                                counter++;                                                
                                            </script>
                                            <?php
                                        }                       
                                        
                                        if($isEmp==0){
                                            $sql2="SELECT * FROM studentInfo WHERE email='".$email."'";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $row2 = mysqli_fetch_assoc($result2);                                           
                                        }
                                        else{
                                            $sql2="SELECT * FROM employeeInfo WHERE email='".$email."'";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $row2 = mysqli_fetch_assoc($result2);
                                        }


                                        ?>

                                        <div class="panel panel-default">
                                            <div class="panel-heading comp-head">
                                                <h4 class="panel-title"><a data-toggle="collapse"
                                                                           data-parent="#pending-accordion"
                                                                           href="#c<?php echo $i; ?>">
                                                        <div class="c-head-div" id="hc<?php echo $i; ?>">
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
                                                        <div class="form-group"><label class="control-label col-md-3">Area of Complain:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pendingComplains['area']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Complain
                                                                Type:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pendingComplains['type']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Description:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static desc"><?php echo $pendingComplains['particulars']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Available Time:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pendingComplains['startTime']; ?> to <?php echo $pendingComplains['endTime']; ?></p>
                                                            </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-3">Item needs to be :</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pendingComplains['need']; ?></p>
                                                        </div>
                                                            </div>

                                                        <input type="hidden" name="id" value="<?php echo $pendingComplains['complainId']; ?>">

                                                            <button type="button" name="info" class="btn btn-info info-btn" id="info-btn-<?php echo $i; ?>">Complainer's Info
                                                        </button>
                                                            <button type="submit" name="print" class="btn btn-danger print-btn" formaction="print_complains.php?cid=<?php echo $pendingComplains['complainId']; ?>"  id="print-btn-<?php echo $i; ?>">
                                                                Print it
                                                            </button>
                                                            <button type="submit" name="solved" class="btn btn-success solve-btn" id="solve-btn-<?php echo $i; ?>">Mark it Solved
                                                            </button>

<!--                                                        Student-Info-Div-->

                                                        <div class=" student-info info-div">
                                                            <div  class="info-head">
                                                                <h3>Student's Info</h3>
                                                            </div>
                                                            <form class="form-horizontal stud-info-form">
                                                            <div class="form-group"><label class="control-label col-md-4">Name:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['firstName']." ".$row2['lastName'];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4 ">Registration No.:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['regNo'];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4 ">Program:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['program'];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4">Branch:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static desc"><?php $x=$row2['branch']; echo $branchName[$x];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4">Year:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['year'];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4">Gender:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['gender'];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4">Mobile No:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['mobileNo'];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4">Hostel:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['hostel'];?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="control-label col-md-4">Room No:</label>
                                                                <div class="col-md-7">
                                                                    <p class="form-control-static"><?php echo $row2['roomNo'];?></p>
                                                                </div>
                                                            </div>
                                                                <button type="button" class="btn btn-danger back-btn">Back</button>
                                                            </form>
                                                        </div>



<!--                                                        Employee-Info-Div-->
                                                        <div class="employee-info info-div">
                                                            <div  class="info-head">
                                                                <h3>Employee's Info</h3>
                                                            </div>
                                                            <form class="form-horizontal emp-info-form">
                                                                <div class="form-group"><label class="control-label col-md-4">Name:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static"><?php echo $row2['firstName']." ".$row2['lastName'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"><label class="control-label col-md-4 ">Employee Id:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static"><?php echo $row2['employeeId'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"><label class="control-label col-md-4 ">Department:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static"><?php echo $row2['department'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"><label class="control-label col-md-4">Post:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static"><?php echo $row2['post'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"><label class="control-label col-md-4">Year of join:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static"><?php echo $row2['year'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"><label class="control-label col-md-4">Gender:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static"><?php echo $row2['gender'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"><label class="control-label col-md-4">Mobile No:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static"><?php echo $row2['mobileNo'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"><label class="control-label col-md-4">Address:</label>
                                                                    <div class="col-md-7">
                                                                        <p class="form-control-static desc"><?php echo $row2['address'];?></p>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-danger back-btn">Back</button>
                                                            </form>
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
                                    <div> <div class="jumbotron" id="no-complain"><h2>Congrats.. No filed complains :-)</h2></div></div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!--                        Past Complains-->

                        <div id="past-comp" class="tab-pane fade">
                            <div class="panel-group" id="past-accordion">

                                <?php
                                require_once '../core/config.php';
                                $pastComplains=array();
                                $sql="SELECT * FROM complainInfo WHERE `type`='$division' AND `status`='Resolved' ORDER BY `date` DESC";
                                $result=mysqli_query($conn,$sql);
                                $i=1;
                                if(mysqli_num_rows($result)>0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        foreach ($row as $key => $value) {
                                            $pastComplains[$key] = $value;
                                        } ?>

                                        <div class="panel panel-default">
                                            <div class="panel-heading comp-head">
                                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#past-accordion" href="#pc<?php echo $i; ?>">
                                                        <div class="c-head-div" id="hpc<?php echo $i; ?>">
                                                            <div class="sub-head"><?php echo $pastComplains['subject']; ?></div>
                                                            <span
                                                                class="time"><?php echo $pastComplains['date']; ?></span>
                                                        </div>
                                                    </a></h4>
                                            </div>
                                            <div id="pc<?php echo $i; ?>" class="panel-collapse collapse">
                                                <div class="panel-body comp-desc">
                                                    <form class="form-horizontal" id="comp-desc-form"  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                        <div class="form-group"><label class="control-label col-md-3">Resolved on:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['resolvedDate']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Area of Complain:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['area']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Complain Type:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['type']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Description:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static desc"><?php echo $pastComplains['particulars']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Available
                                                                Time:</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['startTime']; ?> to <?php echo $pastComplains['endTime']; ?></p>
                                                            </div>
                                                            </div>
                                                        <div class="form-group"><label class="control-label col-md-3">Item needs to be :</label>
                                                            <div class="col-md-7">
                                                            <p class="form-control-static"><?php echo $pastComplains['need']; ?></p>
                                                            </div>
                                                        </div>
                                                        <button type="submit" name="printP" class="btn btn-danger print-btn"  formaction="print_complains.php?cid=<?php echo $pastComplains['complainId']; ?>"  id="printP-btn-<?php echo $i; ?>">
                                                            Print it<?php //echo $pastComplains['complainId']; ?>
                                                        </button>
                                                    </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i = $i + 1;
                                    }
                                }
                                else{
                                    ?>
                                    <div> <div class="jumbotron" id="no-complain"><h2>Oops.. No resolved complains..</h2></div></div>
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
</body>

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
    var f = "Filed Complains";
    console.log(f);

    $(".nav-elements").hover(function () {
        console.log($(this).children("span.nav-span").text());
        if($(window).width()>="902") {
            //console.log("Mouse on  Filed Complains.")
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
            $("#filedC").css({
                "height": "50px",
                'width': '400%',
                'z-index': '0'
            });
        }
        else
        {
            $("#filedC").css({
                'width': '130%',
                'z-index': '0',
                'height': '75px'
            });
        }
    });
</script>

<script>
    $(".info-btn").click(function(){

        var id=$(this).attr("id");
        var index=parseInt(id.substring(9));
        console.log(index);
        $("#full").css("display", "block");
        $("#full").animate({"opacity": "0.6"}, 100, function () {
            if(!isEmp[index])
            {
                $(".student-info").css("display", "block");
                console.log($(".student-info").find("p").eq(0).html());
            }
            else
                $(".employee-info").css("display", "block")
        });
        if(!isEmp[index])
        $(".student-info").animate({"top": "3%"}, 300);
        else
            $(".employee-info").animate({"top": "3%"}, 300);
    });


    $(".back-btn").click(function(){
        $(".info-div").animate({"top":"-100%"},300,function(){
            $(".info-div").css({"display":"none"});
            $("#full").animate({"opacity":"0"},10);
            $("#full").css({"display":"none"});
        });
    });
</script>


</html>