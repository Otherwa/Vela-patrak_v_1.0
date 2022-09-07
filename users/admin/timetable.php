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

// insert
if (isset($_POST['save'])) {
    $timeslot =  $_POST['TimeSlot'];
    $starttime =  $_POST['StartTime'];
    $memberid =  $id; //is member id of login generated at login
    $endtime =  $_POST['EndTime'];

    if ($timeslot == " " && $starttime == " " && $endtime == " " && $memberid == " ") {
        echo '<script>alert(\'Kindly Fill the Form Correctly\');</script>';
    } else {
        $con = get_con();
        $sql = "SELECT * FROM `timeslot` WHERE TimeSlot = '" . $timeslot . "'";

        $result = mysqli_query($con, $sql);
        $result_user_type = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            // check if timeslot already exists or not simple redirect to it
            echo "<script>alert('Timeslot already exsists');</script>";
            // close connection
            mysqli_close($con);
        } else {
            insert_timeslot($timeslot, $starttime, $endtime, $memberid);
        }
    }
}

// insert in timeslot
function insert_timeslot($timeslot, $starttime, $memberid, $endtime)
{
    $con = get_con();
    $sql = "INSERT INTO `timeslot` (`TimeSlot`, `StartTime`, `EndTime`, `MemberId`, `Date`) VALUES ('$timeslot', '$starttime', '$memberid', '$endtime',current_timestamp());";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Time-Slot Successfully Registered');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    $con->close();
}

function timeslot()
{
    $con = get_con();
    $con = get_con();
    $sql = "SELECT * FROM timeslot";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . "Timeslot: " . $row["TimeSlot"] . " - Start-Time: " . $row["StartTime"] . "- End-Time: " . $row["EndTime"] . " - Member-id: " . $row["MemberId"] . "  -Date: " . $row["Date"] . " &nbsp;&nbsp";
        }
    } else {
        echo "No Timeslot";
    }
    $con->close();
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

    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/register.css">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<<<<<<< HEAD
    <title>Home</title>
=======
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Time-Table</title>
>>>>>>> 46af3a9099084714ecfb7aa174c24fd060cda49f
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
<<<<<<< HEAD
        <a href="../admin_dashboard.php" class="w3-bar-item w3-button ">Dashboard</a>
        <a href="register.php" class="w3-bar-item w3-button">Registration</a>
        <a href="#" class="w3-bar-item w3-button w3-orange">Time Table</a>
=======
        <a href="../../account/login.php" class="w3-bar-item w3-button">Logout</a>
        <a href="../admin_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="register.php" class="w3-bar-item w3-button">Registration</a>
        <a href="timetable.php" class="w3-bar-item w3-button w3-black">Time-Table</a>
>>>>>>> 46af3a9099084714ecfb7aa174c24fd060cda49f
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
    </div>
    <!-- Page Content -->

    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
<<<<<<< HEAD
        <p>TimeTable</p>
    </div>
    <br>


    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:66vw">
            <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
            <br>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="TimeSlot" id="TimeSlot" placeholder="e.g xyz"
                    autocomplete="off">
                <label for="" class="form__label">Time Slot</label>
            </div>
            <br>

            <div class="form__div">
                <input type="time" class="form__input" name="StartTime" id="StartTime" placeholder="e.g xyz@123"
                    autocomplete="off">
                <label for="" class="form__label">Start Time</label>
            </div>
            <br>
            <div class="form__div">
                <input type="time" class="form__input" name="EndTime" id="EndTime" placeholder="e.g xyz"
                    autocomplete="off">
                <label for="" class="form__label">End Time</label>
            </div>
            <br>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                name="save" style="float:right">

=======
        <p> Time-Table </p>
        <?php echo $_SESSION['name']; ?>
        <?php echo $_SESSION['id']; ?>
    </div>
    <div class="list">
        <p style="float:left">Time-Slots</p>
        <div class="form  w3-margin w3-whitesmoke w3-bar-block" style="width:86vw;">
            <?php timeslot(); ?>
        </div>
    </div>
    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:86vw">
            <div class="context">
                <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
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
                <input type="time" class="form__input" name="EndTime" id="EndTime" placeholder="e.g someone@gmail.com"
                    autocomplete="off">
                <label for="" class="form__label">End-Time</label>
            </div>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                name="save" style="float:right">

>>>>>>> 46af3a9099084714ecfb7aa174c24fd060cda49f
    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/login.js"></script>
</body>

</html>