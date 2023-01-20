<?php
ob_start();
session_start();

include("../config/connect.php");

if (!isset($_SESSION['name']) && !isset($_SESSION['type'])) {
    // redirect if not set
    header("Location:../account/login.php");
} else {
    // if mateches member redirect to login
    $type = $_SESSION['type'];
    if ($type == "member") {
        header("Location:../account/login.php");
    }
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
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin-Dashboard</title>
    <style>
    td div {
        height: max-content;
        width: max-content;
    }
    </style>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../account/login.php" class="w3-bar-item w3-button">Logout</a>
        <a href="admin_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="admin/timeslot.php" class="w3-bar-item w3-button">Time-Slot</a>
        <a href="admin/register.php" class="w3-bar-item w3-button">Registration</a>
        <a href="admin/professor.php" class="w3-bar-item w3-button">Professor</a>
        <a href="admin/room.php" class="w3-bar-item w3-button">Room</a>
        <a href="admin/course.php" class="w3-bar-item w3-button">Course</a>
        <a href="admin/subject.php" class="w3-bar-item w3-button">Subject</a>
        <a href="admin/select_subjects.php" class="w3-bar-item w3-button">Set Professor Subject</a>
        <hr style="border-top: 2px solid #eee;">
        <a href="admin/professor_timetable.php" class="w3-bar-item w3-button">Professor TimeTable
            <span style="color:green">
                (Beta)</span>
        </a>
        <a href="admin/class_timetable.php" class="w3-bar-item w3-button">Class-Timetable</a>
        <a href="admin/room_timetable.php" class="w3-bar-item w3-button">Room-Timetable</a>
        <a href="admin/empty.php" class="w3-bar-item w3-button">Empty-Rooms<span style="color:green"> (Beta)</span></a>
        <a href="admin/department.php" class="w3-bar-item w3-button">Department Timetable<span style="color:green">
                (Beta)</span></a>
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
        <p>Dashboard</p>
    </div>

    <div class="container">
        <div class="l-form">

            <div id="timetable1" style="box-shadow:none" class="form  w3-margin w3-whitesmoke w3-bar-block">
                <div class="form__div">
                    <label for="Academic Year">Academic Year:</label>
                    <select id="academic_year1" onchange="get_total_data(this.value)">
                        <option value="--">--</option>
                        <?php get_academic_year(); ?>
                    </select>
                </div>
                <div class="form__div">
                    <input type="button" id="button" value="Generate PDF">
                    <input type="button" id="button" value="Mega Print" onclick="downpdf()">
                </div>

                <?php
                $con = get_con();
                $sql = "SELECT COUNT(*) AS count FROM timeslot";
                $result = $con->query($sql);
                $result = $result->fetch_assoc();
                $result = $result['count'];
                $count1 = $result;
                ?>
                <div class="div" style="display:flex;flex-direction:column;align-items:center">
                    <img src="../out/realwatermark.png" id="water" style="width:30rem;display:none" alt="img">
                    <table class="styled-table" id="data">
                        <thread>
                            <tr>
                                <th>TimeSlot</th>
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
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script src="../js/main.js"></script>

    <script src="../js/admin_dashboard.js"></script>
</body>

</html>