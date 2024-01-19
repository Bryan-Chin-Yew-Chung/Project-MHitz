<?php
    include_once 'userUI.php';

    if(!isset($_SESSION["usersName"])){
        header("location: login.php");
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
    <title> Song Requests </title>
</head>
<body>
    <div class = "userSongRequest">
        <h1> Cant find your favorite Malaysian Song ? Request it here <span class="fa fas fa-arrow-down"></span> </h1>

        <!-- Request Form-->
            <div class="request-form">
                <br> 
                <form action="includes/songrequest.inc.php" method="post">

                    <input type ="text" name="songname" placeholder="Song Name....">
                    <input type ="text" name="songartist" placeholder="Artist Name....">
                    <input type ="number" min = "1940" max = "2024" name="songdate" placeholder="Year Released....">
                    <button type="submit" name = "submit">Create!</button>
                    </form>
            <?php

            echo $_SESSION["usersName"];
                // Return error messages
                    if (isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                            echo "<h1> Required input is missing! </h1>";
                        }
                        if($_GET["error"] == "none"){
                            echo "<h3> Request Sent! </h3>";
                        }
                    }
                ?>
            </div>
                <br>
                <br>
                <h2> Small reminder that only music made by 
                <!-- Cool Malaysian Colored Text -->
                <R>M</R><Y>A</Y><B>L</B>A<R>Y</R><Y>S</Y><B>I</B>A<R>N</R>
                artists will be accepted.</h2>
                <h2> Admins will go through the requests and add songs if all criteria are met.</h2>

        
        </div>
    </div>
</body>
</html>