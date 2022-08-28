<?php
ob_start();
include("../../config/connect.php");

$status = get_con();

session_start();

// checks if the admin has privileges to do so
if (!isset($_SESSION['name'])) {
    // redirect if not set
    header("Location:../account/login.php");
}


// login block starts here
if (isset($_POST['register'])) {
    $firstname =  $_POST['FirstName'];
    $lastname =  $_POST['LastName'];
    $department =  $_POST['Department'];
    $email =  $_POST['Emailid'];
    $phone = $_POST['Phone'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $type = $_POST['Type'];

    $con = get_con();
    $sql = "SELECT * FROM `members` WHERE Username = '$username' AND Password = '$password';";

    $result = mysqli_query($con, $sql);
    $result_user_type = mysqli_fetch_array($result);
    $row = mysqli_num_rows($result);

    if ($row > 0) {

        // check if user or admin and simple redirect to it
        echo "<script>alert('Account already exsists');</script>";
        // close connection
        mysqli_close($con);
    } else {

        // if no member then insert
        $sql = "INSERT INTO `members` (`FirstName`, `LastName`, `Department`, `Email`, `Phone`, `Username`, `Password`, `Type`) VALUES ('$firstname','$lastname','$department','$email','$phone','$username','$password','$type');";
        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Account Created Successfully');</script>";
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
        $con->close();
    }
}
// login block ends here

// for cheching 
// echo $status;
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

    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/register.css">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Home</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../admin_dashboard.php" class="w3-bar-item w3-button ">Dashboard</a>
        <a href="register.php" class="w3-bar-item w3-button w3-orange">Registration</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
    </div>
    <!-- Page Content -->

    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>Register</p>
    </div>
    <br>
    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:33rem">
            <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
            <br>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="FirstName" id="FirstName" placeholder="e.g xyz"
                    autocomplete="off">
                <label for="" class="form__label">First Name</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="LastName" id="LastName" placeholder="e.g xyz@123"
                    autocomplete="off">
                <label for="" class="form__label">Last Name</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="Department" id="Department" placeholder="e.g xyz"
                    autocomplete="off">
                <label for="" class="form__label">Department</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="Emailid" id="Emailid" placeholder="e.g someone@gmail.com"
                    autocomplete="off">
                <label for="" class="form__label">Email</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="Phone" id="Phone" placeholder="e.g xyz" autocomplete="off">
                <label for="" class="form__label">Phone</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="Username" id="Username" placeholder="e.g xyz"
                    autocomplete="off">
                <label for="" class="form__label">Username</label>
            </div>
            <br>

            <div class="form__div">
                <input type="password" class="form__input" name="Password" id="Password" placeholder="e.g xyz"
                    autocomplete="off">
                <label for="" class="form__label">Password</label>
            </div>

            <select name="Type" id="Type">
                <option value="admin">Admin</option>
                <option value="member">Member</option>
            </select>
            <br>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Register"
                name="register" style="float:right">

    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/login.js"></script>
</body>

</html>