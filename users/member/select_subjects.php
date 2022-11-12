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
//durvesh
// session passes id
$id = $_SESSION['id'];

// insert
if (isset($_POST['save'])) {
    $professorname =  $_POST['ProfessorName'];
    $class =  $_POST['Class'];
    $semester = $_POST['Semester'];
    $subject = $_POST['Subject'];
    $memberid =  $id; //is member id of login generated at login

    if ($professorname == " " && $class == " " && $semester == " " && $subject == " " && $memberid == " ") {
        echo '<script>alert(\'Kindly Fill the Form Correctly\');</script>';
    } else {
        $con = get_con();
        $sql = "SELECT * FROM `selectsubject` WHERE ProfessorName = '" . $professorname . "'";

        $result = mysqli_query($con, $sql);
        $result_user_type = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            // check if timeslot already exists or not simple redirect to it
            echo "<script>alert('Professor already exsists');</script>";
            // close connection
            mysqli_close($con);
        } else {
            insert_professor($professorname, $class, $semester, $subject, $memberid);
        }
    }
}

// insert in subjects
function insert_professor($professorname, $class, $semester, $subject, $memberid)
{
    $con = get_con();
    $sql = "INSERT INTO `selectsubject` (`ProfessorName`, `Class`, `Semester`, `Subject`, `MemberId`, `Date`) VALUES ('$professorname', '$class', '$semester', '$subject', '$memberid', current_timestamp());";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Subject Selected Successfully');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    $con->close();
}


// list the subjects in db
function subjects()
{

    // boiler plate
    $con = get_con();
    $sql = "SELECT * FROM selectsubject";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . "Professor-Name: " . $row["ProfessorName"] . " Class: " . $row["Class"] . " Semester: " . $row["Semester"] . " Subject: " . $row["Subject"];
        }
    } else {
        echo "No Subject Selected";
    }
    $con->close();
}

// get professor names
function getprofessornames()
{
    $con = get_con();
    $sql = "SELECT * FROM professor";
    $result = $con->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"" . $row["ProfessorFirstName"] . " " . $row["ProfessorLastName"] . "\">" . $row["ProfessorFirstName"] . " " . $row["ProfessorLastName"] . "</option>";
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
    <link rel="stylesheet" href="../../css/select_subject.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Time-Table</title>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
    <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../account/login.php" class="w3-bar-item w3-button">Logout</a>
        <a href="../user_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="course.php" class="w3-bar-item w3-button">Course</a>
        <a href="professor.php" class="w3-bar-item w3-button">Professor</a>
        <a href="subject.php" class="w3-bar-item w3-button">Subject</a>
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
        <p> Select Subjects </p>
    </div>

    <div class="container">
        <div class="list">
            <p style="float:left">Select Subjects</p>
            <div id="_list" class="form  w3-margin w3-whitesmoke w3-bar-block">
                <?php subjects(); ?>
            </div>
        </div>
        <br>
        <div class="l-form">
            <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:auto">
                <div class="context">
                    <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo"
                        style="height:3rem">
                    <p>Select Subjects</p>
                </div>
                <br>
                <br>
                <div class="form__div">
                    <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Professor Name:</label>
                    <br>
                    <select name="ProfessorName" id="ProfessorName" onchange="get_classes()">
                        <option value="--">--</option>
                        <?php getprofessornames(); ?>
                    </select>
                </div>
                <br>
                <div class="form__div">
                    <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Class:</label>
                    <br>
                    <!-- ajax get in -->
                    <select name="Class" id="Class">
                        <option value="--">--</option>
                    </select>
                </div>
                <br>
                <div class="form__div">
                    <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Semester:</label>
                    <br>
                    <select name="Semester" id="Semester" onchange="get_subject()">
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
                    <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Subject:</label>
                    <br>
                    <select name="Subject" id="Subject">
                        <!-- ajax get -->
                    </select>
                </div>
                <br>
                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                    name="save" style="float:right">
        </div>
        </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/select_subject.js"></script>
</body>

</html>