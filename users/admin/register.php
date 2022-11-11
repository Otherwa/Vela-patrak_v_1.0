<?php
ob_start();
include("../../config/connect.php");

$status = get_con();

session_start();

// checks if the admin has privileges to do so
if (!isset($_SESSION['name']) && !isset($_SESSION['type'])) {
    // redirect if not set
    header("Location:../account/login.php");
} else {
    $type = $_SESSION['type'];
    if ($type == "member") {
        header("Location:../account/login.php");
    }
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

    if ($firstname == " " && $lastname == " " && $department == " " && $email == " " && $phone == " " && $username && $password == " " && $type == " ") {
        echo '<script>alert(\'Kindly Fill the Form Correctly\');</script>';
    } else if (strlen($password) < 8) {
        echo '<script>alert(\'Password too short\');</script>';
    } else {
        $con = get_con();
        $sql = "SELECT * FROM `members` WHERE Username = '$username' AND Password = '$password' AND Email = '$email' AND Type = '$type';";

        $result = mysqli_query($con, $sql);
        $result_user_type = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            // check if user or admin and simple redirect to it
            echo "<script>alert('Account already exsists');</script>";
            // close connection
            mysqli_close($con);
        } else {
            register($firstname, $lastname, $department, $email, $phone, $username, $password, $type);
        }
    }
}

// login block ends here
function register($firstname, $lastname, $department, $email, $phone, $username, $password, $type)
{
    $con = get_con();
    $sql = "INSERT INTO `members` (`FirstName`, `LastName`, `Department`, `Email`, `Phone`, `Username`, `Password`, `Type`) VALUES ('$firstname','$lastname','$department','$email','$phone','$username','$password','$type');";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Account Created Successfully');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    $con->close();
}

//members list
function member_list()
{
    $con = get_con();
    $sql = "SELECT * FROM members";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . "id: " . $row["MemberId"] . " - Name: " . $row["FirstName"] . " " . $row["LastName"] . " - Email: " . $row["Email"] . " - Department: " . $row["Department"] . " - Type: " . $row["Type"] . " &nbsp;&nbsp;" . "<a style=\"color:red \" href=\"action\\admin_register_delete.php\\?DeleteId="  . $row["MemberId"] . "\">Delete</a>" . "&nbsp;&nbsp;" . "<a style=\"color:#131352 \" href=\"action\\admin_register_update.php\\?UpdateId=" . $row["MemberId"] . "\">Update</a></li>";
        }
    } else {
        echo "No Members";
    }
    $con->close();
}

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
    <title>Register</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../../account/login.php" class="w3-bar-item w3-button">Logout</a>
        <a href="../admin_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="register.php" class="w3-bar-item w3-button w3-black">Registration</a>
        <a href="timeslot.php" class="w3-bar-item w3-button">Time-Slot</a>
        <a href="professor.php" class="w3-bar-item w3-button">Professor</a>
        <a href="room.php" class="w3-bar-item w3-button">Room</a>
        <a href="course.php" class="w3-bar-item w3-button">Course</a>

    </div>
    <!-- Page Content -->

    <div class="">
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <code class="txt">
        <?php echo $_SESSION['name']; ?>
        <?php echo $_SESSION['id']; ?>
    </code>

    <div class="con_head">
        <p>Register</p>
    </div>
    <br>
    <div class="list">
        <p style="float:left">Members</p>
        <div id="_list" class="form  w3-margin w3-whitesmoke w3-bar-block"
            style="width:auto;height:50vh !important;overflow-y:scroll">
            <?php member_list(); ?>
        </div>
    </div>


    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:86vw">
            <div class="context">
                <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
                <p>Register User as</p>
            </div>
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
                    autocomplete="off">
                <label for="" class="form__label">Email</label>
            </div>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="Phone" id="Phone" placeholder="e.g 8828*****"
                    autocomplete="off">
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
                <input type="password" class="form__input" name="Password" id="Password" placeholder="e.g xyz@1234"
                    autocomplete="off">
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