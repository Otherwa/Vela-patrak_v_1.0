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
$id = $_COOKIE["Id"];;

function get_department()
{
    $con = get_con();
    $sql = "SELECT DISTINCT Department FROM subject";
    $result = $con->query($sql);

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"" . $row["Department"] . "\">" . $row["Department"]  . "</option>";
    }

    $con->close();
}

function get_year()
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
    <link type="image/png" sizes="96x96" rel="icon" href="https://vazecollege.net/PATS/imgs/1611814068005.jpg">
    <!-- basic html required -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../../css/main.css">
    <!-- <link rel="stylesheet" href="../../css/admin_dashboard.css"> -->
    <link rel="stylesheet" href="../../css/empty.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <title>Rooms</title>
    <style>
        select {
            width: 100%;
            padding: 0.2rem;
            margin: 0.1rem;
            border-radius: 0.3rem;
        }

        td {
            padding: 1rem;
            border-width: 0.2rem;
            border-style: dotted;
        }
    </style>
</head>

<body>
    <div>

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
            <p>Professor TimeTable</p>
        </div>

        <div class="container">
            <div class="l-form">
                <div class="form  w3-margin w3-whitesmoke" style="width:auto;height:auto">
                    <div class="context">
                        <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                        <p>Professors</p>
                    </div>
                    <br>
                    <div class="form__div">
                        <p id="num"></p>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Department">Year:</label>
                        <select id="year">
                            <option value="--">--</option>
                            <?php get_year(); ?>
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Department">Department:</label>
                        <select id="department" onchange="get_professors()">
                            <option value="--">--</option>
                            <?php get_department(); ?>
                        </select>
                    </div>
                    <div class="form__div">
                        <label for="Professor">Professor:</label>
                        <select id="professor" onchange="get_professor_time()">
                            <option value="--">--</option>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <input type="button" id="button" value="Generate PDF">
                    </div>
                    <br>
                    <div class="test" id="data" style="overflow:scroll; height:fit-content; width:79vw">
                        <div class="div" style="display:flex;flex-direction:column;align-items:center">
                            <img src="../../out/realwatermark.png" id="water" style="width:30rem;display:none" alt="img">
                        </div>
                        <br>
                        <table style="width: 100%;">
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
                            <tbody class="data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
        <script src="../../js/butter.js"></script>
        <script src="../../js/main.js"></script>
        <script src="../../js/empty.js"></script>
    </div>
</body>

</html>