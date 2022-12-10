<?php
include("../../config/connect.php");
ob_start();
session_start();

if (!isset($_SESSION['name']) && !isset($_SESSION['type'])) {
    // redirect if not set
    header("Location:../../account/login.php");
} else {
    $type = $_SESSION['type'];
    if ($type == "member") {
        header("Location:../../account/login.php");
    }
}

// session passes id
$id = $_SESSION['id'];


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
    <title>Class Time-Table</title>
    <style>
    td div p {
        padding: 0.2rem;
        text-align: center;
    }

    td span {
        width: max-content;
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
        <p> Class-Timetable </p>
    </div>

    <div class="container">
        <div class="l-form">
            <form class="form w3-margin w3-whitesmoke" style="height:auto">


                <div class="context con">
                    <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo"
                        style="height:3rem">
                    <p>Class-Timetable</p>
                </div>
                <br>
                <br>
                <div class="form__div" style="width: 15rem;margin-left: 3rem;">
                    <label for="todo">To-Do:</label>
                    <select id="to-do">
                        <option value="insert">Insert</option>
                        <option value="load">Load</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <br>

                <br>
                <div class="con" id="inpt-form" style="justify-content: start;">
                    <div class="form__div">
                        <label for="Academic Year">Academic Year:</label>
                        <select id="academic_year">
                            <option value="--">--</option>
                            <?php get_academic_year(); ?>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Class">Class:</label>
                        <select name="class" id="class" onchange="get_sem()">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <?php get_classs(); ?>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="form__div">
                        <label for="Part">Part:</label>
                        <select name="Part" id="part" onchange="if_junior(this.value)">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <option value="Degree">Degree</option>
                            <option value="Junior">Junior</option>
                        </select>
                    </div>
                </div>

                <div class="msg1">Not Available in Mobile-Device</div>
                <div class="msg"></div>

                <div id="timetable" class="form  w3-margin w3-whitesmoke w3-bar-block">
                    <!-- hidden timeslot -->
                    <!-- based of Timming * 6 logic -->
                    <!-- no .of timings x 6 days to get unique fields in timetable -->
                    <!-- no .of timings x to get timmings -->

                    <!-- The Modal to select subject-->
                    <div id="modalDialog" class="modal">
                        <div class="con1">
                            <br>
                            <input type="button" class="close" value="Close">
                            <br>
                            <label for="day" style="padding-left:1rem">Day:<p id="day" style="padding-left:1rem"></p>
                            </label>
                            <label for="time" style="padding-left:1rem">Time:<p id="time" style="padding-left:1rem"></p>
                            </label>
                            <div class="form__div">
                                <label for="Semester">Semester:</label>
                                <select name="semester" id="semester" onchange="get_sub()">
                                    <option value="--">--</option>
                                    <!-- get fuction php -->
                                    <!-- ajax get -->
                                </select>
                            </div>
                            <br>
                            <div class="form__div">
                                <label for="Room">Room:</label>
                                <select name="room" id="room" onchange="set_room()">
                                    <option value="--">--</option>
                                    <?php get_room(); ?>
                                </select>
                            </div>
                            <br>
                            <div class="form__div">
                                <label for="Division">Division:</label>
                                <select name="division" id="division">
                                    <option value="--">--</option>
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
                                <select id="subjects"></select>
                            </div>
                            <br>
                            <div class="form__div">
                                <label for="Division">Is this a Combined Lecture:</label>
                                <input type="checkbox" id="combined" name="combined" value="Yes">
                            </div>
                            <div class="form__div">
                                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="button"
                                    value="Save" name="save" id="save" style="float:right" onclick="set_data()">
                            </div>
                        </div>
                    </div>
                    <?php
                    $con = get_con();
                    $sql = "SELECT COUNT(*) AS count FROM timeslot";
                    $result = $con->query($sql);
                    $result = $result->fetch_assoc();
                    $result = $result['count'];
                    $count1 = $result;
                    ?>
                    <input type="hidden" id="count" value="<?php echo $count1 ?>">
                    <input type="hidden" id="memberid" value="<?php echo $_SESSION['id']; ?>">
                    <table class="styled-table" id="first">
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
                        <?php
                        $con = get_con();
                        $sql = "SELECT * FROM timeslot";
                        $result = $con->query($sql);
                        // subject
                        $i = 0;
                        // timming
                        $j = 0;
                        while ($row = $result->fetch_assoc()) {

                            echo "<tr>";

                            echo "<td id=\"time" . $j++ . "\"><span>" . $row["StartTime"] . " - " . $row["EndTime"] . "</span></td>";

                            echo "<td>" . "<div id=\"Monday," . $i . "\"></div>" . "</td>";

                            echo "<td>" . "<div id=\"Tuesday," . $i . "\"></div>" . "</td>";

                            echo "<td>" . "<div id=\"Wednesday," . $i . "\"></div>" . "</td>";

                            echo "<td>" . "<div id=\"Thursday," . $i . "\"></div>" . "</td>";

                            echo "<td>" . "<div id=\"Friday," . $i . "\"></div>" . "</td>";

                            echo "<td>" . "<div id=\"Saturday," . $i . "\"></div>" . "</td>";

                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </table>
                </div>

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
                        <select name="semester" id="semester1" onchange="clear_pre1()">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <!-- ajax get -->
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Semester">Division:</label>
                        <select name="division" id="divison14" onchange="get_data_timetable(this.value)">
                            <option value="--">--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="form__div">
                        <input type="button" id="button" value="Generate PDF">
                    </div>
                    <?php
                    $con = get_con();
                    $sql = "SELECT COUNT(*) AS count FROM timeslot";
                    $result = $con->query($sql);
                    $result = $result->fetch_assoc();
                    $result = $result['count'];
                    $count1 = $result;
                    ?>
                    <div class="div" id="styled-table" style="display:flex;flex-direction:column;align-items:center">
                        <img src="../../out/realwatermark.png" id="water" style="width:30rem;display:none" alt="img">
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

                <div id="timetable2" style="box-shadow:none; display:none"
                    class="form  w3-margin w3-whitesmoke w3-bar-block">
                    <div class="form__div">
                        <label for="Academic Year">Academic Year:</label>
                        <select id="academic_year2" onchange="clear_pre2()">
                            <option value="--">--</option>
                            <?php get_academic_year(); ?>
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Class">Class:</label>
                        <select name="class" id="class2" onchange="get_sem2(this.value)">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <?php get_classs(); ?>
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Semester">Semester:</label>
                        <select name="semester" id="semester2">
                            <option value="--">--</option>
                            <!-- get fuction php -->
                            <!-- ajax get -->
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Semester">Division:</label>
                        <select name="division" id="divison15" onchange="get_data_timetable2(this.value)">
                            <option value="--">--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <table class="styled-table" id="styled-table">
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
                        <tbody id="load_data2">
                        </tbody>
                    </table>
                </div>
                <!-- onclick="get_data()" -->
            </form>
        </div>
    </div>
    <br>
    <div class="list">
    </div>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/class_timetable.js"></script>
</body>

</html>