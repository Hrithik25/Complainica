<!--Complainica Student Dashboard Page-->
<!--By:iLLuMinaTi-->
<?php
  session_start();
  require_once '../core/init.php';
  $successMsg="";
  $errMsg="";
  if(isset($_SESSION['regNo'])){
    $firstName=$_SESSION['firstName'];
    $lastName=$_SESSION['lastName'];
    $email=$_SESSION['email'];
    $regNo=$_SESSION['regNo'];
    $year=$_SESSION['year'];
    $mobileNo=$_SESSION['mobileNo'];
    $branch=$_SESSION['branch'];
    $gender=$_SESSION['gender'];
    $hostel=$_SESSION['hostel'];
    $roomNo=$_SESSION['roomNo'];
    $program=$_SESSION['program'];
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
                    $sql="SELECT * FROM studentInfo WHERE mobileNo='".$_POST['mobileNo']."'";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $errMsg="Entered mobile number already exists";
                    }
                }
            }
        }
        if($_POST['roomNo']==NULL){
            $errMsg="Room number is required";
        }
        //all checked
        if($errMsg==NULL){
            require_once '../core/config.php';
            if($_POST['password']<>NULL){
                $sql="UPDATE studentInfo SET password='".$_POST['password']."', firstName='".$_POST['firstName']."', lastName='".$_POST['lastName']."', branch='".$_POST['branch']."', year='".$_POST['year']."', mobileNo='".$_POST['mobileNo']."', hostel='".$_POST['hostel']."', roomNo='".$_POST['roomNo']."' WHERE regNo='".$regNo."'";
                if(mysqli_query($conn,$sql)){
                    $successMsg="Changes saved successfully";
                    $_SESSION['firstName']=$_POST['firstName'];$_SESSION['lastName']=$_POST['lastName'];$_SESSION['branch']=$_POST['branch'];$_SESSION['year']=$_POST['year'];$_SESSION['mobileNo']=$_POST['mobileNo'];$_SESSION['hostel']=$_POST['hostel'];$_SESSION['roomNo']=$_POST['roomNo'];
                    $firstName=$_SESSION['firstName'];$lastName=$_SESSION['lastName'];$email=$_SESSION['email'];$regNo=$_SESSION['regNo'];$year=$_SESSION['year'];$mobileNo=$_SESSION['mobileNo'];$branch=$_SESSION['branch'];$gender=$_SESSION['gender'];$hostel=$_SESSION['hostel'];$roomNo=$_SESSION['roomNo'];$program=$_SESSION['program'];
                }
                else{
                    $errMsg="Error updating record: " . mysqli_error($conn);
                }
                
            }
            else{
                $sql="UPDATE studentInfo SET firstName='".$_POST['firstName']."', lastName='".$_POST['lastName']."', branch='".$_POST['branch']."', year='".$_POST['year']."', mobileNo='".$_POST['mobileNo']."', hostel='".$_POST['hostel']."', roomNo='".$_POST['roomNo']."' WHERE regNo='".$regNo."'";
                if(mysqli_query($conn,$sql)){
                    $successMsg="Changes saved successfully";
                    $_SESSION['firstName']=$_POST['firstName'];$_SESSION['lastName']=$_POST['lastName'];$_SESSION['branch']=$_POST['branch'];$_SESSION['year']=$_POST['year'];$_SESSION['mobileNo']=$_POST['mobileNo'];$_SESSION['hostel']=$_POST['hostel'];$_SESSION['roomNo']=$_POST['roomNo'];
                    $firstName=$_SESSION['firstName'];$lastName=$_SESSION['lastName'];$email=$_SESSION['email'];$regNo=$_SESSION['regNo'];$year=$_SESSION['year'];$mobileNo=$_SESSION['mobileNo'];$branch=$_SESSION['branch'];$gender=$_SESSION['gender'];$hostel=$_SESSION['hostel'];$roomNo=$_SESSION['roomNo'];$program=$_SESSION['program'];
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
    <div id="name-reg"  align="center"><?php echo $firstName." ".$lastName?><br><?php echo $regNo?></div>

</div>

<div class="header"> <!--Heading-->
        <img src="../images/logo.jpg" id="logo" title="Complainica">
        <div id="heading">Hi,<?php echo $firstName;?>!!</div>
<!--        <button class="btn btn-info" id="logout">Logout&nbsp<span class="glyphicon glyphicon-log-out"></span> </button>-->
        <a href="logout.php" id="logout" title="Logout">Logout&nbsp;<span class="glyphicon glyphicon-log-out" title="Logout" style="text-decoration: underline"></span> </a>
        <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right" title="MNNIT">
</div>

<div id="nav-bar">
        <a href="#" ><div id="edit" class="nav-elements">&nbsp;<span class="glyphicon glyphicon-pencil"></span> <span class="nav-span">Edit Profile</span> </div></a>
        <a href="new_complain.php"> <div id="newC" class="nav-elements">&nbsp;<span class="glyphicon glyphicon-plus-sign"></span> <span class="nav-span">New Complain</span> </div>
        <a href="my_complains.php" ><div id="pastC" class="nav-elements" >&nbsp;<span class="glyphicon glyphicon-time"> </span> <span class="nav-span">My Complains</span></div></a>
        <a href="coming_soon.php" ><div id="chat" class="nav-elements" >&nbsp;<span class="glyphicon glyphicon-comment"></span> <span class="nav-span">Chat</span></div></a>
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
                        <label class="control-label col-md-3 " for="registration-no">Registration Number:</label>
                        <div class="col-md-3">
                            <input class="form-control"  type="text"  name="regNo" id="registration-no" value="<?php echo $regNo;?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="prog">Program:</label>
                        <div class="col-md-3">
                            <select class="form-control" id="prog" name="program" onchange="decideYear();decideHostel();decideBranch()" disabled>
                                <option value="0" <?php if($program==="B.Tech"){ echo 'selected="selected"';} ?> >B.Tech</option>
                                <option value="1" <?php if($program==="M.Tech"){ echo 'selected="selected"';} ?> >M.Tech</option>
                                <option value="2" <?php if($program==="MCA"){ echo 'selected="selected"';} ?> >MCA</option>
                                <option value="3" <?php if($program==="MBA"){ echo 'selected="selected"';} ?> >MBA</option>
                                <option value="4" <?php if($program==="PhD"){ echo 'selected="selected"';} ?> >PhD</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 " for="branch">Branch/Specialisation:</label>
<!--                        <div class="col-md-5">-->
<!--                            <input class="form-control"  type="text"  name="branch" id="branch"  value="Computer Science and Engineering" required>-->
<!--                        </div>-->
                        <div class="col-md-5">
                            <select class="form-control" id="branch" name="branch"  >
                                <!--                                    <option value="0">Bio-Technology</option><option value="1">Chemical Engineering</option><option value="2">Civil Engineering</option><option value="3">Computer Science & Engineering</option><option value="4">Electrical Engineering</option><option value="5">Electronics & Communication Engineering</option><option value="6">Information Technology</option><option value="7">Mechanical Engineering</option><option value="8">Production & Industrial Engineering</option>-->

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="year">Year:</label>
                        <div class="col-md-3">
                            <select class="form-control" id="year" name="year" onchange="decideHostel()">
                            
                            </select>
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
                            <label class="radio-inline" id="gender-male" ><input type="radio" name="gender" <?php if($gender==="male"){ echo 'checked="checked"';} ?> value="1" onchange="decideHostel()" disabled>&nbspMale</label>
                            <label class="radio-inline" id="gender-female"><input type="radio" name="gender" <?php if($gender==="female"){ echo 'checked="checked"';} ?> value="2" onchange="decideHostel()" disabled>&nbspFemale</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="hostel">Hostel:</label>
                        <div class="col-md-3">
                            <select class="form-control" id="hostel" name="hostel">
                                <!-- <option>SVBH</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="room-no">Room Number:<span class="asterisk">*</span></label>
                        <div class="col-md-2">
                            <input class="form-control"  type="text"  name="roomNo" id="room-no" value="<?php echo $roomNo;?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class=" col-md-offset-2">
                            <br>
                            <input type="submit" id="reg-btn" class="btn btn-info" value="Save Changes" name="saveChanges">
                            <button id="reset-btn" class="btn btn-info" onclick="reset_form()">Reset</button>  <!--Used a function because needed to reset <select> appropriately-->
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
    $("#prog").change();
    function decideYear()
    {
        console.log("Value is"+$("#prog").val());
        switch ($("#prog").val())
        {
            case "0":

                $("#year").removeAttr("disabled");
                $("#year").html('<option value="1" <?php if($year==1){ echo 'selected="selected"';} ?> >1st Year</option> <option value="2" <?php if($year==2){ echo 'selected="selected"';} ?> > 2nd Year </option> <option value="3" <?php if($year==3){ echo 'selected="selected"';} ?> > 3rd Year </option> <option value="4" <?php if($year==4){ echo 'selected="selected"';} ?> >  Final Year </option>');
                break;
            case  "2":
                $("#year").removeAttr("disabled");
                $("#year").html('<option value="1" <?php if($year==1){ echo 'selected="selected"';} ?> >1st Year</option> <option value="2" <?php if($year==2){ echo 'selected="selected"';} ?> > 2nd Year </option><option value="3" <?php if($year==3){ echo 'selected="selected"';} ?> > 3rd Year </option>');
                break;
            case  "1":
            case "3":
                $("#year").removeAttr("disabled");
                $("#year").html('<option value="1" <?php if($year==1){ echo 'selected="selected"';} ?> >1st Year</option> <option value="2" <?php if($year==1){ echo 'selected="selected"';} ?> > 2nd Year </option>');
                break;
            default:
                $("#year").html('<option value="-1"></option>')
                $("#year").attr("disabled","disabled");
        }
    }
    function decideHostel()
        {
            var p=$("#prog").val();
            var yr=$("#year").val();
            var gen=$('input:radio[name=gender]:checked').val();  //taking the value of input of type radio whose name is 'gender' and which is checked
            console.log("Gender is " + gen);
            if(gen=="1") //if male
            {
                console.log(" male")
                switch (p)
                {
                    case"0": //if B.Tech
                        $("#hostel").html('<option <?php if($hostel==="SVBH"){echo 'selected="selected"';}?> >SVBH</option><option <?php if($hostel==="Tagore Hostel"){echo 'selected="selected"';}?> >Tagore Hostel</option><option <?php if($hostel==="Patel Hostel"){echo 'selected="selected"';}?> >Patel Hostel</option><option <?php if($hostel==="Tilak Hostel"){echo 'selected="selected"';}?> >Tilak Hostel</option><option <?php if($hostel==="Malviya Hostel"){echo 'selected="selected"';}?> >Malviya Hostel</option><option <?php if($hostel==="Tandon Hostel"){echo 'selected="selected"';}?> >Tandon Hostel</option>');
                        break;
                    case "1"://if M.Tech
                    case "2": //if MCA
                    case "3": //if MBA
                    case "4": //if PhD
                        $("#hostel").html('<option <?php if($hostel==="Raman Hostel"){echo 'selected="selected"';} ?> >Raman Hostel</option><option <?php if($hostel==="PG Hostel"){echo 'selected="selected"';}?> >PG Hostel</option>');
                        break;
                }
            }
            else //if female
            {
                $("#hostel").html('<option <?php if($hostel==="KNGH"){echo 'selected="selected"';}?> >KNGH</option><option <?php if($hostel==="IH"){echo 'selected="selected"';}?> >IH</option><option <?php if($hostel==="SNGH"){echo 'selected="selected"';}?> >SNGH</option>');
            }
        }
    function decideBranch()
    {
        var prog=$("#prog").val();
        var isDisable="required";
        switch (prog)
        {
            case "0":

                $("#branch").removeAttr("disabled");
                $("#branch").html(' <option value="0" <?php if($branch==0){echo 'selected="selected"';} ?> >Bio-Technology</option><option value="1" <?php if($branch==1){echo 'selected="selected"';} ?> >Chemical Engineering</option><option value="2" <?php if($branch==2){echo 'selected="selected"';} ?> >Civil Engineering</option><option value="3" <?php if($branch==3){echo 'selected="selected"';} ?> >Computer Science & Engineering</option><option value="4" <?php if($branch==4){echo 'selected="selected"';} ?> >Electrical Engineering</option><option value="5" <?php if($branch==5){echo 'selected="selected"';} ?> >Electronics & Communication Engineering</option><option value="6" <?php if($branch==6){echo 'selected="selected"';} ?> >Information Technology</option><option value="7" <?php if($branch==7){echo 'selected="selected"';} ?> >Mechanical Engineering</option><option value="8" <?php if($branch==8){echo 'selected="selected"';} ?> >Production & Industrial Engineering</option>');
                break;
            case  "1":
                $("#branch").removeAttr("disabled");
                $("#branch").html(' <option value="9" <?php if($branch==9){echo 'selected="selected"';} ?> >Applied Mechanics</option><option value="10" <?php if($branch==10){echo 'selected="selected"';} ?> >Civil Engineering</option><option value="11" <?php if($branch==11){echo 'selected="selected"';} ?> >GIS Cell</option><option value="12" <?php if($branch==12){echo 'selected="selected"';} ?> >Computer Science & Engineering</option><option value="13" <?php if($branch==13){echo 'selected="selected"';} ?> >Electrical Engineering</option><option value="14" <?php if($branch==14){echo 'selected="selected"';} ?> >Electronics & Communication Engineering</option><option value="15" <?php if($branch==15){echo 'selected="selected"';} ?> >Mechanical Engineering</option>');
                break;
            case  "2":
            case "3":
            case "4":
                $("#branch").html('<option value="-1"></option>');
                $("#branch").attr("disabled","disabled");
                break;
        }

    }
    function reset_form(){
        $("form").get(0).reset();
        decideHostel();
        decideYear();
    }
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