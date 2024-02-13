<?php
include_once 'userUI.php';

error_reporting(0);
if (!isset($_GET['songid'])) {
    header("location: search.php");
}

$songID = $_GET['songid'];
$sqlplay = $query = "UPDATE songs SET songPlays = songPlays + 1 WHERE songID = $songID";
mysqli_query($con, $sqlplay);

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
    <div class="container">

        <?php


        //GET SONG DETAIL AND SHOW
        $sql = "SELECT * from `songs` WHERE songID = $songID";
        $result = mysqli_query($con, $sql);


        if ($result) {
            $row = mysqli_fetch_assoc($result);

            $id = $row['songID'];
            $name = $row['songName'];
            $artist = $row['songArtist'];
            $year = $row['songYear'];
            $img = $row['songImg'];
            $mp3 = $row['songAudio'];

            echo '<div class="musicplayer">
                        <nav>
                            <a href = "search.php"><div class="circle">
                                <i class="fa-solid fa-angle-left"> </i> 
                            </div></a>';
            if (isset($_SESSION['usersName'])) {
                $sql2 = "SELECT * from `likes` WHERE userID = '$userID' AND songID = '$songID'";

                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                // LIKE BUTTON TOGGLE
                if ($row2['songID'] == NULL) {

                    echo '<a href = "includes/likesong.inc.php?name=' . $_SESSION['usersName'] . '&songid=' . $songID . '"><div class="circle">
                                        <i class="fa-regular fa-thumbs-up"></i>
                                        </div></a>';
                } else {
                    echo '<a href = "includes/likesong.inc.php?ulname=' . $_SESSION['usersName'] . '&ulsongid=' . $songID . '"><div class="circle1">
                                            <i class="fa-regular fa-thumbs-up"></i>
                                            </div></a>';
                }

                // PLAYLIST BUTTON TOGGLE
                $sql3 = "SELECT * from `playlists` WHERE usersID = '$userID' AND songID = '$songID'";
                $result3 = mysqli_query($con, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                if ($row3['songID'] == NULL) {

                    echo ' <a href = "includes/playlist.inc.php?username=' . $_SESSION['usersName'] . '&songID=' . $songID . '"> <div class="circle">
                                                <i class="fa-regular fa-plus"></i>
                                            </div></a>';
                } else {
                    echo ' <a href = "includes/playlist.inc.php?deleteplaylistdisplayname=' . $_SESSION['usersName'] . '&deleteplaylistdisplaysong=' . $songID . '"> <div class="circle1">
                                                <i class="fa-regular fa-plus"></i>
                                            </div> </a>';
                }
            }


            echo '   </nav>     
                        <img src="uploads/' . $row['songImg'] . '"  class ="song-img">
                        <h1>' . $name . '</h1>
                        <p>' . $artist . '</p>


                        <audio id ="song">
                            <source src = "uploads/' . $row['songAudio'] . '" type = "audio/mpeg">
                        </audio>

                        <input type = "range" value = "0" id ="progress">

                            <div class="controls">
                                <a href="javascript:history.back()"> <div> <i class="fa-solid fa-backward"></i> </div> </a>
                                <div onclick = "playPause()"> <i class="fa-solid fa-play" id = "ctrlIcon"></i> </div>';


            // SHUFFLE SONG
            $sql = "SELECT songID from `songs` ORDER BY RAND() LIMIT 1";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $id = $row["songID"];
                echo '<a href="displaysong.php?songid=' . $id . '"> <div> <i class="fa-solid fa-shuffle"></i> </div></a>';
            }
        }
        echo '</div>';

        if (isset($_GET["error"])) {
            if ($_GET["error"] == "playlistfull") {
                echo "<h6> Playlist Full! </h6>";
            }
        }

        echo ' </div>';
        ?>



        <!-- SCRIPT TO RUN MUSIC PLAYER -->
        <script>
            let progress = document.getElementById("progress");
            let song = document.getElementById("song");
            let icon = document.getElementById("ctrlIcon");

            song.onloadeddata = function() {
                progress.max = song.duration;
                progress.value = song.currentTime;
                song.pause();
            }

            // SCRIPT to change play icon to pause vice versa
            function playPause() {
                if (icon.classList.contains("fa-pause")) {
                    song.pause();
                    icon.classList.remove("fa-pause");
                    icon.classList.add("fa-play");
                } else {
                    song.play();
                    icon.classList.add("fa-pause");
                    icon.classList.remove("fa-play");
                }
            }



            if (song.play()) {
                setInterval(() => {
                    progress.value = song.currentTime;
                }, 500);


            }
        </script>


</body>

</html>