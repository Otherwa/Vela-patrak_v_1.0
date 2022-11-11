<?php
ob_start();
session_start();

if (!isset($_SESSION['name']) && !isset($_SESSION['type'])) {
    // redirect if not set
    header("Location:../account/login.php");
} else {
    $type = $_SESSION['type'];
    // if admin redirefct ot login ?
    if ($type == "admin") {
        header("Location:../account/login.php");
    }
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="96x96" rel="icon"
        href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">
    <!-- basic html required -->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>User-Dashboard</title>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="#" class="w3-bar-item w3-button">User Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">User Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">User Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">User Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">User Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">User Feature 1</a>
    </div>
    <!-- Page Content -->
    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>Dashboard</p>
        <?php echo $_SESSION['name']; ?>
        <?php echo $_SESSION['id']; ?>
    </div>


    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../js/main.js"></script>
</body>

</html>