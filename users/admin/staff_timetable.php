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

// insert
if (isset($_POST['save'])) {
}

// gets room no from rooms
function get_room()
{
    $con = get_con();
    $sql = "SELECT DISTINCT RoomNo FROM rooms";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["RoomNo"] . "\">" . $row["RoomNo"] . "</option>";
        }
    } else {
        echo "None Added";
    }
    $con->close();
}

// gets time from timeslot
function get_time()
{
    $con = get_con();
    $sql = "SELECT DISTINCT TimeSlot,StartTime,EndTime FROM timeslot";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["TimeSlot"] . "\">" . $row["StartTime"] . " - " . $row["EndTime"] . "</option>";
        }
    } else {
        echo "None Added ";
    }
    $con->close();
}


// get class from subjects
// keyword class
function get_classs()
{
    $con = get_con();
    $sql = "SELECT DISTINCT Class FROM subject";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["Class"] . "\">" . $row["Class"] . "</option>";
        }
    } else {
        echo "None Added";
    }
    $con->close();
}

function get_subjects()
{
    $con = get_con();
    $sql = "SELECT DISTINCT SubjectName FROM subject";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["SubjectName"] . "\">" . $row["SubjectName"] . "</option>";
        }
    } else {
        echo "None Added";
    }
    $con->close();
}

// get timetable staff list
function get_staff_list()
{
    $con = get_con();
    $sql = "SELECT * FROM timetable";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["RoomNo"] . " " . $row["TimeSlot"] . " etc" . "</li>";
        }
    } else {
        echo "None Added";
    }
    $con->close();
}

function get_academic_year()
{
    $con = get_con();
    $sql = "SELECT * FROM config";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["AcademicYear"] . "\">" . $row["AcademicYear"]  . "</option>";
        }
    } else {
        echo "None Added";
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
    <link rel="stylesheet" href="../../css/staff_timetable.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Time-Table</title>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <?php include('./partial/nav.php'); ?>
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
        <p> Staff-Timetable </p>
    </div>

    <div class="container">
        <div class="l-form">
            <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:100%;height:auto">
                <div class="context">
                    <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo"
                        style="height:3rem">
                    <p>Staff-Timetable</p>
                </div>
                <br>
                <br>
                <div class="con">
                    <!-- <?php $years = range(2002, strftime("%Y", time())); ?> -->
                    <div class="form__div">
                        <label for="Academic Year">Academic Year:</label>
                        <select id="academic_year">
                            <option value="--">--</option>
                            <!-- <?php foreach ($years as $year) : ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <?php endforeach; ?> -->
                            <?php get_academic_year(); ?>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Room">Room:</label>
                        <select name="room" id="room">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <?php get_room(); ?>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Room">Timming:</label>
                        <select name="timming" id="timming">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <?php get_time(); ?>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Class">Class:</label>
                        <select name="class" id="class">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <?php get_classs(); ?>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Semester">Semester:</label>
                        <select name="semester" id="semester">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Division">Division:</label>
                        <select name="division" id="division">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Subject">Subject:</label>
                        <select name="subject" id="subject">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <?php get_subjects(); ?>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Day">Day:</label>
                        <select name="day" id="day">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Part">Part:</label>
                        <select name="part" id="part">
                            <option value="--">--</option>
                            <option value="Junior">Junior</option>
                            <option value="Degree">Degree</option>
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Sem">Sem:</label>
                        <select name="sem" id="sem">
                            <option value="--">--</option>
                            <option value="both">both</option>
                            <option value="odd">odd</option>
                            <option value="even">even</option>
                        </select>
                    </div>
                </div>
                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                    name="save" style="float:right">
            </form>
        </div>
        <br>
        <div class="list">
            <p style="float:left">Staff-Timetable</p>
            <div id="_list" class="form  w3-margin w3-whitesmoke w3-bar-block">
                <?php get_staff_list(); ?>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/staff_timetable.js"></script>
</body>

</html>