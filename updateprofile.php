<?php
include_once 'userUI.php';
include_once 'includes/dbh.inc.php';
include_once 'includes/func.inc.php';
$userID = $_SESSION['usersName'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/user.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
    <title> Search </title>
</head>

<body>
    <?php

    $sql = "SELECT * from `users` WHERE usersName = '$userID'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $id = $row['usersID'];
    $name = $row['usersName'];
    $email = $row['usersEmail'];
    $date = $row['userjoinDate'];

    echo '
    <div class="profilecontainer">
        <div class="storage">
            <div class="infocontainer">
                <div class="info">
                    <h3> UPDATE INFORMATION </h3>
                <form action="includes/profileupdate.inc.php" method="post">
                    <input type="hidden" name="id" value="' . $id . '">
                    <input type="hidden" name="oldname" value="' . $userID . '">
                    <input type ="text" name="name" value="' . $name . '">
                    <input type ="text" name="email" value="' . $email . '">
                    <input type ="password" name="pwd" placeholder="Leave Empty To Keep Old Password...">
                 

                    <button type="submit" name = "submit"><i class="fa-solid fa-pen"> Update </i></button>
                </form>  
                <br>
                <br>

                ';
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<h1> Require input is missing! </h1>";
        }

        if ($_GET["error"] == "invalidusername") {
            echo "<h2> Invalid Email </h2>";
        }
        if ($_GET["error"] == "invalidemail") {
            echo "<h2> Invalid Email </h2>";
        }
        if ($_GET["error"] == "username/emailtaken") {
            echo "<h2> Username/Email Taken! </h2>";
        }
    }
    echo '
                </div>
            </div>

            </div>';
    ?>
    ';
    ?>


    </div>
    </div>


</body>

</html>