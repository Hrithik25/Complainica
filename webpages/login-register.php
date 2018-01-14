<!--Complainica Login/Register Page-->
<!--By:iLLuMinaTi-->
<?php
    session_start();
    require_once '../core/init.php';
    $errMsg="";
    $loginactive="active";
    $signupactive="";

//Doubt.....
    if(isset($_SESSION['discardAfter'])){
        if($_SESSION['discardAfter']>time()){
            if(isset($_SESSION['regNo'])){
                header('Location:my_complains.php');    //change it
                exit();
            }
            else{
                if($_SESSION['isAdmin']==="no"){
                    header('Location:my_complains.php');   //change it
                    exit();
                }  
                else{
                    header('Location:admin_filed_complains.php');
                    exit();
                }
            }
        }
    }
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $loc="";


        //if Login Done
        if(isset($_POST['loginButton'])){
            $email=$_POST['email'];
            $password=$_POST['password'];
            $email=sanitizeInput($email);
            require_once '../core/config.php';
            $sql="SELECT * FROM studentInfo WHERE email='$email'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){ //student
                $row=mysqli_fetch_assoc($result);
                if($row['password']===$password){
                    foreach ($row as $key => $value) {
                        if($key<>"password"){
                            $_SESSION["$key"]=$value;// during login password is not stored in session variable
                        }
                    }
                    if(isset($_POST['isRemember'])){
                        $_SESSION['discardAfter']=time()+2592000;
                    }
                    else{
                        $_SESSION['discardAfter']=time()+300;
                    }
                    header('Location:my_complains.php');    //change it
                    exit();
                }
                else{
                    $errMsg="Check Email or Password";
                    // $loc="login-register.php";
                    // printError($errMsg,$loc);
                }
            }
            else{   //employee or admin
                require_once '../core/config.php';
                $sql="SELECT * FROM employeeInfo WHERE email='$email'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $row=mysqli_fetch_assoc($result);
                    if($row['password']===$password){
                        foreach ($row as $key => $value) {
                            if($key<>"password"){
                                $_SESSION["$key"]=$value;// during login password is not stored in session variable
                            }
                        }
                        if(isset($_POST['isRemember'])){
                            $_SESSION['discardAfter']=time()+2592000;
                        }
                        else{
                            $_SESSION['discardAfter']=time()+300;
                        }
                        if($_SESSION['isAdmin']=="no"){
                            header('Location:my_complains.php');    //change it
                            exit();
                        }
                        else{
                            header('Location:admin_filed_complains.php');
                            exit();
                        }
                    }
                    else{
                        $errMsg="Check Email or Password";
                        // $loc="login-register.php";
                        // printError($errMsg,$loc);
                    }

                }
                else{
                    $errMsg="Check Email or Password";
                    // $loc="login-register.php";
                    // printError($errMsg,$loc);
                }
            }
        }

        //If registration done
        else if(isset($_POST['proceedButton'])){
            $loginactive="";
            $signupactive="active";
            $email=$_POST['email'];
            $password=$_POST['password'];
            $cnfPassword=$_POST['cnfPassword'];
            $designation=$_POST['designation'];
            $email=sanitizeInput($email);
            if(filter_var($email,FILTER_VALIDATE_EMAIL)==true){
                require_once '../core/config.php';
                $sql="SELECT * FROM studentInfo WHERE email='".$email."'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $errMsg="user with email already exists.";
                }
                else{
                    $sql="SELECT * FROM employeeInfo WHERE email='".$email."'";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $errMsg="user with email already exists.";
                    }
                    else {
                        if ($password === $cnfPassword) {
                            if (strlen($password) >= 8) {
                                $_SESSION['signupTime'] = time() + 900;
                                $_SESSION['email'] = $email;
                                $_SESSION['password'] = $password;
                                $_SESSION['cnfPassword'] = $password;
                                $_SESSION['designation'] = $designation;
                                if ($designation === "employee") {
                                    header('Location:employee-register.php');
                                    exit();
                                } else {
                                    header('Location:student-register.php');
                                    exit();
                                }
                            } else {
                                $loginactive = "";
                                $signupactive = "active";
                                $errMsg = "Password must be atleast 8 char long.";
                            }
                        } else {
                            $loginactive = "";
                            $signupactive = "active";
                            $errMsg = "Passwords do not match.";
                            // $loc="login-register.php";
                            // printError($errMsg,$loc);
                        }
                    }
                }
            }
            else{
                $loginactive="";
                $signupactive="active";
                $errMsg="Enter valid email.";
                // $loc="login-register.php";
                // printError($errMsg,$loc);
            }

        }
        else{

        }

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login or Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../stylesheets/login_header.css">
        <link rel="stylesheet" href="../stylesheets/login_register.css">
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

    </head>
    <body>
        <img  id="bg" src="../images/mp_image2.jpg"> <!--Background-->
        <div class="header">
            <a href="../index.php"><img src="../images/logo.jpg" id="logo"></a>
            <div id="heading">LOGIN/REGISTER</div>
            <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right">
        </div>

        <div class="container">
            <div id="login-register-div" align="center">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li  class="<?php echo $loginactive; ?>" id="login-tab"><a data-toggle="tab" href="#login-div"><span class="glyphicon glyphicon-user"></span>&nbsp&nbspLogin </a></li>
                            <li class="<?php echo $signupactive; ?>" id="registration-tab"><a data-toggle="tab" href="#register-div"><span class="glyphicon glyphicon-plus-sign"></span>&nbspRegister</a> </li>
                        </ul>
                        <div class="tab-content">

                            <!--                               For Login-->

                            <div id="login-div"   class="tab-pane fade <?php if($loginactive<>NULL){ echo "in ".$loginactive;} ?>">
                                <form id="login-form" class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
                                   <div class="alert alert-danger" id="error-msg">
                                      <strong>Please  Contact Web Team  :)!!</strong>
                                       </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="email">Email: </label>
                                        <div class="col-md-9">
                                            <div class="input-group group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                <input class="form-control" type="email" name="email" id="email" required autofocus placeholder="Enter Your Email" >
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 "  for="password">Password:</label>
                                        <div class="col-md-9">
                                            <div class="input-group group" >
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input class="form-control" type="password"   name="password" id="password" required placeholder="Enter Your Password" >
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <div class="checkbox"  id="remember">
                                                <label><input  name="isRemember" type="checkbox">Remember me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if(isset($_POST['loginButton'])){
                                            if($errMsg<>NULL){
                                                echo '<div class="alert alert-danger" id="error-msg1">';
                                                echo $errMsg;
                                                echo '</div>';
                                            }
                                        }   
                                    ?>                                    

                                    <div class="form-group">
                                        <div class=" col-md-12">
                                            <button  class="btn btn-info" id="login-btn" name="loginButton">Login  &nbsp<span class="glyphicon glyphicon-log-in"></span></button>
                                        </div>
                                    </div>
                                </form>
                                
                                <span id="forgot"><a>Forgot password?</a></span>
                            </div>

                    <!--                            For Registration-->

                            <div id="register-div" class="tab-pane fade <?php if($signupactive<>NULL){ echo "in ".$signupactive;}?>">

                                <form id="reg-form" target="_self" class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="email">Email:</label>
                                        <div class="col-md-8">
                                            <div class="input-group group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                            <input class="form-control" type="email"  name="email" id="email" required autofocus placeholder="Enter Your Email for Registration" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="password">Password:</label>
                                        <div class="col-md-8">
                                            <div class="input-group group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input class="form-control" type="password" name="password"  id="password" required placeholder="Enter Your New Password" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="cnf-password" id="cnf-label">Confirm Password:</label>
                                        <div class="col-md-8">
                                            <div class="input-group group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                 <input class="form-control" type="password" name="cnfPassword"  id="cnf-password" required placeholder="Confirm Your New Password" >
                                            </div>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="student-employee">Register as:</label>
                                        <div class="col-md-4">
                                            <label class="radio-inline"><input id="student" type="radio" name="designation" value="student" checked >Student</label>
                                            <label class="radio-inline"><input id="employee" type="radio" name="designation" value="employee">Employee</label>
                                        </div>
                                    </div>
                                     <?php
                                        if(isset($_POST['proceedButton'])){
                                            if($errMsg<>NULL){
                                                echo '<div class="alert alert-danger" id="error-msg2">';
                                                echo $errMsg;
                                                echo '</div>';
                                            }
                                        }
                                    ?>  
                                    <div class="form-group">
                                        <div class=" col-md-12">
                                            <button  class="btn btn-info" id="register-btn" name="proceedButton"> Proceed &nbsp<span class="glyphicon glyphicon-arrow-right"></span> </button>
                                        </div>
                                    </div>
                                </form>
                                    </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </body>
    <script src="../lib/jquery-3.1.1.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script>
        function fadeTrans1()
        {
            console.log("Here");
            $("#error-msg").animate({opacity:'0'},1000,function(){
                $("#error-msg").css({'display':'none'});
                $("#error-msg").animate({opacity:'1'},400);
            });
        }
        $("#forgot").click(function(){
            $("#error-msg").css('display',"block");
            fadeTrans1();
        });

    </script>
</html>