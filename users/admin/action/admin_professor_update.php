<?php
include("../../../config/connect.php");
ob_start();

if (isset($_GET['UpdateId'])) {
    $id = $_GET['UpdateId'];

    // get data from database
    $con = get_con();
    $sql = "SELECT * FROM professor WHERE ProfessorId  = $id;";
    $result_get = $con->query($sql);
    $result_get = $result_get->fetch_assoc();
}

//if user clicks on register button and  data gets updated on database
if (isset($_POST['update'])) {

    $con = get_con();

    $professorfirstname =  $_POST['ProfessorFirstName'];
    $professorlastname =  $_POST['ProfessorLastName']; 
    $department =  $_POST['Department'];
    $emailid =  $_POST['EmailId'];
    $phone =  $_POST['Phone'];
    $part =  $_POST['Part'];
    

    // Update
    $sql = "UPDATE `professor` SET `ProfessorFirstName` = '" . $professorfirstname . "', `ProfessorLastName`='" . $professorlastname ."', `EmailId`='" . $emailid . "',`Department`='" . $department . "',`Phone`='" . $phone . "',`Part`='" . $part . "' WHERE ProfessorId  = '" . $id . "';";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Professor Updated');</script>";
        header("Location:../../professor.php");
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
    <link rel="stylesheet" href="../../../../css/professor.css">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Update</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">&times;</button>
        <a href="../../../admin_dashboard.php" class="w3-bar-item w3-button ">Dashboard</a>
        <a href="../../register.php" class="w3-bar-item w3-button">Registration</a>
        <a href="timeslot.php" class="w3-bar-item w3-button">Time-Slot</a>
        <a href="professor.php" class="w3-bar-item w3-button w3-black">Professor</a>
        <a href="room.php" class="w3-bar-item w3-button">Room</a>
    </div>
    <!-- Page Content -->

    <div>
        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
    </div>

    <div class="con_head">
        <p>Update Professor <?php echo $result_get["ProfessorFirstName"] ?></p>
    </div>
    <br>

    <br>
    <div class="l-form">
        <form method="POST" class="form  w3-margin w3-whitesmoke" style="width:66vw">
            <img src="https://github.githubassets.com/images/mona-loading-dark.gif" alt="octo" style="height:3rem">
            <br>
            <br>
            <div class="form__div">
                <input type="text" class="form__input" name="ProfessorFirstName" id="ProfessorFirstName" placeholder="e.g abc"
                    autocomplete="off" value="<?php echo $result_get['ProfessorFirstName']; ?>">
                <label for="" class="form__label">Professor First Name</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="ProfessorLastName" id="LastName" placeholder="e.g xyz"
                    autocomplete="off" value="<?php echo $result_get['ProfessorLastName']; ?>">
                <label for="" class="form__label">Professor Last Name</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="Phone" id="Phone" placeholder="e.g 8828*****"
                    autocomplete="off" value="<?php echo $result_get['Phone']; ?>">
                <label for="" class="form__label">Phone Number</label>
            </div>
            <br>

            <div class="form__div">
                <input type="text" class="form__input" name="EmailId" id="EmailId" placeholder="e.g someone@gmail.com"
                    autocomplete="off" value="<?php echo $result_get['EmailId']; ?>">
                <label for="" class="form__label">Email-ID</label>
            </div>
            <br>
            <div class="form__div">
                <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Department:</label>
                <select name="Department" id="Department">
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
                    <option value="BMM">BMMC</option>
                </select>
                </div>
                <div class="form__div">
                <label for="Type" style="color:gray" style="margin-bottom: 2rem;">Part:</label>
                <select name="Part" id="Part">
                    <option value="Junior">Junior</option>
                    <option value="Degree">Degree</option>
                </select>
                </div>
                <br>
                <input class="button-primary w3-button w3-border w3-hover-blue w3-round" type="submit" value="Update"
                name="update" style="float:right">
                <br>
            </div> 
    </div>
    </form>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../../../../js/main.js"></script>
    <script src="../../../../js/login.js"></script>
</body>

</html>