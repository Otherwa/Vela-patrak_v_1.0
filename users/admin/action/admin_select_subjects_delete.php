<?php
ob_start();
include("../../../config/connect.php");

if (isset($_GET['DeletedId'])) {
    $con = get_con();

    $Professor = $_GET['DeletedId'];

    $sql = "DELETE FROM selectsubject WHERE ProfessorId = '" . $Professor . "'";
    $result = $con->query($sql);
    if ($result) {
        header("Location:../../select_subjects.php");
    } else {
        echo "Something went wrong. Please try again.";
        header("Location:../../select_subjects.php");
    }
    $con->close();
}

ob_end_flush();
?>
<!DOCTYPE html>