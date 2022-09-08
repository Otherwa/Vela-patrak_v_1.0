<?php
include("../../../config/connect.php");
ob_start();
session_start();

if (isset($_GET['UpdateId'])) {
    $id = $_GET['UpdateId'];

    // get data from database
    $con = get_con();
    $sql = "SELECT * FROM `rooms` WHERE RoomNo = '$id';";
    $result_get = $con->query($sql);
    $result_get = $result_get->fetch_assoc();
}

//if user clicks on register button and  data gets updated on database
if (isset($_POST['Update'])) {

    // session passes id
    $MemberId = $_SESSION['id'];

    $con = get_con();
    $floor = $_POST["Floor"];
    $capacity = $_POST["Capacity"];
    $memberid = $MemberId;

    // Update
    $sql = "UPDATE `rooms` SET `Floor` = '" . $floor . "', `Capacity` = '" . $capacity . "', `MemberId` = '" . $memberid . "' WHERE RoomNo = '" . $id . "';";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Room Updated');</script>";
        header("Location:../../room.php");
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
    <link type="image/png" sizes="96x96" rel="icon"
        href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">

    <link rel="stylesheet" href="../../../../css/main.css">
    <link rel="stylesheet" href="../../../../css/room.css">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Update</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../../../admin_dashboard.php" class="w3-bar-item w3-button ">Dashboard</a>
        <a href="../../room.php" class="w3-bar-item w3-button">Room</a>
    </div>
    <!-- Page Content -->

    <div>
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>Update Room - <?php echo $result_get["RoomNo"] ?></p>
    </div>
    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:auto">
            <div class="context">
                <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                <p>Set Room-Registration</p>
            </div>
            <br>
            <br>
            <div class="form__div">
                <input type="number" class="form__input" name="RoomNo" id="RoomNo" placeholder="e.g 8"
                    autocomplete="off" disabled="disabled" value="<?php echo $result_get["RoomNo"]; ?>">
                <label for="" class="form__label">Room No</label>
            </div>
            <br>
            <div class="form__div">
                <input type="number" class="form__input" name="Floor" id="Floor" placeholder="e.g 3" autocomplete="off"
                    value="<?php echo $result_get["Floor"]; ?>">
                <label for="" class="form__label">Floor</label>
            </div>
            <br>
            <div class="form__div">
                <input type="number" class="form__input" name="Capacity" id="Capacity" placeholder="e.g 98"
                    autocomplete="off" value="<?php echo $result_get["Capacity"]; ?>">
                <label for="" class="form__label">Capacity</label>
            </div>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Update"
                name="Update" style="float:right">
    </div>
    </form>

    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../../../js/main.js"></script>
    <script src="../../../../js/room.js"></script>
</body>

</html>