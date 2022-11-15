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
    <link type="image/png" sizes="96x96" rel="icon"
        href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">
    <!-- basic html required -->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/class_timetable.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        <p> Room-Timetable </p>
        <br>
    </div>
    <div class="container">
        <div class="l-form">

            <div id="timetable1" style="box-shadow:none" class="form  w3-margin w3-whitesmoke w3-bar-block">
                <div class="form__div">
                    <label for="Academic Year">Academic Year:</label>
                    <select id="academic_year1" onchange="clear_prev()">
                        <option value="--">--</option>
                        <?php get_academic_year(); ?>
                    </select>
                </div>
                <div class="form__div">
                    <label for="Class">Class:</label>
                    <select name="class" id="class1" onchange="get_sem1(this.value)">
                        <option value="--">--</option>
                        <!-- get fuction php -->
                        <?php get_classs(); ?>
                    </select>
                </div>
                <div class="form__div">
                    <label for="Semester">Semester:</label>
                    <select name="semester" id="semester1" onchange="get_data_timetable(this.value)">
                        <option value="--">--</option>
                        <!-- get fuction php -->
                        <!-- ajax get -->
                    </select>
                </div>
                <?php
                $con = get_con();
                $sql = "SELECT COUNT(*) AS count FROM timeslot";
                $result = $con->query($sql);
                $result = $result->fetch_assoc();
                $result = $result['count'];
                $count1 = $result;
                ?>
                <table class="styled-table">
                    <thread>
                        <tr>
                            <th>Timming</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                        </tr>
                    </thread>
                    <tbody id="load_data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/room_timetable.js"></script>
</body>

</html>