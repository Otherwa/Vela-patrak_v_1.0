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

// get academic_year1
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


function get_room()
{
    $con = get_con();
    $sql = "SELECT * FROM rooms";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["RoomNo"] . "\">" . $row["RoomNo"] . "</option>";
        }
    } else {
    }
    $con->close();
}

// session passes id
$id = $_SESSION['id'];
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="96x96" rel="icon" href="https://vazecollege.net/PATS/imgs/1611814068005.jpg">
    <!-- basic html required -->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/class_timetable.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Room Time-Table</title>
    <!-- style -->
    <style>
    .styled-table th,
    .styled-table td {
        height: 9rem;
    }

    td div {
        height: auto;
        width: max-content;
    }

    .form {
        width: 80vw;
    }
    </style>
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
        <p> Room-Timetable </p>
        <br>
    </div>
    <div class="container">
        <div class="l-form">

            <div id="timetable1" style="box-shadow:none" class="form  w3-margin w3-whitesmoke w3-bar-block">
                <div class="form__div">
                    <label for="Academic Year">Academic Year:</label>
                    <select id="academic_year" onchange="clear_prev()">
                        <option value="--">--</option>
                        <?php get_academic_year(); ?>
                    </select>
                </div>
                <div class="form__div">
                    <label for="Class">Room:</label>
                    <select name="class" id="room">
                        <option value="--">--</option>
                        <!-- get fuction php -->
                        <?php get_room(); ?>
                    </select>
                </div>
                <div class="form__div">
                    <label for="Class">Semester:</label>
                    <select name="class" id="room" onchange="get_data_timetable(this.value)">
                        <option value="--">--</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="VI">VI</option>
                    </select>
                </div>
                <div class="form__div">
                    <input type="button" id="button" value="Generate PDF">
                </div>
                <table class="styled-table" id="styled-table">
                    <thread>
                        <tr>
                            <th>Timming</th>
                            <th id="dayshow">Monday</th>
                            <th id="dayshow">Tuesday</th>
                            <th id="dayshow">Wednesday</th>
                            <th id="dayshow">Thursday</th>
                            <th id="dayshow">Friday</th>
                            <th id="dayshow">Saturday</th>
                        </tr>
                    </thread>
                    <tbody id="load_data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/room_timetable.js"></script>
</body>

</html>