<?php
ob_start();
session_start();

include("./config/connect.php");

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
    <meta name="description"
        content="Velapatrak is a timetable management site for college students, helping them organize their schedules and keep track of classes.">
    <meta name="keywords" content="Velapatrak, timetable, management, college, students, schedule, classes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="96x96" rel="icon" href="https://vazecollege.net/PATS/imgs/1611814068005.jpg">
    <!-- basic html required -->
    <link rel=" stylesheet" href="./css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel=" stylesheet" href="./css/admin_dashboard.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>Home</title>
    <style>
    td div {
        height: max-content;
        width: max-content;
    }
    </style>
</head>

<body>
    <div>

        <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
            <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
            <a href="index.php" class="w3-bar-item w3-button w3-black">Home</a>
            <a href="./account/login.php" class="w3-bar-item w3-button">Login</a>
            <a href="./about.php" class="w3-bar-item w3-button">About</a>
        </div>
        <!-- Page Content -->
        <div class="">
            <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
        </div>

        <div class="con_head">
            <p>Vela-patrak </p>
        </div>
        <br>
        <br>
        <div class="container">
            <p>
                Because time-table matters.
            </p>
            <br>
            <div id="timetable1" style="box-shadow:none;padding:4rem;margin:4rem !important"
                class="form  w3-margin w3-whitesmoke w3-bar-block">
                <div class="form__div">
                    <label for="Academic Year">Academic Year:</label>
                    <select id="academic_year1" onchange="get_total_data(this.value)">
                        <option value="--">--</option>
                        <?php get_academic_year(); ?>
                    </select>
                </div>
                <br>
                <cite style="margin-left:1.5rem">Year :</cite>
                <p style="margin-left:1.5rem" id="say1"></p>
                <?php
                $con = get_con();
                $sql = "SELECT COUNT(*) AS count FROM timeslot";
                $result = $con->query($sql);
                $result = $result->fetch_assoc();
                $result = $result['count'];
                $count1 = $result;
                ?>
                <div class="div" style="display:flex;flex-direction:column;align-items:center">
                    <img src="./out/realwatermark.png" id="water" style="width:30rem;display:none" alt="img">
                    <table class="styled-table" style="border-collapse: collapse !important;" id="data">
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
        <div class="footer-copyright">
            <div class="conn" style="display: flex;flex-direction: column;align-items: center;">
                <img id="foot" alt="pc"
                    src="https://bang-phinf.pstatic.net/a/32ehga/0_8g9Ud018bng1q157yzwrfmle_wzcvar.gif"
                    style="max-width: 15rem; height: auto; display: inline-block; position: relative;">
            </div>
            <br />
            <p>&copy; | Copyright 2022 - ♾️ All rights reserved | <a href="term.php">Terms &
                    Conditions</a> | <a href=" contributer.php">Contributors</a>
            </p>
        </div>
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
        <script src="./js/main.js"></script>
        <script type="text/javascript">
        var filename = null;
        // get data timetable from
        function get_total_data(data) {
            console.log(data);
            let academic_year = data;

            console.log(academic_year);
            $.ajax({
                type: 'post',
                url: './users/admin/adminajax.php',
                data: "ad69=" + academic_year,
                success: function(data) {
                    $('#load_data').html(data);
                    $('#water').show();
                    filename = academic_year + "_Master";
                    $('#say1').html('' + academic_year + '')
                },
                error: function() {
                    console.log(response.status);
                },
            })
        }
        </script>
    </div>
</body>

</html>