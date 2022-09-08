<?php
ob_start();
include("../../../config/connect.php");

if (isset($_GET['DeleteId'])) {
    $con = get_con();

    $id = $_GET['DeleteId'];

    $sql = "DELETE FROM rooms WHERE RoomNo = $id;";
    $result = $con->query($sql);
    if ($result) {
        header("Location:../../room.php");
    } else {
        echo "Something went wrong. Please try again.";
        header("Location:../../room.php");
    }
    $con->close();
}

ob_end_flush();
?>
<!DOCTYPE html>