<?php
//Start session to check if login every page
session_start();

include_once 'includes/dbh.inc.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/ui.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Fontawesome Icons-->
    <script src="https://kit.fontawesome.com/806f9cb932.js" crossorigin="anonymous">
    </script>

    <div class="sidebar">
        <div class="logo">
            <a href="#"> <!-- Self Reference M-HITZ Logo-->
                <img src="./assets/logo.jpg" alt="logo" />
            </a>
        </div>

        <div class="navigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="fa fa-home"></span>
                        <span> Home </span>
                    </a>
                </li>

                <li>
                    <a href="search.php">
                        <span class="fa fa-search"></span>
                        <span> Search </span>
                    </a>
                </li>

                <li>
                    <a href="playlist.php">
                        <span class="fa fas fa-plus-square"></span>
                        <span>Playlist </span>
                    </a>
                </li>
            </div>
            <div class="navigation">
                <ul>
                <li>
                    <a href="#">
                        <span class="fa fas fa-heart"></span>
                        <span> Liked Songs </span>
                    </a>
                </li>
                <li>
                    <a href='userRequest.php'>
                        <span class='fa-solid fa-bell'></span>
                        <span> Song Requests </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="policies">
            <ul>
                <li>
                    <a href="#"> Cookies </a>
                </li>
                <li>
                    <a href="#"> Privacy </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-container">
        <div class="topbar">

            <div class="navbar">
                <?php
                if (isset($_SESSION["usersName"])) {
                    echo "<h4>" . $_SESSION["usersName"] . "</h4>";
                    echo "<ul>";
                    echo "<li class='divider'>|</li>";
                    echo "<li><a href='profile.php'>Profile</a></li>";
                    echo "</ul>";
                    echo "<a href='includes/logout.inc.php'><button type='button'>Log Out</button></a>";
                } else {
                    echo "<ul>";
                    echo "<li class='divider'>|</li>";
                    echo "<li><a href='signup.php'>Sign Up</a></li>";
                    echo "</ul>";
                    echo "<a href='login.php'><button type='button'>Log In</button></a>";
                }
                ?>

            </div>
        </div>
    </div>


</body>

</html>