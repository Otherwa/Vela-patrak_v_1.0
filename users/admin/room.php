<?php
include("../../config/connect.php");
ob_start();
session_start();

if (!isset($_SESSION['name']) && !isset($_SESSION['type'])) {
    // redirect if not set
    header("Location:../account/login.php");
} else {
    $type = $_SESSION['type'];
    if ($type == "member") {
        header("Location:../account/login.php");
    }
}

// session passes id
$id = $_SESSION['id'];

if (isset($_POST['Save'])) {
    $roomno = $_POST['RoomNo'];
    $floor = $_POST['Floor'];
    $capacity = $_POST['Capacity'];
    $memberid = $id;

    if ($roomno == " " || $floor == " " || $capacity == " ") {
        echo '<script>alert(\'Kindly Fill the Form Correctly\');</script>';
    } else {
        $con = get_con();
        $sql = "SELECT * FROM `rooms` WHERE RoomNo = '$roomno';";
        $result = mysqli_query($con, $sql);
        $result_user_type = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            // check if user or admin and simple redirect to it
            echo "<script>alert('Room Already Exists');</script>";
            // close connection
            mysqli_close($con);
        } else {
            insert_room($roomno, $floor, $capacity, $id);
        }
    }
}

// insert if valid
function insert_room($roomno, $floor, $capacity, $memberid)
{
    $con = get_con();
    $sql = "INSERT INTO `rooms` (`RoomNo`, `Floor`, `Capacity`, `MemberId`, `Date`) VALUES ('$roomno', '$floor', '$capacity', '$memberid',current_timestamp());";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Room Successfully Registered');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    $con->close();
}

// show all list rooms
function rooms()
{
    $con = get_con();
    $sql = "SELECT * FROM rooms";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . "Room-No: " . $row["RoomNo"] . " -Floor: " . $row["Floor"] . " -Capacity: " . $row["Capacity"] . " -Member-id: " . $row["MemberId"] . " &nbsp;&nbsp" . "<a style=\"color:#131352 \" href=\"action\\admin_room_update.php\\?UpdateId=" . $row["RoomNo"] . "\">Update</a> &nbsp;&nbsp;" . "<a style=\"color:red \" href=\"action\\admin_room_delete.php\\?DeleteId=" . $row["RoomNo"] . "\">Delete</a></li>";
        }
    } else {
        echo "No Room";
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
    <!-- basic html required -->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/room.css">

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
        <a href="timeslot.php" class="w3-bar-item w3-button">Time-Slot</a>
        <a href="professor.php" class="w3-bar-item w3-button">Professor</a>
        <a href="room.php" class="w3-bar-item w3-button w3-black">Rooms</a>
        <a href="course.php" class="w3-bar-item w3-button">Course</a>
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
        <p> Rooms </p>
    </div>

    <div class="container">
        <div class="list">
            <p style="float:left">Room-Registration</p>
            <div id="_list" class="form  w3-margin w3-whitesmoke w3-bar-block"
                style="width:auto;height:60vh !important;overflow-y:scroll">
                <?php rooms(); ?>
            </div>
        </div>
        <br>
        <div class="l-form">
            <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:auto">
                <div class="context">
                    <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo"
                        style="height:3rem">
                    <p>Set Room-Registration</p>
                </div>
                <br>
                <br>
                <div class="form__div">
                    <input type="number" class="form__input" name="RoomNo" id="RoomNo" placeholder="e.g 8"
                        autocomplete="off">
                    <label for="" class="form__label">Room No</label>
                </div>
                <br>
                <div class="form__div">
                    <input type="number" class="form__input" name="Floor" id="Floor" placeholder="e.g 3"
                        autocomplete="off">
                    <label for="" class="form__label">Floor</label>
                </div>
                <br>
                <div class="form__div">
                    <input type="number" class="form__input" name="Capacity" id="Capacity" placeholder="e.g 98"
                        autocomplete="off">
                    <label for="" class="form__label">Capacity</label>
                </div>
                <br>
                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                    name="Save" style="float:right">
        </div>
        </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/room.js"></script>
</body>

</html>