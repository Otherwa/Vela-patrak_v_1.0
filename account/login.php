<?php
include("../config/connect.php");
get_con();
// for cheching 
// echo $status;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="96x96" rel="icon"
        href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/login.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Home</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../index.php" class="w3-bar-item w3-button">Home</a>
        <a href="login.php" class="w3-bar-item w3-button">Login</a>
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
        <form method="POST" class="form w3-round w3-border w3-margin" style="width:33rem">
            <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
            <br>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Name" id="Name" placeholder="e.g xyz" autocomplete="off">
                <label for="" class="form__label">Name</label>
            </div>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Password" id="Password" placeholder="e.g xyz@123"
                    autocomplete="off">
                <label for="" class="form__label">Password</label>
            </div>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Login"
                style="float:right">
    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../js/main.js"></script>
    <script src="../js/login.js"></script>
</body>

</html>