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
    $cla = $_POST['cal'];
    $con = get_con();
    $sql = "SELECT DISTINCT * FROM subject WHERE Semester = '$class1' AND Class = '$cla'";
    $result = $con->query($sql);
    echo "<option value=\"--\">--</option>";
    echo "<option value=\"break\">break</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value=" . $row["SubjectCode"] . ">" . $row["SubjectName"] . "</option>";
    }
    $con->close();
}

//get sub for timetable for
if (isset($_POST['class990'])) {
    $con = get_con();
    $sql = "SELECT DISTINCT * FROM subject";
    $result = $con->query($sql);
    echo "<option value=\"--\">--</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value=" . $row["SubjectCode"] . ">" . $row["SubjectName"] . "</option>";
    }
    $con->close();
}

// set Subjects in array format one field unique
if (isset($_POST["time"])) {
    // time index from eg. monday,0
    $real_time = $_POST["time"];
    $real_time = (int) $real_time;

    // get timearr from database
    $time = (array) null;
    $con = get_con();
    $sql = "SELECT DISTINCT * FROM timeslot";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $data = $row['StartTime'] . " - " . $row["EndTime"];
        array_push($time, $data);
    }

    //get data
    $day = $_POST["day"];
    $academic_year = $_POST["acad"];
    $room = $_POST["room"];
    $division = $_POST["div"];
    $semester = $_POST["sem"];
    $class1 = $_POST["class9"];
    $part = $_POST["part"];
    $member = $_POST["mem"];
    $sub = $_POST["sub"];
    $check = $_POST["checked"];

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



    //(`AcademicYear`, `RoomNo`, `TimeSlot`, `Day`, `Division`, `SubjectCode`, `Department`, `MemberId`, `Date`, `Division1`, `Division2`, `Division3`, `SubjectCode1`, `Division11`, `Division12`, `Division13`, `Division14`, `Part`, `Sem`, `Class`)
    // 
    // check if timefor a room in Already present of a class in a an academic year
    $sql = "SELECT * FROM `timetable` WHERE AcademicYear = '$academic_year' AND RoomNo = '$room' AND TimeSlot = '$time[$real_time]' AND Day = '$day'";
    $result = $con->query($sql);
    $result1 = $result->fetch_assoc();
    $result = mysqli_num_rows($result);
    // echo $sql;
    // echo $result;

    if ($result > 0) {

        $div = $result1['Division'];
        $sub1 = $result1['SubjectCode'];
        $class11 = $result1['Class'];
        $sem = $result1['Sem'];

        if ($check == 'true') {
            // combined insert
            echo "<script>alert('Insert Combined');</script>";


            if ($class11 == $class1 && $sem == $semester) {
                if ($result1['Division1'] == '--') {
                    $sql =  "UPDATE `timetable` SET `Division1` = '$division' WHERE `AcademicYear` = '$academic_year' AND `RoomNo` = '$room' AND `Day` = '$day' AND `TimeSlot` = '$time[$real_time]' AND `Division` = '$div' AND `Class` = '$class11';";
                    if ($con->query($sql) === TRUE) {
                        echo "<script>alert('Class Timetable for Class " . $class1 . " In Room " . $room . " Successfully Combined at " . $div . "Division" . "Subject" . $time[$real_time] . "');</script>";
                    } else {
                        echo "<script>alert('Something went wrong ');</script>";
                    }
                } elseif ($result1['Division2'] == '--') {
                    $sql = "UPDATE `timetable` SET `Division2` = '$division' WHERE `AcademicYear` = '$academic_year' AND `RoomNo` = '$room' AND `Day` = '$day' AND `TimeSlot` = '$time[$real_time]' AND `Division` = '$div' AND `Class` = '$class11';";
                    if ($con->query($sql) === TRUE) {
                        echo "<script>alert('Class Timetable for Class " . $class1 . " In Room " . $room . " Successfully Combined at " . $div . "Division" . "Subject" . $time[$real_time] . "');</script>";
                    } else {
                        echo "<script>alert('Something went wrong ');</script>";
                    }
                } elseif ($result1['Division3'] == '--') {
                    $sql = "UPDATE `timetable` SET `Division3` = '$division' WHERE `AcademicYear` = '$academic_year' AND `RoomNo` = '$room' AND `Day` = '$day' AND `TimeSlot` = '$time[$real_time]' AND `Division` = '$div' AND `Class` = '$class11';";
                    if ($con->query($sql) === TRUE) {
                        echo "<script>alert('Class Timetable for Class " . $class1 . " In Room " . $room . " Successfully Combined at " . $div . "Division" . "Subject" . $time[$real_time] . "');</script>";
                    } else {
                        echo "<script>alert('Something went wrong ');</script>";
                    }
                }
            } else {
                echo "<script>alert('Not Possible');</script>";
            }
        } else {
            echo "<script>alert('Room At that time already booked By " . $class11 . "sub" . $div . "');</script>";
        }
    } else {
        $sql = "INSERT INTO `timetable` VALUES (DEFAULT,'$academic_year','$room','$time[$real_time]','$day','$division','$sub','$department','$member',current_timestamp(),'--','--','--','--','--','--','--','$part','$semester','$class1');";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            $flag = 1;
        } else {
            $flag = 0;
        }

        if ($flag === 1) {
            echo "<script>alert('Class Timetable for Class " . $class1 . " In Room " . $room . " Successfully Registered at " . $time[$real_time] . "');</script>";
        } else {
            echo "<script>alert('Something went wrong  sfsd');</script>";
        }
    }
    // echo $sql;
    $con->close();
}

// complex Shit
// load time data 
if (isset($_POST['class101'])) {
    $class1 = $_POST['class101'];
    $year = $_POST['ad1'];
    $semester = $_POST['sem1'];
    $div = $_POST['div'];
    // echo $class1;
    $sql1 = "";
    $con = get_con();
    $sql = "SELECT * FROM timeslot";
    $result = $con->query($sql);
    // subject
    $i = 0;
    // timming
    $j = 0;
    while ($row = $result->fetch_assoc()) {


        $time_slot = $row["StartTime"] . " - " . $row["EndTime"];

        echo "<tr>";

        echo "<td id=\"time" . $j++ . "\"><span>" . $time_slot  . "</span></td>";

        // ----------------------------------------------
        // get subject for a day in a specfic timeslot
        $sql1 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division` = '$div'";
        $result1 = $con->query($sql1);
        $result1_num = mysqli_num_rows($result1);
        $result1 = $result1->fetch_assoc();


        $sql11 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division1` = '$div'";
        $result11 = $con->query($sql11);
        $result11_num = mysqli_num_rows($result11);
        $result11 = $result11->fetch_assoc();


        $sql111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division2` = '$div'";
        $result111 = $con->query($sql111);
        $result111_num = mysqli_num_rows($result111);
        $result111 = $result111->fetch_assoc();


        $sql1111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division3` = '$div'";
        $result1111 = $con->query($sql111);
        $result1111_num = mysqli_num_rows($result1111);
        $result1111 = $result1111->fetch_assoc();

        $sql11111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division4` = '$div'";
        $result11111 = $con->query($sql11111);
        $result11111_num = mysqli_num_rows($result11111);
        $result11111 = $result11111->fetch_assoc();

        if ($result1_num > 0) {
            // echo $result1;
            $getname = $result1["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"Monday\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"Monday\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"Monday\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result1111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"Monday\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"Monday\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } else {
            echo "<td>" . "<div id=\"null\"><p>" . " " . "</p></div>" . "</td>";
        }
        // /-----------------------------------------/ 

        // ----------------------------------------------
        // get subject for a day in a specfic timeslot
        $sql1 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Tuesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division` = '$div'";
        $result1 = $con->query($sql1);
        $result1_num = mysqli_num_rows($result1);
        $result1 = $result1->fetch_assoc();


        $sql11 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Tuesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division1` = '$div'";
        $result11 = $con->query($sql11);
        $result11_num = mysqli_num_rows($result11);
        $result11 = $result11->fetch_assoc();


        $sql111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Tuesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division2` = '$div'";
        $result111 = $con->query($sql111);
        $result111_num = mysqli_num_rows($result111);
        $result111 = $result111->fetch_assoc();


        $sql1111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Tuesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division3` = '$div'";
        $result1111 = $con->query($sql111);
        $result1111_num = mysqli_num_rows($result1111);
        $result1111 = $result1111->fetch_assoc();

        $sql11111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Tuesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division4` = '$div'";
        $result11111 = $con->query($sql11111);
        $result11111_num = mysqli_num_rows($result11111);
        $result11111 = $result11111->fetch_assoc();

        if ($result1_num > 0) {
            // echo $result1;
            $getname = $result1["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"T\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"T\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"T\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result1111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"T\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"T\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } else {
            echo "<td>" . "<div id=\"null\"><p>" . " " . "</p></div>" . "</td>";
        }
        // /-----------------------------------------/ 

        // ----------------------------------------------
        // get subject for a day in a specfic timeslot
        $sql1 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Wednesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division` = '$div'";
        $result1 = $con->query($sql1);
        $result1_num = mysqli_num_rows($result1);
        $result1 = $result1->fetch_assoc();

        $sql11 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Wednesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division1` = '$div'";
        $result11 = $con->query($sql11);
        $result11_num = mysqli_num_rows($result11);
        $result11 = $result11->fetch_assoc();


        $sql111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Wednesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division2` = '$div'";
        $result111 = $con->query($sql111);
        $result111_num = mysqli_num_rows($result111);
        $result111 = $result111->fetch_assoc();


        $sql1111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Wednesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division3` = '$div'";
        $result1111 = $con->query($sql111);
        $result1111_num = mysqli_num_rows($result1111);
        $result1111 = $result1111->fetch_assoc();

        $sql11111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Wednesday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division4` = '$div'";
        $result11111 = $con->query($sql11111);
        $result11111_num = mysqli_num_rows($result11111);
        $result11111 = $result11111->fetch_assoc();

        if ($result1_num > 0) {
            // echo $result1;
            $getname = $result1["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"W\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"W\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"W\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result1111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"W\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"Monday\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } else {
            echo "<td>" . "<div id=\"null\"><p>" . " " . "</p></div>" . "</td>";
        }
        // /-----------------------------------------/ 
        // ----------------------------------------------
        // get subject for a day in a specfic timeslot
        $sql1 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Thursday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division` = '$div'";
        $result1 = $con->query($sql1);
        $result1_num = mysqli_num_rows($result1);
        $result1 = $result1->fetch_assoc();



        $sql11 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Thursday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division1` = '$div'";
        $result11 = $con->query($sql11);
        $result11_num = mysqli_num_rows($result11);
        $result11 = $result11->fetch_assoc();


        $sql111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Thursday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division2` = '$div'";
        $result111 = $con->query($sql111);
        $result111_num = mysqli_num_rows($result111);
        $result111 = $result111->fetch_assoc();


        $sql1111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Thursday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division3` = '$div'";
        $result1111 = $con->query($sql111);
        $result1111_num = mysqli_num_rows($result1111);
        $result1111 = $result1111->fetch_assoc();

        $sql11111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Thursday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division4` = '$div'";
        $result11111 = $con->query($sql11111);
        $result11111_num = mysqli_num_rows($result11111);
        $result11111 = $result11111->fetch_assoc();

        if ($result1_num > 0) {
            // echo $result1;
            $getname = $result1["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"Monday\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"TH\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"TH\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result1111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"TH\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"TH\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } else {
            echo "<td>" . "<div id=\"null\"><p>" . " " . "</p></div>" . "</td>";
        }
        // /-----------------------------------------/ 
        // ----------------------------------------------
        // get subject for a day in a specfic timeslot
        $sql1 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Friday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division` = '$div'";
        $result1 = $con->query($sql1);
        $result1_num = mysqli_num_rows($result1);
        $result1 = $result1->fetch_assoc();



        $sql11 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Friday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division1` = '$div'";
        $result11 = $con->query($sql11);
        $result11_num = mysqli_num_rows($result11);
        $result11 = $result11->fetch_assoc();


        $sql111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Friday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division2` = '$div'";
        $result111 = $con->query($sql111);
        $result111_num = mysqli_num_rows($result111);
        $result111 = $result111->fetch_assoc();


        $sql1111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Friday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division3` = '$div'";
        $result1111 = $con->query($sql111);
        $result1111_num = mysqli_num_rows($result1111);
        $result1111 = $result1111->fetch_assoc();

        $sql11111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Friday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division4` = '$div'";
        $result11111 = $con->query($sql11111);
        $result11111_num = mysqli_num_rows($result11111);
        $result11111 = $result11111->fetch_assoc();

        if ($result1_num > 0) {
            // echo $result1;
            $getname = $result1["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"F\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"F\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"F\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result1111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"F\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"F\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } else {
            echo "<td>" . "<div id=\"null\"><p>" . " " . "</p></div>" . "</td>";
        }
        // /-----------------------------------------/ 
        // ----------------------------------------------
        // get subject for a day in a specfic timeslot
        $sql1 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Saturday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division` = '$div'";
        $result1 = $con->query($sql1);
        $result1_num = mysqli_num_rows($result1);
        $result1 = $result1->fetch_assoc();



        $sql11 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Saturday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division1` = '$div'";
        $result11 = $con->query($sql11);
        $result11_num = mysqli_num_rows($result11);
        $result11 = $result11->fetch_assoc();


        $sql111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Saturday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division2` = '$div'";
        $result111 = $con->query($sql111);
        $result111_num = mysqli_num_rows($result111);
        $result111 = $result111->fetch_assoc();


        $sql1111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Saturday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division3` = '$div'";
        $result1111 = $con->query($sql111);
        $result1111_num = mysqli_num_rows($result1111);
        $result1111 = $result1111->fetch_assoc();

        $sql11111 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Saturday' AND `Sem` = '$semester' AND `Class` ='$class1' AND `Division4` = '$div'";
        $result11111 = $con->query($sql11111);
        $result11111_num = mysqli_num_rows($result11111);
        $result11111 = $result11111->fetch_assoc();

        if ($result1_num > 0) {
            // echo $result1;
            $getname = $result1["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"S\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"S\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"S\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result1111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"S\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } elseif ($result11111_num > 0) {
            $getname = $result11["SubjectCode"];
            $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
            $result1 = $con->query($sql1);
            $result1 = $result1->fetch_assoc();

            echo "<td>" . "<div id=\"S\"><p>" . $result1["SubjectName"] . "</p></div>" . "</td>";
        } else {
            echo "<td>" . "<div id=\"null\"><p>" . " " . "</p></div>" . "</td>";
        }
        // /-----------------------------------------/ 
        echo "</tr>";
        $i++;
    }
}

// delete timetable by id
if (isset($_POST['Idto'])) {
    $con = get_con();
    $id = $_POST['Idto'];
    $sql = "DELETE FROM `timetable` WHERE Id = '$id'";
    $result = $con->query($sql);
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('$id" . "Deleted" . "');</script>";
    } else {
        echo "<script>alert('Something went wrong ');</script>";
    }
}



// delete timetable data class=""
if (isset($_POST['class303'])) {
    $class1 = $_POST['class303'];
    $year = $_POST['ad2'];
    $semester = $_POST['sem2'];
    $div = $_POST['div2'];
    // echo $class1;
    $sql1 = "";
    $con = get_con();
    $sql = "SELECT * FROM timeslot";
    $result = $con->query($sql);
    // subject
    $i = 0;
    // timming
    $j = 0;
    while ($row = $result->fetch_assoc()) {


        $time_slot = $row["StartTime"] . " - " . $row["EndTime"];

        echo "<tr>";

        echo "<td id=\"time" . $j++ . "\"><span>" . $time_slot  . "</span></td>";

        // get subject for a day in a specfic timeslot
        $sql1 = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday' AND `Sem` = '$semester' AND `Class` ='$class1' AND Division = '$div'";
        $result1 = $con->query($sql1);
        $result1 = $result1->fetch_assoc();
        // echo $result1;
        $getname = $result1["SubjectCode"];

        // code to name
        $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        echo "<td >" . "<p id=\"" . $result1["Id"] . "\">" . $result2["SubjectName"] . "</p>" . "</td>";

        $sql1 = "SELECT * FROM timetable WHERE Class = '$class1' AND TimeSlot = '$time_slot' AND Day = 'Tuesday' AND AcademicYear = '$year' AND Sem = '$semester' AND Division = '$div'";
        $result1 = $con->query($sql1);
        $result1 = $result1->fetch_assoc();

        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        echo "<td >" . "<p id=\"" . $result1["Id"] . "\">" . $result2["SubjectName"] . "</p>" . "</td>";

        $sql1 = "SELECT * FROM timetable WHERE Class = '$class1' AND TimeSlot = '$time_slot' AND Day = 'Wednesday' AND AcademicYear = '$year' AND Sem = '$semester' AND Division = '$div'";
        $result1 = $con->query($sql1);
        $result1 = $result1->fetch_assoc();


        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();


        echo "<td >" . "<p id=\"" . $result1["Id"] . "\">" . $result2["SubjectName"] . "</p>" . "</td>";

        $sql1 = "SELECT * FROM timetable WHERE Class = '$class1' AND TimeSlot = '$time_slot' AND Day = 'Thursday' AND AcademicYear = '$year' AND Sem = '$semester' AND Division = '$div'";
        $result1 = $con->query($sql1);
        $result1 = $result1->fetch_assoc();

        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();


        echo "<td >" . "<p id=\"" . $result1["Id"] . "\">" . $result2["SubjectName"] . "</p>" . "</td>";

        $sql1 = "SELECT * FROM timetable WHERE Class = '$class1' AND TimeSlot = '$time_slot' AND Day = 'Friday' AND AcademicYear = '$year' AND Sem = '$semester' AND Division = '$div'";
        $result1 = $con->query($sql1);
        $result1 = $result1->fetch_assoc();

        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();


        echo "<td >" . "<p id=\"" . $result1["Id"] . "\">" . $result2["SubjectName"] . "</p>" . "</td>";

        $sql1 = "SELECT * FROM timetable WHERE Class = '$class1' AND TimeSlot = '$time_slot' AND Day = 'Saturday' AND AcademicYear = '$year' AND Sem = '$semester' AND Division = '$div'";
        $result1 = $con->query($sql1);
        $result1 = $result1->fetch_assoc();

        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE SubjectCode = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();


        echo "<td >" . "<p id=\"" . $result1["Id"] . "\">" . $result2["SubjectName"] . "</p>" . "</td>";

        echo "</tr>";
        $i++;
    }
}

// room timetable
if (isset($_POST["class202"])) {
    $year = $_POST['ad6'];
    $room = $_POST['room'];
    // echo $class1;
    $sql1 = "";
    $con = get_con();
    $sql = "SELECT * FROM timeslot";
    $result = $con->query($sql);
    // timming
    $j = 0;
    while ($row = $result->fetch_assoc()) {


        $time_slot = $row["StartTime"] . " - " . $row["EndTime"];

        echo "<tr>";

        echo "<td id=\"time" . $j++ . "\"><span>" . $time_slot  . "</span></td>";

        // get subject for a day in a specfic timeslot
        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday' AND `RoomNo` = '$room'";

        $result1 = $con->query($sql);
        $result1 = $result1->fetch_assoc();
        // echo $result1;
        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        $getname1 = $result1["SubjectCode1"];

        $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
        $result3 = $con->query($sql2);
        $result3 = $result3->fetch_assoc();


        echo "<td>" . "<div id=\"Monday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"]  . "</p></div>" . "</td>";

        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Tuesday' AND `RoomNo` = '$room'";

        $result1 = $con->query($sql);
        $result1 = $result1->fetch_assoc();
        // echo $result1;
        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        $getname1 = $result1["SubjectCode1"];

        $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
        $result3 = $con->query($sql2);
        $result3 = $result3->fetch_assoc();


        echo "<td>" . "<div id=\"Tuesday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"]  . "</p></div>" . "</td>";


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Wednesday' AND `RoomNo` = '$room'";

        $result1 = $con->query($sql);
        $result1 = $result1->fetch_assoc();
        // echo $result1;
        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        $getname1 = $result1["SubjectCode1"];

        $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
        $result3 = $con->query($sql2);
        $result3 = $result3->fetch_assoc();


        echo "<td>" . "<div id=\"Wednesday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"]  . "</p></div>" . "</td>";


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Thursday' AND `RoomNo` = '$room'";

        $result1 = $con->query($sql);
        $result1 = $result1->fetch_assoc();
        // echo $result1;
        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        $getname1 = $result1["SubjectCode1"];

        $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
        $result3 = $con->query($sql2);
        $result3 = $result3->fetch_assoc();


        echo "<td>" . "<div id=\"Thursday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"]  . "</p></div>" . "</td>";


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Friday' AND `RoomNo` = '$room'";

        $result1 = $con->query($sql);
        $result1 = $result1->fetch_assoc();
        // echo $result1;
        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        $getname1 = $result1["SubjectCode1"];

        $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
        $result3 = $con->query($sql2);
        $result3 = $result3->fetch_assoc();


        echo "<td>" . "<div id=\"Friday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"]  . "</p></div>" . "</td>";


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Saturday' AND `RoomNo` = '$room'";

        $result1 = $con->query($sql);
        $result1 = $result1->fetch_assoc();
        // echo $result1;
        $getname = $result1["SubjectCode"];

        $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
        $result2 = $con->query($sql1);
        $result2 = $result2->fetch_assoc();

        $getname1 = $result1["SubjectCode1"];

        $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
        $result3 = $con->query($sql2);
        $result3 = $result3->fetch_assoc();


        echo "<td>" . "<div id=\"Saturday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"]  . "</p></div>" . "</td>";

        echo "</tr>";
    }
}





if (isset($_POST['ad69'])) {
    $year = $_POST['ad69'];

    // echo $class1;
    $sql1 = "";
    $con = get_con();
    $sql = "SELECT * FROM timeslot";
    $result = $con->query($sql);
    // timming
    $j = 0;

    while ($row = $result->fetch_array()) {

        $time_slot = $row["StartTime"] . " - " . $row["EndTime"];

        echo "<tr>";

        echo "<td id=\"time" . $j++ . "\"><span>" . $time_slot  . "</span></td>";

        // get subject for a day in a specfic timeslot
        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Monday'";
        $result0 = $con->query($sql);
        // echo $result1;
        echo "<td>";

        while ($result1 = $result0->fetch_array()) {
            $getname = $result1["SubjectCode"];

            $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
            $result2 = $con->query($sql1);
            $result2 = $result2->fetch_assoc();

            $getname1 = $result1["SubjectCode1"];

            $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
            $result3 = $con->query($sql2);
            $result3 = $result3->fetch_assoc();


            echo  "<div id=\"Monday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"] . "<br>Room:" . $result1["RoomNo"] . "</p></div>";
        }


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Tuesday'";
        $result0 = $con->query($sql);
        // echo $result1;
        echo "<td>";

        while ($result1 = $result0->fetch_array()) {
            $getname = $result1["SubjectCode"];

            $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
            $result2 = $con->query($sql1);
            $result2 = $result2->fetch_assoc();

            $getname1 = $result1["SubjectCode1"];

            $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
            $result3 = $con->query($sql2);
            $result3 = $result3->fetch_assoc();


            echo  "<div id=\"Monday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"] . "<br>Room:" . $result1["RoomNo"] . "</p></div>";
        }


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Wednesday'";
        $result0 = $con->query($sql);
        // echo $result1;
        echo "<td>";

        while ($result1 = $result0->fetch_array()) {
            $getname = $result1["SubjectCode"];

            $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
            $result2 = $con->query($sql1);
            $result2 = $result2->fetch_assoc();

            $getname1 = $result1["SubjectCode1"];

            $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
            $result3 = $con->query($sql2);
            $result3 = $result3->fetch_assoc();


            echo  "<div id=\"Monday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"] . "<br>Room:" . $result1["RoomNo"] . "</p></div>";
        }


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Thursday'";
        $result0 = $con->query($sql);
        // echo $result1;
        echo "<td>";

        while ($result1 = $result0->fetch_array()) {
            $getname = $result1["SubjectCode"];

            $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
            $result2 = $con->query($sql1);
            $result2 = $result2->fetch_assoc();

            $getname1 = $result1["SubjectCode1"];

            $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
            $result3 = $con->query($sql2);
            $result3 = $result3->fetch_assoc();


            echo  "<div id=\"Monday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"] . "<br>Room:" . $result1["RoomNo"] . "</p></div>";
        }


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Friday'";
        $result0 = $con->query($sql);
        // echo $result1;
        echo "<td>";

        while ($result1 = $result0->fetch_array()) {
            $getname = $result1["SubjectCode"];

            $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
            $result2 = $con->query($sql1);
            $result2 = $result2->fetch_assoc();

            $getname1 = $result1["SubjectCode1"];

            $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
            $result3 = $con->query($sql2);
            $result3 = $result3->fetch_assoc();


            echo  "<div id=\"Monday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"] . "<br>Room:" . $result1["RoomNo"] . "</p></div>";
        }


        $sql = "SELECT * FROM timetable  WHERE `AcademicYear` = '$year' AND `TimeSlot` = '$time_slot' AND `Day` = 'Saturday'";
        $result0 = $con->query($sql);
        // echo $result1;
        echo "<td>";

        while ($result1 = $result0->fetch_array()) {
            $getname = $result1["SubjectCode"];

            $sql1 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname'";
            $result2 = $con->query($sql1);
            $result2 = $result2->fetch_assoc();

            $getname1 = $result1["SubjectCode1"];

            $sql2 = "SELECT * FROM subject WHERE `SubjectCode` = '$getname1'";
            $result3 = $con->query($sql2);
            $result3 = $result3->fetch_assoc();


            echo  "<div id=\"Monday\"><p>" . $result1["Class"] . " - " . $result1["Division"] . " / " . $result1["Division1"] . "<br>" . $result2["SubjectName"] .  " - " . $result3["SubjectName"] . "<br>" . $result1["Department"] . "<br>Room:" . $result1["RoomNo"] . "</p></div>";
        }

        echo "</td>";
    }
}
// room timetabel

ob_end_flush();
?>
<!DOCTYPE html>