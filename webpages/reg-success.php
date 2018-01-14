<!--Complainica Student Dashboard Page-->
<!--By:iLLuMinaTi-->
<?php
session_start();
if(isset($_SESSION["cnfPassword"])){
    session_unset();
    session_destroy();

}
else{
    session_unset();
    session_destroy();
    header('Location:notfound.php');
    exit();
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title> My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../stylesheets/login_header.css">
    <link rel="stylesheet" href="../stylesheets/reg-success.css">
    <script src="../lib/jquery-3.1.1.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../scripts/nav_click.js"></script>



</head>
<body>
<img  id="bg" src="../images/green_grad.jpg"> <!--Background-->
<div class="header">
    <img src="../images/logo.jpg" id="logo">
    <div id="heading" style="margin-left:-3%">Registration Success</div>
    <img src="../images/MNNIT_Logo.png" id="mnnit_logo" align="right">
</div>
<div>
    <img  id="worker" src="../images/construction-worker.png">
</div>
<a href="login-register.php" ><button id="back" class="btn btn-danger" >
    <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Go Back To Login Page
</button>
</a>


</body>

</html>