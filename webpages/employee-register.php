<!--Complainica Student Register Page-->
<!--By:iLLuMinaTi-->
<?php
session_start();
require_once '../core/init.php';
$errMsg="";
$loc="";
if(isset($_SESSION['cnfPassword']) && $_SESSION['designation']=="employee"){
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        if(isset($_POST["register"])){
            if($_SESSION['signupTime']<time()){
                session_unset();
                session_destroy();
                printError("Session Expired","login-register.php");
                exit();
            }
            $firstName=sanitizeInput($_POST['firstName']);
            $lastName=sanitizeInput($_POST['lastName']);
            $employeeId=sanitizeInput($_POST['employeeId']);
            $year=$_POST['year'];
            $department=sanitizeInput($_POST['department']);
            $post=sanitizeInput($_POST['post']);
            $mobileNo=sanitizeInput($_POST['mobileNo']);
            $gender=$_POST['gender'];//1 for male 2 for female
            $address=$_POST['address'];
            if($gender==1){
                $gender="male";
            }
            else{
                $gender="female";
            }
            if($firstName==NULL){
                $errMsg="First name is required";
            }
            if($employeeId==NULL){
                $errMsg="Employee id is required";
            }
            if($mobileNo==NULL){
                $errMsg="Mobile number is required";
            }
            else{
                if(strlen($mobileNo)<>10){
                    $errMsg="Enter 10 digit mobile number";
                }
            }
            if($address==NULL){
                $errMsg="Address is required";
            }
            if($department==NULL){
                $errMsg="Department is required";
            }
            if($post==NULL){
                $errMsg="Post is required";
            }

            if($errMsg<>NULL){

            }
            else{
                require_once '../core/config.php';
                $sql="SELECT * FROM employeeInfo WHERE employeeId='".$employeeId."'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)>0){
                    //show error
                    $errMsg="Employee Id. already exists.";
                }
                else{
                    $sql="SELECT * FROM employeeInfo WHERE mobileNo='".$mobileNo."'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)>0){
                        //show error
                        $errMsg="User with this mobile No. already exists."; //forget password
                    }
                    else {
                        $sql="SELECT * FROM studentInfo WHERE mobileNo='".$mobileNo."'";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)>0){
                            //show error
                            $errMsg="User with this mobile No. already exists."; //forget password
                        }
                        else{
                            $password = $_SESSION["password"];
                            $email = $_SESSION["email"];
                            $sql = "INSERT INTO employeeInfo (`email`,`employeeId`,`password`,`firstName`,`lastName`,`department`,`post`,`year`,`mobileNo`,`gender`,`address`) VALUES ('$email','$employeeId','$password','$firstName','$lastName','$department','$post','$year','$mobileNo','$gender','$address')";
                            if (mysqli_query($conn, $sql)) {
                                session_unset();
                                session_destroy();
                                header('Location:reg-success.php');
                                exit();
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    }

                }
            }
        }
    }
    else {
        $firstName="";
        $post="";
        $lastName="";
        $employeeId="";
        $gender="";
        $department="";
        $mobileNo="";
        $year="";
        $address="";
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
<html>
    <head>
        <title>Employee Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../stylesheets/register_header.css">
        <link rel="stylesheet" href="../stylesheets/employee_register.css">
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->



    </head>
<!--        header-->
    <body>
   <img  id="bg" src="../images/gear-wallpaper-12.jpg">
    <div class="header">
        <img src="../images/logo.jpg" id="logo">
        <div id="heading">EMPLOYEE REGISTRATION</div>
        <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right">
    </div>

<!--    Form-->
<div class="container">
    <div id="form-div">
        <div class="panel panel-default" style="border-style: none">
            <div id="title" class="panel-heading"><h4>Let's become brave and raise our voice against our discomforts....&nbsp</h4> </div>
            <div class="panel-body" id="reg-form">
                <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
                    <?php
                        if(isset($_POST['register'])){
                            if($errMsg<>NULL){
                                echo '<div class="alert alert-danger" id="error-msg">';
                                echo $errMsg;
                                echo '</div>';
                            }
                        }
                    ?> 
                    <div class="form-group">
                        <label class="control-label col-md-3 " for="first-name">First Name:<span class="asterisk">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control"  type="text"  name="firstName" id="first-name" value="<?php echo $firstName;?>" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="last-name">Last Name:</label>
                        <div class="col-md-7">
                            <input class="form-control"  type="text"  name="lastName" id="last-name"  value="<?php echo $lastName;?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="employee-id">Employee Id:<span class="asterisk">*</span></label>
                        <div class="col-md-3">
                            <input class="form-control"  type="text"  name="employeeId" id="employee-id" value="<?php echo $employeeId;?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="depart">Department:<span class="asterisk">*</span></label>
                        <div class="col-md-3">
                            <input class="form-control"  type="text"  name="department" id="depart" value="<?php echo $department;?>"required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="post">Post:<span class="asterisk">*</span></label>
                        <div class="col-md-5">
                            <input class="form-control"  type="text"  name="post" id="post" value="<?php echo $post;?>" required >
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 " for="year-join">Year of Joining:</label>
                        <div class="col-md-3">
                            <select class="form-control" id="year-join" name="year" required>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="mobile-no">Mobile Number:<span class="asterisk">*</span></label>
                        <div class="col-md-4">
                            <input class="form-control"  type="text"  name="mobileNo" id="mobile-no" value="<?php echo $mobileNo; ?>"required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="gender">Gender:</label>
                        <div class="col-md-5">
                            <label class="radio-inline" id="gender-male" ><input type="radio" name="gender" <?php if($gender==="male" || $gender==""){ echo 'checked="checked"';} ?>  value="1" checked="checked" >&nbspMale</label>
                            <label class="radio-inline" id="gender-female"><input type="radio" name="gender" <?php if($gender==="female"){ echo 'checked="checked"';} ?> value="2" >&nbspFemale</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 " for="address">Address:<span class="asterisk">*</span></label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="8" id="address" name="address" maxlength="300" required><?php echo $address; ?></textarea>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <div class=" col-md-offset-2">
                            <br>
                            <input type="submit" id="reg-btn" class="btn btn-info" value="Register" name="register">
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

    <script>  // Java Script for editing form
    function decideYear()
    {
        <?php
            $currYear=date('Y');
            for ($i = $currYear; $i > 1961 && $i > $currYear - 50; $i--) {
                ?>
                $("#year-join").append('<option <?php if($year==$i){echo 'selected="selected"';}?> > <?php echo $i;?></option>');
                <?php
            }
        ?>
    }
    decideYear();
    </script>

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