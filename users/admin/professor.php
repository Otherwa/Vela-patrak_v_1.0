<?php
include("../../config/connect.php");
ob_start();
session_start();

if (!isset($_SESSION['name'])) {
    // redirect if not set
    header("Location:../account/login.php");
}

// session passes id
$id = $_SESSION['id'];

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
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/professor.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Time-Table</title>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../../account/login.php" class="w3-bar-item w3-button">Logout</a>
        <a href="../admin_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="register.php" class="w3-bar-item w3-button">Registration</a>
        <a href="timeslot.php" class="w3-bar-item w3-button w3-black">Time-Slot</a>
        <a href="professor.php" class="w3-bar-item w3-button">Professor</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
    </div>
    <!-- Page Content -->
    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <code class="txt">
        <?php echo $_SESSION['name']; ?>
        <?php echo $_SESSION['id']; ?>
    </code>

    <div class="con_head">
        <p> Professors </p>
    </div>

    <div class="container">
        <div class="list">
            <p style="float:left">Profesor</p>
            <div class="form  w3-margin w3-whitesmoke w3-bar-block" style="width:auto;height:38rem">
                
            </div>
        </div>
        <br>
        <div class="l-form">
            <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:38rem">
                <div class="context">
                    <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo"
                        style="height:3rem">
                    <p>Set Time-slot</p>
                </div>
                <br>
                <br>
                <div class="form__div">
                    <input type="number" class="form__input" name="TimeSlot" id="TimeSlot" placeholder="e.g xyz"
                        autocomplete="off">
                    <label for="" class="form__label">Time-Slot</label>
                </div>
                <br>
                <div class="form__div">
                    <input type="time" class="form__input" name="StartTime" id="StartTime" placeholder="e.g xyz@123"
                        autocomplete="off">
                    <label for="" class="form__label">Start-Time</label>
                </div>
                <br>
                <div class="form__div">
                    <input type="time" class="form__input" name="EndTime" id="EndTime"
                        placeholder="e.g someone@gmail.com" autocomplete="off">
                    <label for="" class="form__label">End-Time</label>
                </div>
                <br>
                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                    name="save" style="float:right">
        </div>
        </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/login.js"></script>
</body>

</html>