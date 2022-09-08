<?php
include("../../config/connect.php");

ob_start();

session_start();

if (!isset($_SESSION['name'])) {
    // redirect if not set
    header("Location:../account/login.php");
}

// session passes id
$id = $_SESSION['id'];

if (isset($_POST['save'])) {
    $professorfirstname =  $_POST['ProfessorFirstName'];
    $professorlastname =  $_POST['ProfessorLastName'];
    $department =  $_POST['Department'];
    $memberid =  $id; //is member id of login generated at login
    $emailid =  $_POST['EmailId'];
    $phone =  $_POST['Phone'];
    $part =  $_POST['Part'];

    if ($professorfirstname == " " && $professorlastname == " " && $department == " " && $part == " " && $memberid == " ") {
        echo '<script>alert(\'Kindly Fill the Form Correctly\');</script>';
    } else {
        $con = get_con();
        $sql = "SELECT * FROM `professor` WHERE ProfessorFirstName = '" . $professorfirstname . "'";

        $result = mysqli_query($con, $sql);
        $result_user_type = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            // check if timeslot already exists or not simple redirect to it
            echo "<script>alert('Professor already exsists');</script>";
            // close connection
            mysqli_close($con);
        } else {
            insert_professor($professorfirstname, $professorlastname, $department, $memberid, $emailid, $phone, $part);
        }
    }
}

function insert_professor($professorfirstname, $professorlastname, $memberid, $department, $emailid, $phone, $part)
{
    $con = get_con();
    $sql = "INSERT INTO `professor` (`ProfessorFirstName`, `ProfessorLastName`, `Department`, `MemberId`, `EmailId`, `Phone`, `Part`, `Date`) VALUES ('$professorfirstname', '$professorlastname', '$memberid', '$department', '$emailid', '$phone', '$part',current_timestamp());";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Professor Successfully Registered');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    $con->close();
}

function professor()
{
    $con = get_con();
    $sql = "SELECT * FROM professor";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . "id: " . $row["ProfessorId"] . " -Name: " . $row["ProfessorFirstName"] . $row["ProfessorLastName"] . "- Email: " . $row["EmailId"] .  "- Department: " . $row["Department"] . "- Part: " . $row["Part"] .  " &nbsp;&nbsp;" . "<a style=\"color:red \" href=\"action\\admin_professor_delete.php\\?DeleteId="  . $row["MemberId"] . "\">Delete</a>" . "&nbsp;&nbsp;" . "<a style=\"color:#131352 \" href=\"action\\admin_professor_update.php\\?UpdateId=" . $row["MemberId"] . "\">Update</a></li>";
        }
    } else {
        echo "No Professor";
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
    <!-- basic html required -->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/professor.css">
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Time-Table</title>
</head>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../../account/login.php" class="w3-bar-item w3-button">Logout</a>
        <a href="../admin_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="register.php" class="w3-bar-item w3-button">Registration</a>
        <a href="timeslot.php" class="w3-bar-item w3-button">Time-Slot</a>
        <a href="professor.php" class="w3-bar-item w3-button w3-black">Professor</a>
        <a href="room.php" class="w3-bar-item w3-button">Room</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
        <a href="#" class="w3-bar-item w3-button">Admin Feature 1</a>
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
        <p> Professors </p>
    </div>

    <div class="container">
        <div class="list">
            <p style="float:left">Professor List</p>
            <select name="ProfList" id="ProfList" onchange="get_professor()">
                <option value="--">--</option>
                <option value="PSYCHOLOGY">PSYCHOLOGY</option>
                <option value="FRENCH">FRENCH</option>
                <option value="SANSKRIT">SANSKRIT</option>
                <option value="ENGLISH">ENGLISH</option>
                <option value="MARATHI">MARATHI</option>
                <option value="POL.SCIENCE">POL.SCIENCE</option>
                <option value="HISTORY">HISTORY</option>
                <option value="SOCIOLOGY">SOCIOLOGY</option>
                <option value="ECONOMICS">ECONOMICS</option>
                <option value="MENTORING">MENTORING</option>
                <option value="EVS">EVS</option>
                <option value="RC">RC</option>
                <option value="PHY.EDN.">PHY.EDN.</option>
                <option value="UPSC">UPSC</option>
                <option value="HINDI">HINDI</option>
                <option value="JR AND DEGREE">JR AND DEGREE</option>
                <option value="FOUNDATION COURSE">FOUNDATION COURSE</option>
                <option value="INFORMATION TECHLOGY">INFORMATION TECHOLOGY</option>
                <option value="PHYSICS">PHYSICS</option>
                <option value="CHEMISTRY">CHEMISTRY</option>
                <option value="BIOLOGY">BIOLOGY</option>
                <option value="MATHEMATICS">MATHEMATICS</option>
                <option value="BOTANY">BOTANY</option>
                <option value="ZOOLOGY">ZOOLOGY</option>
                <option value="PRACTICALS">PRACTICALS</option>
                <option value="COMMERCE">COMMERCE</option>
                <option value="B.ECONOMICS">B. ECONOMICS</option>
                <option value="ACCOUNTS">ACCOUNTS</option>
                <option value="B.LAW">B.LAW</option>
                <option value="MCOM">MCOM</option>
                <option value="BVOC">BVOC</option>
                <option value="M.SC.IT">M.SC.IT</option>
                <option value="BIOTECHONOLOGY">BIOTECHONOLOGY</option>
                <option value="BAF">BAF</option>
                <option value="BBI">BBI</option>
                <option value="BMS">BMS</option>
                <option value="BMM">BMM</option>
            </select>
            <div id="prof_list" class=" form w3-margin w3-whitesmoke w3-bar-block"
                style="width:46vw;height:50vh;overflow-y:scroll">
                <?php professor(); ?>
            </div>
        </div>
        <br>
        <div class="l-form">
            <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:24rem;height:auto">
                <div class="context">
                    <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo"
                        style="height:3rem">
                    <p>Add Professor</p>
                </div>
                <br>
                <div class="form__div">
                    <input type="text" class="form__input" name="ProfessorFirstName" id="FirstName"
                        placeholder="e.g xyz" autocomplete="off">
                    <label for="" class="form__label">First Name</label>
                </div>
                <br>

                <div class="form__div">
                    <input type="text" class="form__input" name="ProfessorLastName" id="LastName" placeholder="e.g xyz"
                        autocomplete="off">
                    <label for="" class="form__label">Last Name</label>
                </div>
                <br>

                <div class="form__div">
                    <input type="text" class="form__input" name="Phone" id="PhoneNumber" placeholder="e.g xyz"
                        autocomplete="off">
                    <label for="" class="form__label">Phone Number</label>
                </div>
                <br>

                <div class="form__div">
                    <input type="text" class="form__input" name="EmailId" id="email" placeholder="e.g xyz"
                        autocomplete="off">
                    <label for="" class="form__label">Email-ID</label>
                </div>
                <br>

                <div class="form__div">
                    <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Part:</label>
                    <select name="Part" id="Type">
                        <option value="Junior">Junior</option>
                        <option value="Degree">Degree</option>
                    </select>
                </div>
                <br>

                <div class="form__div">
                    <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Department:</label>
                    <select name="Department" id="Type">
                        <option value="--">--</option>
                        <option value="PSYCHOLOGY">PSYCHOLOGY</option>
                        <option value="FRENCH">FRENCH</option>
                        <option value="SANSKRIT">SANSKRIT</option>
                        <option value="ENGLISH">ENGLISH</option>
                        <option value="MARATHI">MARATHI</option>
                        <option value="POL.SCIENCE">POL.SCIENCE</option>
                        <option value="HISTORY">HISTORY</option>
                        <option value="SOCIOLOGY">SOCIOLOGY</option>
                        <option value="ECONOMICS">ECONOMICS</option>
                        <option value="MENTORING">MENTORING</option>
                        <option value="EVS">EVS</option>
                        <option value="RC">RC</option>
                        <option value="PHY.EDN.">PHY.EDN.</option>
                        <option value="UPSC">UPSC</option>
                        <option value="HINDI">HINDI</option>
                        <option value="JR AND DEGREE">JR AND DEGREE</option>
                        <option value="FOUNDATION COURSE">FOUNDATION COURSE</option>
                        <option value="INFORMATION TECHLOGY">INFORMATION TECHOLOGY</option>
                        <option value="PHYSICS">PHYSICS</option>
                        <option value="CHEMISTRY">CHEMISTRY</option>
                        <option value="BIOLOGY">BIOLOGY</option>
                        <option value="MATHEMATICS">MATHEMATICS</option>
                        <option value="BOTANY">BOTANY</option>
                        <option value="ZOOLOGY">ZOOLOGY</option>
                        <option value="PRACTICALS">PRACTICALS</option>
                        <option value="COMMERCE">COMMERCE</option>
                        <option value="B.ECONOMICS">B. ECONOMICS</option>
                        <option value="ACCOUNTS">ACCOUNTS</option>
                        <option value="B.LAW">B.LAW</option>
                        <option value="MCOM">MCOM</option>
                        <option value="BVOC">BVOC</option>
                        <option value="M.SC.IT">M.SC.IT</option>
                        <option value="BIOTECHONOLOGY">BIOTECHONOLOGY</option>
                        <option value="BAF">BAF</option>
                        <option value="BBI">BBI</option>
                        <option value="BMS">BMS</option>
                        <option value="BMM">BMM</option>
                    </select>
                </div>
                <br>
                <br>
                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Save"
                    name="save" style="float:right">
        </div>
        </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/professor.js"></script>
</body>

</html>