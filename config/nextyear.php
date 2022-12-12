<?php
ob_start();
include("./connect.php");
// http://localhost/Vela-patrak_v_1.0/config/nextyear.php?Next=Your KEy

if (isset($_GET['Next'])) {
    // your key config
    if ($_GET['Next'] == "TEST") {
        $con = get_con();
        $sql = "SELECT * FROM timetable";

        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $academic_year = "2022-2023";
            $room = $row['RoomNo'];
            $time = $row['TimeSlot'];
            $day = $row['Day'];
            $division = $row['Division'];
            $sub = $row['SubjectCode'];
            $department = $row['Department'];
            $member = $row['MemberId'];
            $div1 = $row['Division1'];
            $div2 = $row['Division2'];
            $div3 = $row['Division3'];
            $sub1 = $row['SubjectCode1'];
            $div4 = $row['Division4'];
            $div5 = $row['Division5'];
            $div6 = $row['Division6'];
            $part = $row['Part'];
            $semester = $row['Sem'];
            $class1 = $row['Class'];
            $sql1 = "INSERT INTO `timetable` VALUES (DEFAULT,'$academic_year','$room','$time','$day','$division','$sub','$department','$member',current_timestamp(),'$div1','$div2','$div3','$sub1','$div4','$div5','$div6','$part','$semester','$class1');";
            $con->query($sql1);
        }
        echo "Next year Done";
    } else {
        echo "Issue";
    }
}

ob_end_flush();
?>
<!DOCTYPE html>