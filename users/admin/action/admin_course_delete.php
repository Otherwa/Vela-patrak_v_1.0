<?php
ob_start();
include("../../../config/connect.php");

if (isset($_GET['DeleteId'])) {
    $con = get_con();

    $id = $_GET['DeleteId'];

    $sql = "SELECT * FROM course WHERE CourseId = '" . $id . "';";
    $result = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($result);

    $sql = "DELETE FROM course WHERE CourseId = '" . $id . "';";
        $result = $con->query($sql);
        if ($result) {
            header("Location:../../course.php");
        } else {
            echo "Something went wrong. Please try again.";
            header("Location:../../course.php");
        }
        $con->close();
}

ob_end_flush();
?>
<!DOCTYPE html>