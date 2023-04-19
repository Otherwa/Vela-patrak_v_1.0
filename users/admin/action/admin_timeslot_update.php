<?php
include("../../../config/connect.php");
ob_start();
session_start();

if (isset($_GET['UpdateId'])) {
    $id = $_GET['UpdateId'];

    // get data from database
    $con = get_con();
    $sql = "SELECT * FROM timeslot WHERE TimeSlot = $id;";
    $result_get = $con->query($sql);
    $result_get = $result_get->fetch_assoc();
}

//if user clicks on register button and  data gets updated on database
if (isset($_POST['Update'])) {

    // session passes id
    $MemberId = $_SESSION['id'];

    $con = get_con();
    $starttime = $_POST['StartTime'];
    $endtime = $_POST['EndTime'];
    $memberid = $MemberId;
    // Update
    $sql = "UPDATE `timeslot` SET `StartTime` = '" . $starttime . "', `EndTime`='" . $endtime . "', `MemberId` = '" . $memberid . "'WHERE TimeSlot = '" . $id . "';";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Timeslot Updated');</script>";
        header("Location:../../timeslot.php");
    } else {
        echo $sql;
        echo "<script>alert('Something went wrong.');</script>";
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
    <link type="image/png" sizes="96x96" rel="icon" href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">

    <link rel="stylesheet" href="../../../../css/main.css">
    <link rel="stylesheet" href="../../../../css/timeslot.css">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Update</title>
</head>

<body>
    <div>
        <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
            <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
            <a href="../../../admin_dashboard.php" class="w3-bar-item w3-button ">Dashboard</a>
            <a href="../../timeslot.php" class="w3-bar-item w3-button">Time-Slot</a>
        </div>
        <!-- Page Content -->

        <div>
            <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
        </div>

        <div class="con_head">
            <p>Update TimeSlot - <?php echo $result_get["TimeSlot"] ?></p>
        </div>
        <br>

        <br>
        <div class="l-form">
            <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:38rem">
                <div class="context">
                    <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                    <p>Set Time-slot</p>
                </div>
                <br>
                <br>
                <div class="form__div">
                    <input type="number" class="form__input" name="TimeSlot" id="TimeSlot" placeholder="e.g xyz" autocomplete="off" value="<?php echo $result_get["TimeSlot"] ?>" disabled="disabled">
                    <label for="" class="form__label">Time-Slot</label>
                </div>
                <br>
                <div class="form__div">
                    <input type="time" class="form__input" name="StartTime" id="StartTime" placeholder="e.g xyz@123" autocomplete="off" value="<?php echo $result_get["StartTime"]; ?>"> <label for="" class="form__label">Start-Time</label>
                </div>
                <br>
                <div class="form__div">
                    <input type="time" class="form__input" name="EndTime" id="EndTime" placeholder="e.g someone@gmail.com" autocomplete="off" value="<?php echo $result_get["EndTime"]; ?>"> <label for="" class=" form__label">End-Time</label>
                </div>
                <br>
                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save" name="Update" style="float:right">
        </div>
        </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../../../js/main.js"></script>
    <script src="../../../../js/login.js"></script>
    </div>
</body>

</html>