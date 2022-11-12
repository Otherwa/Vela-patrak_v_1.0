<?php
ob_start();
include("../../../config/connect.php");

if (isset($_GET['DeleteId'])) {
    $con = get_con();

    $Subject = $_GET['DeleteId'];

    $sql = "DELETE FROM subject WHERE SubjectCode = '" . $Subject . "'";
    $result = $con->query($sql);
    if ($result) {
        header("Location:../../subject.php");
    } else {
        echo "Something went wrong. Please try again.";
        header("Location:../../subject.php");
    }
    $con->close();
}

ob_end_flush();
?>
<!DOCTYPE html>