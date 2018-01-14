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
    $gender=$_SESSION['gender'];

    if(isset($_POST['saveChanges'])){
        if($_POST['password']<>NULL){
            if($_POST['password']<>$_POST['cnfPassword']){
                $errMsg="Passwords do not match";
            }
        }
        if($_POST['firstName']==NULL){
            $errMsg="First name is required";
        }
        if($_POST['mobileNo']<>$mobileNo){
            if($_POST['mobileNo']==NULL){
                $errMsg="Mobile number is required";
            }
            else{
                if(strlen($_POST['mobileNo'])<>10){
                    $errMsg="Enter 10 digit mobile number";
                }
                else{
                    require_once '../core/config.php';
                    $sql="SELECT * FROM employeeInfo WHERE mobileNo='".$_POST['mobileNo']."'";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $errMsg="Entered mobile number already exists";
                    }
                    else{
                        require_once '../core/config.php';
                        $sql="SELECT * FROM studentInfo WHERE mobileNo='".$_POST['mobileNo']."'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                            $errMsg="Entered mobile number already exists";
                        }
                    }
                }
            }
        }
        if($_POST['post']==NULL){
            $errMsg="Post is required";
        }
        if($_POST['address']==NULL){
            $errMsg="Address is required";
        }
        //all checked
        if($errMsg==NULL){
            require_once '../core/config.php';
            if($_POST['password']<>NULL){
                $sql="UPDATE employeeInfo SET password='".$_POST['password']."', firstName='".$_POST['firstName']."', lastName='".$_POST['lastName']."', mobileNo='".$_POST['mobileNo']."', post='".$_POST['post']."', address='".$_POST['address']."' WHERE employeeId='".$employeeId."'";
                if(mysqli_query($conn,$sql)){
                    $successMsg="Changes saved successfully";
                    $_SESSION['firstName']=$_POST['firstName'];$_SESSION['lastName']=$_POST['lastName'];$_SESSION['mobileNo']=$_POST['mobileNo'];$_SESSION['address']=$_POST['address'];$_SESSION['post']=$_POST['post'];
                    $firstName=$_SESSION['firstName'];$lastName=$_SESSION['lastName'];$mobileNo=$_SESSION['mobileNo'];$address=$_SESSION['address'];$post=$_SESSION['post'];
                }
                else{
                    $errMsg="Error updating record: " . mysqli_error($conn);
                }

            }
            else{
                $sql="UPDATE employeeInfo SET firstName='".$_POST['firstName']."', lastName='".$_POST['lastName']."', mobileNo='".$_POST['mobileNo']."', post='".$_POST['post']."' WHERE employeeId='".$employeeId."'";
                if(mysqli_query($conn,$sql)){
                    $successMsg="Changes saved successfully";
                    $_SESSION['firstName']=$_POST['firstName'];$_SESSION['lastName']=$_POST['lastName'];$_SESSION['mobileNo']=$_POST['mobileNo'];$_SESSION['address']=$_POST['address'];$_SESSION['post']=$_POST['post'];
                    $firstName=$_SESSION['firstName'];$lastName=$_SESSION['lastName'];$mobileNo=$_SESSION['mobileNo'];$address=$_SESSION['address'];$post=$_SESSION['post'];
                }
                else{
                    $errMsg="Error updating record: " . mysqli_error($conn);
                }
            }
            // $sql="UPDATE studentInfo SET firstName='".$firstName."'' WHERE regNo='".$regNo."'";
        }
        else{

        }
    }
    else{

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
    <link rel="stylesheet" href="../stylesheets/edit_profile.css">
    <script src="../lib/jquery-3.1.1.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>


    <!--Clicked element styling-->
    <style>
        #edit {  /*When clicked and opened (without resizing)*/
            width: 130%;
            z-index: 0;
            height: 75px;
        }
        @media screen and  (max-width:902px){
            #edit{
                height:50px;
                width:400%;
                z-index:0;
            }
            #edit:hover{
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
    <div id="name-reg"  align="center"><?php echo $firstName." ".$lastName."(Admin)";?><br><?php echo $employeeId;?></div>

</div>

<div class="header"> <!--Heading-->
    <img src="../images/logo.jpg" id="logo" title="Complainica">
    <div id="heading">Hi,<?php echo $firstName;?>!!</div>
    <!--        <button class="btn btn-info" id="logout">Logout&nbsp<span class="glyphicon glyphicon-log-out"></span> </button>-->
    <a href="logout.php" id="logout" title="Logout">Logout&nbsp;<span class="glyphicon glyphicon-log-out" title="Logout" style="text-decoration: underline"></span> </a>
    <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right" title="MNNIT">
</div>

<div id="nav-bar">
    <a href="#" ><div id="edit" class="nav-elements">&nbsp <span class="glyphicon glyphicon-pencil"></span> <span class="nav-span">Edit Profile</span> </div></a>

    <a href="admin_filed_complains.php" ><div id="filedC" class="nav-elements" >&nbsp<span class="glyphicon glyphicon-time"> </span> <span class="nav-span">Filed Complains</span></div></a>

    <a href="acoming_soon.php" ><div id="chat" class="nav-elements" >&nbsp<span class="glyphicon glyphicon-comment"></span> <span class="nav-span">Chat</span></div></a>
</div>
<!--Edit-Profile-->
<div class="container">
    <div id="form-div">
        <div class="panel panel-default" style="border-style: none">
            <div id="title" class="panel-heading"><h4>Edit Your Profile:</h4> </div>
            <div class="panel-body" id="reg-form">
                <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >

                    <?php
                    if(isset($_POST['saveChanges'])){
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
                    <div class="form-group">
                        <label class="control-label col-md-3 " for="password">New Password:</label>
                        <div class="col-md-7">
                            <input class="form-control"  type="password"  name="password" id="password" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="cnf-password">Confirm Password:</label>
                        <div class="col-md-7">
                            <input class="form-control"  type="password"  name="cnfPassword" id="cnf-password" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="first-name">First Name:<span class="asterisk">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control"  type="text"  name="firstName" id="first-name"  value="<?php echo $firstName; ?>" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="last-name">Last Name:</label>
                        <div class="col-md-7">
                            <input class="form-control"  type="text"  name="lastName" id="last-name"  value="<?php echo $lastName;?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="employee-id">Employee Id:</label>
                        <div class="col-md-3">
                            <input class="form-control"  type="text"  name="employeeId" id="employee-id" value="<?php echo $employeeId;?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="depart">Department:</label>
                        <div class="col-md-3">
                            <input class="form-control"  type="text"  name="department" id="depart" value="<?php echo $department;?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="post">Post:<span class="asterisk">*</span></label>
                        <div class="col-md-5">
                            <input class="form-control"  type="text"  name="post" id="post" value="<?php echo $post;?>" >
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 " for="year-join">Year of Joining:</label>
                        <div class="col-md-3">
                            <input class="form-control"  type="text"  name="year" disabled id="year-join" value="<?php echo $year;?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="mobile-no">Mobile Number:<span class="asterisk">*</span></label>
                        <div class="col-md-4">
                            <input class="form-control"  type="text"  name="mobileNo" id="mobile-no"  value="<?php echo $mobileNo;?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="gender">Gender:</label>
                        <div class="col-md-5">
                            <label class="radio-inline" id="gender-male" ><input type="radio" disabled name="gender" <?php if($gender==="male"){ echo 'checked="checked"';} ?> value="1"  disabled>&nbspMale</label>
                            <label class="radio-inline" id="gender-female"><input type="radio" disabled name="gender" <?php if($gender==="female"){ echo 'checked="checked"';} ?> value="2" disabled>&nbspFemale</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="address">Address:<span class="asterisk">*</span></label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="8" id="address" name="address" maxlength="300"><?php echo $address;?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class=" col-md-offset-2">
                            <br>
                            <input type="submit" id="reg-btn" class="btn btn-info" value="Save Changes" name="saveChanges">
                            <button id="reset-btn" class="btn btn-info" type="reset">Reset</button>  <!--Used a function because needed to reset <select> appropriately-->
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

</div>
</body>
<script src="../lib/jquery-3.1.1.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../scripts/nav_click.js"></script>
<!-- <script src="../scripts/form-editting.js"></script> -->
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

<!--Form Script-->
<script>  // Java Script for editing form
    function decideYear()
    {
        var currYear=(new Date).getFullYear();
        console.log(currYear);
        for(var i=currYear;i>1961&&i>currYear-50;i--)
        {
            $("#year-join").append('<option>'+i+'</option>');
        }
    }
    // decideYear();

  /*  function reset_form(){
        $("form").get(0).reset();
    }*/
</script>

<!--Nav bar Animation-->
<script>
    var f = "Edit Profile";

    $(".nav-elements").hover(function () {
        if($(window).width()>="902") {
            console.log("Mouse on Edit Profile.")
            $(".nav-elements").stop(false, true);
            $(this).animate({width: "130%"}, 500);
            $(this).css({'z-index':'1'});
        }
        else{
            $(this).css({'width': "400%",'z-index':"1"});
        }
    }, function () {
        if($(window).width()>="902") {
            console.log("Mouse off Edit Profile.")
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
            $("#edit").css({
                "height": "50px",
                'width': '400%',
                'z-index': '0'
            });
        }
        else
        {
            $("#edit").css({
                'width': '130%',
                'z-index': '0',
                'height': '75px'
            });
        }
    });
</script>


</html>