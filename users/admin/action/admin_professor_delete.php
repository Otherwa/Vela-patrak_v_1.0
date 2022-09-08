<?php
ob_start();
include("../../../config/connect.php");

if (isset($_GET['DeleteId'])) {
    $con = get_con();

    $id = $_GET['DeleteId'];

    // check if the person is superadmin or note if yes cannot delete
    $sql = "SELECT * FROM professor WHERE ProfessorId  = '" . $id . "';";
    $result = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($result);

    if ($result["Type"] == 'superadmin') {
        echo "<script>alert(\"Acess Denied\");</script>";;
        header("Location:../../professor.php");
    } else {
        $sql = "DELETE FROM professor WHERE ProfessorId = $id;";
        $result = $con->query($sql);
        if ($result) {
            header("Location:../../professor.php");
        } else {
            echo "Something went wrong. Please try again.";
            header("Location:../../professor.php");
        }
        $con->close();
    }
}

ob_end_flush();
?>
<!DOCTYPE html>