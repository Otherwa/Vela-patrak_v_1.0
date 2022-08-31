<?php
ob_start();
include("../../../config/connect.php");

if (isset($_GET['DeleteId'])) {
    $con = get_con();

    $id = $_GET['DeleteId'];
    $sql = "DELETE FROM members WHERE MemberId = $id;";

    $result = $con->query($sql);

    if ($result) {
        header("Location:../../register.php");
    } else {
        echo "Error";
        header("Location:../../register.php");
    }
    $con->close();
}

ob_end_flush();
?>
<!DOCTYPE html>