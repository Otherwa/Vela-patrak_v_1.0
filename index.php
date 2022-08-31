<?php ?>
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

    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>Home</title>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="index.php" class="w3-bar-item w3-button w3-black">Home</a>
        <a href="./account/login.php" class="w3-bar-item w3-button">Login</a>
        <a href="./about.php" class="w3-bar-item w3-button">About</a>
    </div>
    <!-- Page Content -->
    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>Vela-patrak </p>
    </div>
    <br>
    <br>
    <div class="container">
        <p>
            Because time-table matters.
        </p>
    </div>
    <div class="con">
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque molestiae natus quibusdam a nostrum odit
            adipisci ex suscipit nam voluptas tenetur asperiores amet, ullam aut doloremque impedit tempora veniam
            reiciendis!</p>
    </div>

    <div class="footer-copyright">
        <br />
        <p>&copy; | Copyright 2022 - ♾️ All rights reserved | <a href="term.php">Terms &
                Conditions</a> | <a href=" contributer.php">Contributors</a>
        </p>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="./js/main.js"></script>
</body>

</html>