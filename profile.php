<?php
include_once 'userUI.php';
include_once 'includes/dbh.inc.php';
include_once 'includes/func.inc.php';
$userID = $_SESSION['usersName'];
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

    echo'
    <div class="profilecontainer">
        <div class="storage">
            <div class="infocontainer">
                <div class="info">
                    <h1> Username&emsp; : &nbsp ' . $name .'</h1>
                    <h1> Email &emsp;&emsp;&emsp; : &nbsp ' . $email .'</h1>
                    <h1> Password &emsp;&nbsp;: &nbsp &nbsp***************</h1>
                    <h1> Join Date &emsp; : &nbsp ' . $date .'</h1>
                    <br>
                    <a class = "updateprofile" href="updateprofile.php?id=' . $id . '"><button class="Update"><i class="fa-solid fa-pen"> Update </i></button></a> 

                </div>
            </div>';
 ?>
            <div class="infocontainer">





            </div>

        </div>
    </div>


</body>

</html>