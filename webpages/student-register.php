<!--Complainica Student Register Page-->
<!--By:iLLuMinaTi-->
<?php
session_start();
require_once '../core/init.php';
$errMsg="";
$loc="";
if(isset($_SESSION['cnfPassword']) && $_SESSION['designation']=="student"){
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
            $regNo=sanitizeInput($_POST['regNo']);
            $program=$programName[$_POST['program']];
            $branch=$_POST['branch'];
            $year=$_POST['year'];
            $mobileNo=sanitizeInput($_POST['mobileNo']);
            $hostel=$_POST['hostel'];
            $gender=$_POST['gender'];//1 for male 2 for female
            if($gender==1){
                $gender="male";
            }
            else{
                $gender="female";
            }
            $roomNo=sanitizeInput($_POST['roomNo']);
            if($regNo==NULL){
                $errMsg="Registration number is required";
            }
            else{
                require_once '../core/config.php';
                $sql="SELECT * FROM studentInfo WHERE regNo='".$regNo."'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)>0){
                    //show error
                    $errMsg="Registration No. already exists.";
                }
                else{
                    if($mobileNo==NULL){
                        $errMsg="Mobile number is required";
                    }
                    else {
                        if (strlen($mobileNo) <> 10) {
                            $errMsg = "Enter 10 digit mobile number";
                        } else {
                            $sql = "SELECT * FROM studentInfo WHERE mobileNo='" . $mobileNo . "'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                //show error
                                $errMsg = "User with this mobile No. already exists."; //forget password
                            } else {
                                $sql = "SELECT * FROM employeeInfo WHERE mobileNo='" . $mobileNo . "'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    //show error
                                    $errMsg = "User with this mobile No. already exists."; //forget password
                                } else {
                                    if ($firstName == NULL) {
                                        $errMsg = "First name is required";
                                    } else {
                                        $password = $_SESSION["password"];
                                        $email = $_SESSION["email"];
                                        $sql = "INSERT INTO studentInfo (`email`,`regNo`,`password`,`firstName`,`lastName`,`program`,`branch`,`year`,`mobileNo`,`gender`,`hostel`,`roomNo`) VALUES ('$email','$regNo','$password','$firstName','$lastName','$program','$branch','$year','$mobileNo','$gender','$hostel','$roomNo')";
                                        if (mysqli_query($conn, $sql)) {

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
            }
        }
    }
    else {
        $firstName="";
        $lastName="";
        $regNo="";
        $gender="";
        $branch="";
        $program="";
        $roomNo="";
        $mobileNo="";
        $year="";
        $hostel="";
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
        <title>Student Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../stylesheets/register_header.css">
        <link rel="stylesheet" href="../stylesheets/student_register.css">
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->



    </head>
<!--        header-->
    <body>
   <img  id="bg" src="../images/gear-wallpaper-12.jpg">
    <div class="header">
        <img src="../images/logo.jpg" id="logo">
        <div id="heading">STUDENT REGISTRATION</div>
        <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right">
    </div>

<!--    Content-->
    <div class="container">
        <div id="form-div">
            <div class="panel panel-default">
                <div id="title" class="panel-heading">Let's become brave and raise our voice against our discomforts....&nbsp<span class="glyphicon glyphicon-bullhorn"></span> </div>
                <div class="panel-body" id="reg-form">
                    <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

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
                                <input class="form-control"  type="text"  name="lastName" id="last-name" value="<?php echo $lastName;?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 " for="registration-no">Registration Number:<span class="asterisk">*</span></label>
                            <div class="col-md-3">
                                <input class="form-control"  type="text"  name="regNo" id="registration-no" value="<?php echo $regNo;?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 " for="prog">Program:<span class="asterisk">*</span></label>
                            <div class="col-md-3">
                                <select class="form-control" id="prog" name="program" onchange="decideYear();decideHostel();decideBranch();">
                                    <option value="0" <?php if($program==="B.Tech"){ echo 'selected="selected"';} ?>>B.Tech</option>
                                    <option value="1"  <?php if($program==="M.Tech"){ echo 'selected="selected"';} ?>>M.Tech</option>
                                    <option value="2"   <?php if($program==="MCA"){ echo 'selected="selected"';} ?>>MCA</option>
                                    <option value="3"   <?php if($program==="MBA"){ echo 'selected="selected"';} ?>>MBA</option>
                                    <option value="4"   <?php if($program==="PhD"){ echo 'selected="selected"';} ?>>PhD</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 " for="branch">Branch/Specialisation:<span class="asterisk">*</span></label>
<!--                            <div class="col-md-5">-->
<!--                                <input class="form-control"  type="text"  name="branch" id="branch" required>-->
<!--                            </div>-->
                            <div class="col-md-5">
                                <select class="form-control" id="branch" name="branch"  >
<!--                                    <option value="0">Bio-Technology</option><option value="1">Chemical Engineering</option><option value="2">Civil Engineering</option><option value="3">Computer Science & Engineering</option><option value="4">Electrical Engineering</option><option value="5">Electronics & Communication Engineering</option><option value="6">Information Technology</option><option value="7">Mechanical Engineering</option><option value="8">Production & Industrial Engineering</option>-->

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 " for="year">Year:<span class="asterisk">*</span></label>
                            <div class="col-md-3">
                                <select class="form-control" id="year" name="year" onchange="decideHostel()">
                                    <option value="1">1st Year</option>
                                    <option value="2"> 2nd Year </option>
                                    <option value="3"> 3rd Year </option>
                                    <option value="4">  Final Year </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 " for="mobile-no">Mobile Number:<span class="asterisk">*</span></label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text"  name="mobileNo" id="mobile-no" value="<?php echo $mobileNo;?>"required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="gender">Gender:<span class="asterisk">*</span> </label>
                            <div class="col-md-5">
                                <label class="radio-inline" id="gender-male" ><input type="radio" name="gender" <?php if($gender==="male" || $gender==""){ echo 'checked="checked"';} ?>  value="1" onchange="decideHostel()">&nbspMale</label>
                                <label class="radio-inline" id="gender-female"><input type="radio" name="gender"  <?php if($gender==="female"){ echo 'checked="checked"';} ?> value="2" onchange="decideHostel()">&nbspFemale</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 " for="hostel">Hostel:<span class="asterisk">*</span></label>
                            <div class="col-md-3">
                                <select class="form-control" id="hostel" name="hostel">
<!--                                    <option>SVBH</option>-->
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
                                <input type="submit" id="reg-btn" class="btn btn-info" value="Register" name="register">
                                <button id="reset-btn" class="btn btn-info" onclick="reset_form()">Reset</button>  <!--Used a function because needed to reset <select> appropriately-->
                            </div>
                        </div>


                        <div id="agree">By Registering You Agree to Our Terms and Conditions.</div>
                    </form>
                </div>
            </div>
         </div>

    </div>
</body>
    <script src="../lib/jquery-3.1.1.js"></script>
    <script>


        $("#prog").change();
        function decideYear()
        {
            console.log("Value is"+$("#prog").val());
            /*switch ($("#prog").val())
            {
                case "0":

                    $("#year").removeAttr("disabled");
                    $("#year").html('<option value="1" >1st Year</option> <option value="2"> 2nd Year </option> <option value="3"> 3rd Year </option> <option value="4">  Final Year </option>');
                    break;
                case  "2":
                    $("#year").removeAttr("disabled");
                    $("#year").html('<option value="1">1st Year</option> <option value="2"> 2nd Year </option><option value="3"> 3rd Year </option>');
                    break;
                case  "1":
                case "3":
                    $("#year").removeAttr("disabled");
                    $("#year").html('<option value="1">1st Year</option> <option value="2"> 2nd Year </option>');
                    break;
                default:
                    $("#year").html('<option value="-1"></option>')
                    $("#year").attr("disabled","disabled");
            }*/
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
                      /* switch (p)
                       {
                           case"0": //if B.Tech
                               $("#hostel").html('<option>SVBH</option><option>Tagore Hostel</option><option>Patel Hostel</option><option>Tilak Hostel</option><option>Malviya Hostel</option><option>Tandon Hostel</option>');

                               break;
                           case "1"://if M.Tech
                           case "2": //if MCA
                           case "3": //if MBA
                           case "4": //if PhD
                               $("#hostel").html('<option>Raman Hostel</option><option>PG Hostel</option>');
                               break;
                       }
                }
                else //if female
                {
                    $("#hostel").html('<option>KNGH</option><option>IH</option><option>SNGH</option>');
                }*/
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

        function reset_form(){
            $("form").get(0).reset();
            decideHostel();
            decideYear();
            decideBranch();
        }


        function decideBranch()
        {
            var prog=$("#prog").val();
           /* switch (prog)
            {
                case "0":

                   $("#branch").removeAttr("disabled");
                    $("#branch").html(' <option value="0">Bio-Technology</option><option value="1">Chemical Engineering</option><option value="2">Civil Engineering</option><option value="3">Computer Science & Engineering</option><option value="4">Electrical Engineering</option><option value="5">Electronics & Communication Engineering</option><option value="6">Information Technology</option><option value="7">Mechanical Engineering</option><option value="8">Production & Industrial Engineering</option>');
                    break;
                case  "1":
                    $("#branch").removeAttr("disabled");
                    $("#branch").html(' <option value="9">Applied Mechanics</option><option value="10">Civil Engineering</option><option value="11">GIS Cell</option><option value="12">Computer Science & Engineering</option><option value="13">Electrical Engineering</option><option value="14">Electronics & Communication Engineering</option><option value="15">Mechanical Engineering</option>');
                    break;
                case  "2":
                case "3":
                case "4":
                    $("#branch").html('<option value="-1"></option>');
                    $("#branch").attr("disabled","disabled");
                    break;
            }*/
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
    </script>


</html>