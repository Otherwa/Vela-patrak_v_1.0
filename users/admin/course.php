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

//add course
if (isset($_POST["Save"])) {
    $courseid = $_POST["CourseId"];
    $coursename = $_POST["CourseName"];
    $strength = $_POST["Strength"];
    $abbreviation = $_POST["Abbreviation"];
    $memberid = $id;

    if ($courseid == "" && $coursename == "" && $strength == "" && $abbreviation == "") {
        echo "<script>alert('Kindly Fill Form Correctly');</script>";
    } else {
        $con = get_con();
        $sql = "SELECT * FROM `course` WHERE CourseId = '" . $courseid . "'";

        $result = mysqli_query($con, $sql);
        $result_user_type = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            echo "<script>alert('Course already exsists');</script>";
            mysqli_close($con);
        } else {
            insert_course($courseid, $coursename, $strength, $abbreviation, $memberid);
        }
    }
}

function insert_course($courseid, $coursename, $strength, $abbreviation, $memberid)
{
    $con = get_con();

    $sql = "INSERT INTO `course` VALUES ('$courseid', '$coursename', '$strength', '$abbreviation', '$memberid', current_timestamp());";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Course Successfully Registered');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }

    $con->close();
}

function course()
{
    $con = get_con();
    $con = get_con();
    $sql = "SELECT * FROM course";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . "CourseId: " . $row["CourseId"] . " -Course-Name: " . $row["CourseName"] . " -Strength: " . $row["Strength"] . " -Abbreviation: " . $row["Abbreviation"] . " -Member-Id: " . $row["MemberId"] . " &nbsp;&nbsp;" . "<a style=\"color:red \" href=\"action\\admin_course_delete.php\\?DeleteId="  . $row["CourseId"] . "\">Delete</a>" . " &nbsp;&nbsp" . "<a style=\"color:#131352 \" href=\"action\\admin_course_update.php\\?UpdateId=" . $row["CourseId"] . "\">Update</a></li>";
        }
    } else {
        echo "No Timeslot";
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
    <link rel="stylesheet" href="../../css/professor.css">

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
        <p> Course-Registration </p>
    </div>

    <div class="container">
        <div class="list">
            <p style="float:left">Course-Registration</p>
            <div class="form  w3-margin w3-whitesmoke w3-bar-block" style="width:auto;height:38rem">
                <?php course(); ?>
            </div>
        </div>
        <br>
        <div class="l-form"></div>
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:auto">
            <div class="context">
                <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                <p>Set Course</p>
            </div>
            <br>
            <br>
            <div class="form__div">
                <input type="number" class="form__input" name="CourseId" id="CourseId" placeholder="e.g 8"
                    autocomplete="off">
                <label for="" class="form__label">Course Id</label>
            </div>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="CourseName" id="CourseName" placeholder="e.g BSC-IT"
                    autocomplete="off">
                <label for="" class="form__label">Course Name</label>
            </div>
            <br>
            <div class="form__div">
                <input type="number" class="form__input" name="Strength" id="Strength" placeholder="e.g 45"
                    autocomplete="off">
                <label for="" class="form__label">Strength</label>
            </div>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Abbreviation" id="Abbreviation" placeholder="e.g BSC-IT"
                    autocomplete="off">
                <label for="" class="form__label">Abbreviation</label>
            </div>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                name="Save" style="float:right">
    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/course.js"></script>
</body>

</html>