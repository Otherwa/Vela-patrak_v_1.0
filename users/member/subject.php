<?php
include("../../config/connect.php");
ob_start();
session_start();

if (!isset($_SESSION['name']) && !isset($_SESSION['type'])) {
    // redirect if not set
    header("Location:../account/login.php");
} else {
    $type = $_SESSION['type'];
    if ($type == "admin") {
        header("Location:../account/login.php");
    }
}

// session passes id
$id = $_COOKIE["Id"];;

// insert
if (isset($_POST['save'])) {
    $subjectcode =  $_POST['SubjectCode'];
    $subjectname =  $_POST['SubjectName'];
    $semester =  $_POST['Semester'];
    $class =  $_POST['Class'];
    $course =  $_POST['CourseName'];
    $department =  $_POST['Department'];
    $part =  $_POST['Part'];
    $memberid =  $id; //is member id of login generated at login

    if ($subjectcode == " " && $subjectname == " " && $semester == " " && $class == " " && $department == " " && $part == " " && $course == " " && $memberid == " ") {
        echo '<script>alert(\'Kindly Fill the Form Correctly\');</script>';
    } else {
        $con = get_con();
        $sql = "SELECT * FROM `subject` WHERE SubjectName = '" . $subjectname . "'";

        $result = mysqli_query($con, $sql);
        $result_user_type = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            // check if timeslot already exists or not simple redirect to it
            echo "<script>alert('Subject already exsists');</script>";
            // close connection
            mysqli_close($con);
        } else {
            insert_subject($subjectcode, $subjectname, $department, $memberid, $semester, $class, $course, $part);
        }
    }
}

// insert in subjects
function insert_subject($subjectcode, $subjectname, $department, $memberid, $semester, $class, $course, $part)
{
    $con = get_con();
    $sql = "INSERT INTO `subject` (`SubjectCode`, `SubjectName`, `Department`, `MemberId`, `Semester`, `Class`, `CourseId`, `Date`, `Part`) VALUES ('$subjectcode', '$subjectname', '$department', '$memberid', '$semester', '$class', '$course', current_timestamp(), '$part');";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Subject Successfully Registered');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    $con->close();
}

// list the subjects in db
function subject()
{
    $con = get_con();
    $sql = "SELECT * FROM subject";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . "Member-Id: " . $row["MemberId"] . " -Subject Code: " . $row["SubjectCode"] . " -Subject Name: " . $row["SubjectName"] . " -Department: " . $row["Department"] . " -Semester: " . $row["Semester"] . " -Class: " . $row["Class"] . " -Part: " . $row["Part"] . "-Course Name: " . $row["CourseId"] . "</li>";
        }
    } else {
        echo "No Subject";
    }
    $con->close();
}

function get_course()
{
    $con = get_con();
    $sql = "SELECT DISTINCT CourseName FROM course";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["CourseName"] . "\">" . $row["CourseName"] . "</option>";
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
    <link type="image/png" sizes="96x96" rel="icon" href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">
    <!-- basic html required -->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/subject.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Time-Table</title>
</head>

<body>
    <div>

        <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
            <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
            <a href="../account/login.php" class="w3-bar-item w3-button">Logout</a>
            <a href="../user_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
            <a href="course.php" class="w3-bar-item w3-button">Course</a>
            <a href="professor.php" class="w3-bar-item w3-button">Professor</a>
            <a href="select_subjects.php" class="w3-bar-item w3-button">Select Subject</a>
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
            <p> Subject Registration </p>
        </div>

        <div class="container">
            <div class="list">
                <p style="float:left">Subjects</p>
                <div id="_list" class="form  w3-margin w3-whitesmoke w3-bar-block">
                    <?php subject(); ?>
                </div>
            </div>
            <br>
            <div class="l-form">
                <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:auto">
                    <div class="context">
                        <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                        <p>Set Subject</p>
                    </div>
                    <br>
                    <br>
                    <div class="form__div">
                        <input type="text" class="form__input" name="SubjectCode" id="SubjectCode" placeholder="e.g xyz" autocomplete="off">
                        <label for="" class="form__label">Subject Code</label>
                    </div>
                    <br>
                    <div class="form__div">
                        <input type="text" class="form__input" name="SubjectName" id="SubjectName" placeholder="e.g xyz" autocomplete="off">
                        <label for="" class="form__label">Subject Name</label>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Semester</label>
                        <br>
                        <select name="Semester" id="Semester">
                            <option value="--">--</option>
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
                        <input type="text" class="form__input" name="Class" id="Class" placeholder="e.g xyz" autocomplete="off">
                        <label for="" class="form__label">Class</label>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Course Name:</label>
                        <br>
                        <select name="CourseName" id="CourseName">
                            <?php get_course(); ?>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Part:</label>
                        <br>
                        <select name="Part" id="Part">
                            <option value="Junior">Junior</option>
                            <option value="Degree">Degree</option>
                        </select>
                    </div>
                    <br>
                    <div class="form__div">
                        <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Department</label>
                        <br>
                        <select name="Department" id="Department">
                            <option value="--">--</option>
                            <option value="PSYCHOLOGY">PSYCHOLOGY</option>
                            <option value="FRENCH">FRENCH</option>
                            <option value="SANSKRIT">SANSKRIT</option>
                            <option value="ENGLISH">ENGLISH</option>
                            <option value="MARATHI">MARATHI</option>
                            <option value="POL.SCIENCE">POL.SCIENCE</option>
                            <option value="HISTORY">HISTORY</option>
                            <option value="SOCIOLOGY">SOCIOLOGY</option>
                            <option value="ECONOMICS">ECONOMICS</option>
                            <option value="MENTORING">MENTORING</option>
                            <option value="EVS">EVS</option>
                            <option value="RC">RC</option>
                            <option value="PHY.EDN.">PHY.EDN.</option>
                            <option value="UPSC">UPSC</option>
                            <option value="HINDI">HINDI</option>
                            <option value="JR AND DEGREE">JR AND DEGREE</option>
                            <option value="FOUNDATION COURSE">FOUNDATION COURSE</option>
                            <option value="INFORMATION TECHLOGY">INFORMATION TECHOLOGY</option>
                            <option value="PHYSICS">PHYSICS</option>
                            <option value="CHEMISTRY">CHEMISTRY</option>
                            <option value="BIOLOGY">BIOLOGY</option>
                            <option value="MATHEMATICS">MATHEMATICS</option>
                            <option value="BOTANY">BOTANY</option>
                            <option value="ZOOLOGY">ZOOLOGY</option>
                            <option value="PRACTICALS">PRACTICALS</option>
                            <option value="COMMERCE">COMMERCE</option>
                            <option value="B.ECONOMICS">B. ECONOMICS</option>
                            <option value="ACCOUNTS">ACCOUNTS</option>
                            <option value="B.LAW">B.LAW</option>
                            <option value="MCOM">MCOM</option>
                            <option value="BVOC">BVOC</option>
                            <option value="M.SC.IT">M.SC.IT</option>
                            <option value="BIOTECHONOLOGY">BIOTECHONOLOGY</option>
                            <option value="BAF">BAF</option>
                            <option value="BBI">BBI</option>
                            <option value="BMS">BMS</option>
                            <option value="BMM">BMMC</option>
                        </select>
                        <br>
                        <br>
                        <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save" name="save" style="float:right">
                    </div>
                </form>
            </div>
            <script src="https://unpkg.com/scrollreveal"></script>
            <script src="../../js/butter.js"></script>
            <script src="../../js/main.js"></script>
            <script src="../../js/subject.js"></script>
        </div>
</body>

</html>