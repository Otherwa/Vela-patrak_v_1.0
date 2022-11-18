<?php
ob_start();
include("../config/connect.php");

$status = get_con();

session_start();
$status = session_status(); //1st measure
if ($status == PHP_SESSION_ACTIVE) {
    //There is  active session
    session_destroy();
}

// if session is already running, it destroys previous session 
// and starts a new if redirected to this page
session_start();

// login block starts here
if (isset($_POST['login'])) {
    $name =  $_POST['Name'];
    $pass = $_POST['Password'];



    $con = get_con();
    $sql = "SELECT * FROM `members` WHERE Username = '$name' AND Password = '$pass';";

    $result = mysqli_query($con, $sql);
    $result_user_type = mysqli_fetch_array($result);
    $row = mysqli_num_rows($result);

    if ($row > 0) {

        //session variables
        $_SESSION['name'] = $result_user_type['Username'];
        $_SESSION['id'] = $result_user_type['MemberId'];
        $_SESSION['type'] = $result_user_type['Type'];

        // check if user or admin and simple redirect to it
        if ($result_user_type['Type'] == 'admin' || $result_user_type['Type'] == 'superadmin') {
            header("Location:../users/admin_dashboard.php");
        } else {
            header("Location:../users/user_dashboard.php");
        }
        // close connection
        mysqli_close($con);
    } else {
        echo "<script>alert('Wrong Password or Username');</script>";
        // close connection
        mysqli_close($con);
    }
}
// login block ends here

// for cheching 
// echo $status;
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="96x96" rel="icon" href="https://vazecollege.net/PATS/imgs/1611814068005.jpg">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/login.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Login</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../index.php" class="w3-bar-item w3-button">Home</a>
        <a href="login.php" class="w3-bar-item w3-button w3-black">Login</a>
        <a href="../about.php" class="w3-bar-item w3-button">About</a>
    </div>
    <!-- Page Content -->

    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>Login</p>
    </div>
    <br>
    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:48rem">
            <div class="context">
                <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                <p>Login as</p>
            </div>
            <br>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Name" id="Name" placeholder="e.g xyz" autocomplete="off">
                <label for="" class="form__label">Name</label>
            </div>
            <br>
            <div class="form__div">
                <input type="password" class="form__input" name="Password" id="Password" placeholder="e.g xyz@123"
                    autocomplete="off">
                <label for="" class="form__label">Password</label>
            </div>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Login"
                name="login" style="float:right">
    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/login.js"></script>
</body>

</html>