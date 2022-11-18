<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="96x96" rel="icon"
        href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">
    <!-- basic html required -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home</title>
    <style>
    </style>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="index.php" class="w3-bar-item w3-button">Home</a>
        <a href="./account/login.php" class="w3-bar-item w3-button">Login</a>
        <a href="./about.php" class="w3-bar-item w3-button">About</a>
    </div>
    <!-- Page Content -->
    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>About</p>
    </div>

    <div class="footer-copyright">
        <div class="conn" style="display: flex;flex-direction: column;align-items: center;">
            <img id="foot" alt="pc" src="https://bang-phinf.pstatic.net/a/32ehga/0_8g9Ud018bng1q157yzwrfmle_wzcvar.gif"
                style="max-width: 15rem; height: auto; display: inline-block; position: relative;">
        </div>
        <br />
        <p>&copy; | Copyright 2022 - ♾️ All rights reserved | <a href="term.php">Terms &
                Conditions</a> | <a href=" contributer.php">Contributors</a>
        </p>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>