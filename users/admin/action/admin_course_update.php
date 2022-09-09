<?php
include("../../../config/connect.php");
ob_start();
session_start();

if (isset($_GET['UpdateId'])) {
    $id = $_GET['UpdateId'];

    // get data from database
    $con = get_con();
    $sql = "SELECT * FROM course WHERE CourseId = $id;";
    $result_get = $con->query($sql);
    $result_get = $result_get->fetch_assoc();
}


if (isset($_POST['Update'])) {

    $con = get_con();

    $coursename =  $_POST['CourseName'];
    $strength =  $_POST['Strength'];
    $abbreviation =  $_POST['Abbreviation'];
    $memberid =  $_SESSION['id'];

    $sql = "UPDATE `course` SET `CourseName` = '" . $coursename . "', `Strength`='" . $strength . "', `Abbreviation`='" . $abbreviation . "', `MemberId`='" . $memberid . "' WHERE CourseId = '" . $id . "';";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Course Updated');</script>";
        header("Location:../../course.php");
    } else {
        echo $sql;
        echo "<script>alert('Something went wrong.');</script>";
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

    <link rel="stylesheet" href="../../../../css/main.css">
    <link rel="stylesheet" href="../../../../css/course.css">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Update</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../../../admin_dashboard.php" class="w3-bar-item w3-button ">Dashboard</a>
        <a href="../../course.php" class="w3-bar-item w3-button">Course</a>
    </div>
    <!-- Page Content -->

    <div>
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>Update Course - <?php echo $result_get["CourseId"] ?></p>
    </div>
    <br>

    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:auto">
            <div class="context">
                <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                <p>Update Course</p>
            </div>
            <br>
            <br>
            <div class="form__div">
                <input type="number" class="form__input" name="CourseId" id="CourseId" placeholder="e.g 8"
                    autocomplete="off" disabled="disabled" value="<?php echo $result_get["CourseId"] ?>">
                <label for="" class="form__label">Course Id</label>
            </div>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="CourseName" id="CourseName" placeholder="e.g BSC-IT"
                    autocomplete="off" value="<?php echo $result_get["CourseName"] ?>">
                <label for="" class="form__label">Course Name</label>
            </div>
            <br>
            <div class="form__div">
                <input type="number" class="form__input" name="Strength" id="Strength" placeholder="e.g 45"
                    autocomplete="off" value="<?php echo $result_get["Strength"] ?>">
                <label for="" class="form__label">Strength</label>
            </div>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Abbreviation" id="Abbreviation" placeholder="e.g BSC-IT"
                    autocomplete="off" value="<?php echo $result_get["Abbreviation"] ?>">
                <label for="" class="form__label">Abbreviation</label>
            </div>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                name="Update" style="float:right">
    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../../../js/main.js"></script>
    <script src="../../../../js/course.js"></script>
</body>

</html>