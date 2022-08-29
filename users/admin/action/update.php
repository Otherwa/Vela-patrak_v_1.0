<?php
include("../../../config/connect.php");
ob_start();

if (isset($_GET['UpdateId'])) {
    $id = $_GET['UpdateId'];

    // get data from database
    $con = get_con();
    $sql = "SELECT * FROM members WHERE MemberId = $id;";
    $result_get = $con->query($sql);
    $result_get = $result_get->fetch_assoc();
}

//if user clicks on register button and  data gets updated on database
if (isset($_POST['update'])) {

    $con = get_con();

    $firstname =  $_POST['FirstName'];
    $lastname =  $_POST['LastName'];
    $department =  $_POST['Department'];
    $email =  $_POST['Emailid'];
    $phone = $_POST['Phone'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $type = $_POST['Type'];

    // Update
    $sql = "UPDATE `members` SET `FirstName` = '" . $firstname . "', `LastName`='" . $lastname . "', `Department`='" . $department . "', `Email`='" . $email . "',`Phone`='" . $phone . "',`Username`='" . $username . "',`Password`='" . $password . "',`Type`='" . $type . "' WHERE MemberId = '" . $id . "';";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Member Updated');</script>";
        header("Location:../../register.php");
    } else {
        echo $sql;
        echo "<script>alert('Something went wrong.');</script>";
    }
    $con->close();
}


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

    <link rel="stylesheet" href="../../../../css/main.css">
    <link rel="stylesheet" href="../../../../css/register.css">


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
        <p>Update User <?php echo $result_get["Username"] ?></p>
    </div>
    <br>

    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:66vw">
            <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
            <br>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="FirstName" id="FirstName" placeholder="e.g xyz"
                    autocomplete="off" value="<?php echo $result_get['FirstName']; ?>">
                <label for="" class="form__label">First Name</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="LastName" id="LastName" placeholder="e.g xyz@123"
                    autocomplete="off" value="<?php echo $result_get['LastName']; ?>">
                <label for="" class="form__label">Last Name</label>
            </div>
            <div class="form__div">
                <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Department:</label>
                <select name="Department" id="Type">
                    <option value="--">--</option>
                    <option value="BSc IT">BSc IT</option>
                    <option value="BAF">BAF</option>
                    <option value="BMS">BMS</option>
                    <option value="BCOM">BCOM</option>
                    <option value="BBI">BBI</option>
                    <option value="BSc BT">BSc BT</option>
                    <option value="Arts">Arts</option>
                    <option value="Commerce">Commerce</option>
                    <option value="Science">Science</option>
                    <option value="BA">BA</option>
                    <option value="Bsc">BSc</option>
                    <option value="BVoc">BVoc</option>
                    <option value="BAMMC">BAMMC</option>
                    <option value="MSc">MSc</option>
                    <option value="MCom">MCom</option>
                    <option value="Msc IT">MSc IT</option>
                    <option value="Msc BT">MSc BT</option>
                    <option value="Ph.D Arts">Ph.D Arts</option>
                    <option value="Ph.D Science">Ph.D Science</option>
                    <option value="PGDPCM">PGDPCM</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <br>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Emailid" id="Emailid" placeholder="e.g someone@gmail.com"
                    autocomplete="off" value="<?php echo $result_get['Email']; ?>">
                <label for="" class="form__label">Email</label>
            </div>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Phone" id="Phone" placeholder="e.g 8828*****"
                    autocomplete="off" value="<?php echo $result_get['Phone']; ?>">
                <label for="" class="form__label">Phone</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="Username" id="Username" placeholder="e.g xyz"
                    autocomplete="off" value="<?php echo $result_get['Username']; ?>">
                <label for="" class="form__label">Username</label>
            </div>
            <br>
            <div class="form__div">
                <input type="password" class="form__input" name="Password" id="Password" placeholder="e.g xyz@1234"
                    autocomplete="off" value="<?php echo $result_get['Password']; ?>">
                <label for="" class="form__label">Password</label>
            </div>
            <div class="form__div">
                <label for="Type" style="color:gray">Type:</label>
                <select name="Type" id="Type">
                    <option value="--">--</option>
                    <option value="admin">Admin</option>
                    <option value="member">Member</option>
                </select>
            </div>
            <br>
            <br>
            <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Update"
                name="update" style="float:right">
    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../../../js/main.js"></script>
    <script src="../../../../js/login.js"></script>
</body>

</html>