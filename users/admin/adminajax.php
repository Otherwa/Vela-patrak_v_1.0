<?php
ob_start();
include("../../config/connect.php");

if (isset($_POST['department'])) {
    $con = get_con();
    $id = $_POST['department'];
    if ($id == "--") {
        $con = get_con();
        $sql = "SELECT * FROM professor";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . "id: " . $row["ProfessorId"] . " -Name: " . $row["ProfessorFirstName"] . $row["ProfessorLastName"] . "- Email: " . $row["EmailId"] .  "- Department: " . $row["Department"] . "- Part: " . $row["Part"] .  " &nbsp;&nbsp;" . "<a style=\"color:red \" href=\"action\\admin_professor_delete.php\\?DeleteId="  . $row["MemberId"] . "\">Delete</a>" . "&nbsp;&nbsp;" . "<a style=\"color:#131352 \" href=\"action\\admin_professor_update.php\\?UpdateId=" . $row["MemberId"] . "\">Update</a></li>";
            }
        } else {
            echo "No Professor";
        }
        $con->close();
    } else {
        $sql = "SELECT * FROM professor WHERE `Department` = '$id';";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . "id: " . $row["ProfessorId"] . " -Name: " . $row["ProfessorFirstName"] . $row["ProfessorLastName"] . "- Email: " . $row["EmailId"] .  "- Department: " . $row["Department"] . "- Part: " . $row["Part"] .  " &nbsp;&nbsp;" . "<a style=\"color:red \" href=\"action\\admin_professor_delete.php\\?DeleteId="  . $row["MemberId"] . "\">Delete</a>" . "&nbsp;&nbsp;" . "<a style=\"color:#131352 \" href=\"action\\admin_professor_update.php\\?UpdateId=" . $row["MemberId"] . "\">Update</a></li>";
            }
        } else {
            echo "No Professor";
        }
        $con->close();
    }
}


// get subjects in selectsubject
if (isset($_POST['prof'])) {
    $prof = $_POST['prof'];
    $prof = explode(' ', $prof);
    $prof1 = $prof[0];
    $prof2 = $prof[1];

    $con = get_con();
    $sql = "SELECT * FROM professor WHERE ProfessorFirstName = '$prof1' AND ProfessorLastName = '$prof2'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $department = $row['Department'];


    $sql = "SELECT DISTINCT Class FROM subject WHERE Department = '$department' ";
    $result = $con->query($sql);

    echo "<option value=\"--\">--</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value=" . $row["Class"] . ">" . $row["Class"] . "</option>";
    }

    $con->close();
}

// get subject for select subject
if (isset($_POST['class1']) && isset($_POST['sem'])) {

    // get subject for timetable as two post quers match so inside
    if (isset($_POST['class1']) && isset($_POST['sem']) && isset($_POST['acad']) && isset($_POST['div'])) {
        $con = get_con();

        $sem = $_POST['sem'];
        $class1 = $_POST['class1'];
        $acad = $_POST['acad'];
        $div = $_POST['div'];






        // get timming information
        $sql = "SELECT * FROM timeslot";
        $result = $con->query($sql);

        $timming = [];

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $temp = $row["StartTime"] . "-" . $row["EndTime"];
                array_push($timming, $temp);
            }
        } else {
            echo "No Timeslot";
        };

        // get info from subject
        $con->close();
    } else {

        $con = get_con();
        $sem = $_POST['sem'];
        $class1 = $_POST['class1'];
        $sql = "SELECT SubjectCode FROM subject WHERE Semester = '$sem' AND Class = '$class1'";
        $result = $con->query($sql);
        echo "<option value=\"--\">--</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["SubjectName"] . ">" . $row["SubjectName"] . "</option>";
        }
        $con->close();
    }
}

//get sem for timetable for
if (isset($_POST['class5'])) {
    $class1 =  $_POST['class5'];
    $con = get_con();
    $sql = "SELECT DISTINCT Semester FROM subject WHERE Class = '$class1'";
    $result = $con->query($sql);
    echo "<option value=\"--\">--</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value=" . $row["Semester"] . ">" . $row["Semester"] . "</option>";
    }
    $con->close();
}

//get sub for timetable for
if (isset($_POST['class4'])) {
    $class1 =  $_POST['class4'];
    $con = get_con();
    $sql = "SELECT DISTINCT * FROM subject WHERE Semester = '$class1'";
    $result = $con->query($sql);
    echo "<option value=\"--\">--</option>";
    echo "<option value=\"break\">break</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value=" . $row["SubjectCode"] . ">" . $row["SubjectCode"] . "</option>";
    }
    $con->close();
}


// set Subjects in array format
if (isset($_POST["time"]) && isset($_POST["mon"]) && isset($_POST["tue"]) && isset($_POST["wed"]) && isset($_POST["thu"]) && isset($_POST["fri"]) && isset($_POST["sat"])) {
    $time = explode(",", $_POST["time"]);
    $mon = explode(",", $_POST["mon"]);
    $tue = explode(",", $_POST["tue"]);
    $wed = explode(",", $_POST["wed"]);
    $thu = explode(",", $_POST["thu"]);
    $fri = explode(",", $_POST["fri"]);
    $sat = explode(",", $_POST["sat"]);
    $academic_year = $_POST["acad"];
    $room = $_POST["room"];
    $division = $_POST["div"];
    $semester = $_POST["sem"];
    $class1 = $_POST["class9"];
    $part = $_POST["part"];
    $member = $_POST["mem"];


    // get department from class viw subject
    $department = "";
    //get sub for timetable for
    $class1 =  $_POST['class9'];
    $con = get_con();
    $sql = "SELECT DISTINCT * FROM subject WHERE Class = '$class1'";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $department = $row['Department'];
    }



    // (`AcademicYear`, `RoomNo`, `TimeSlot`, `Day`, `Division`, `SubjectCode`, `Department`, `MemberId`, `Date`, `Division1`, `Division2`, `Division3`, `SubjectCode1`, `Division11`, `Division12`, `Division13`, `Division14`, `Part`, `Sem`, `Class`)


    // echo $sql;

    for ($i = 0; $i < count($time); $i++) {
        $sql = "INSERT INTO `timetable` VALUES ('$academic_year','$room','$time[$i]','Monday','$division','$mon[$i]','$department','$member',current_timestamp(),'--','--','--','--','--','--','--','--','$part','$semester','$class1');";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            $flag = 1;
        } else {
            $flag = 0;
        }
    }

    for ($i = 0; $i < count($time); $i++) {
        $sql = "INSERT INTO `timetable` VALUES ('$academic_year','$room','$time[$i]','Tuesday','$division','$tue[$i]','$department','$member',current_timestamp(),'--','--','--','--','--','--','--','--','$part','$semester','$class1')";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            $flag = 1;
        } else {
            $flag = 0;
        }
    }

    for ($i = 0; $i < count($time); $i++) {
        $sql = "INSERT INTO `timetable` VALUES ('$academic_year','$room','$time[$i]','Wednesday','$division','$wed[$i]','$department','$member',current_timestamp(),'--','--','--','--','--','--','--','--','$part','$semester','$class1')";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            $flag = 1;
        } else {
            $flag = 0;
        }
    }

    for ($i = 0; $i < count($time); $i++) {
        $sql = "INSERT INTO `timetable` VALUES ('$academic_year','$room','$time[$i]','Thursday','$division','$thu[$i]','$department','$member',current_timestamp(),'--','--','--','--','--','--','--','--','$part','$semester','$class1')";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            $flag = 1;
        } else {
            $flag = 0;
        }
    }

    for ($i = 0; $i < count($time); $i++) {
        $sql = "INSERT INTO `timetable` VALUES ('$academic_year','$room','$time[$i]','Friday','$division','$fri[$i]','$department','$member',current_timestamp(),'--','--','--','--','--','--','--','--','$part','$semester','$class1')";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            $flag = 1;
        } else {
            $flag = 0;
        }
    }

    for ($i = 0; $i < count($time); $i++) {
        $sql = "INSERT INTO `timetable` VALUES ('$academic_year','$room','$time[$i]','Saturday','$division','$sat[$i]','$department','$member',current_timestamp(),'--','--','--','--','--','--','--','--','$part','$semester','$class1')";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            $flag = 1;
        } else {
            $flag = 0;
        }
    }

    if ($flag === 1) {
        echo "<script>alert('Class Timetable for Class " . $class1 . " In Room " . $room . " Successfully Registered');</script>";
    } else {
        echo "<script>alert('Something went wrong or Timetable for the Class " . $class1 . " In Room " . $room . " Already Exsists');</script>";
    }


    $con->close();
}
ob_end_flush();
?>
<!DOCTYPE html>