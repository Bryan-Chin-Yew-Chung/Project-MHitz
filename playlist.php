<?php
include_once 'userUI.php';
include_once 'includes/dbh.inc.php';
$userID = $_SESSION['usersName'];
error_reporting(0);
if (!isset($userID)) {
    header('location:login.php');
};

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
        if (!isset($_GET['songid'])) {
            $songID = 0;
        } else {
            $songID = $_GET['songid'];
            $sqlplay = $query = "UPDATE songs SET songPlays = songPlays + 1 WHERE songID = $songID";
            mysqli_query($con, $sqlplay);
        } ?>

        <div class="musicplayer">
            <nav>
                <a href="index.php">
                    <div class="circle">
                        <i class="fa-solid fa-angle-left"> </i>
                    </div>
                </a> <?php
                        if (isset($_SESSION['usersName'])) {
                            $sql2 = "SELECT * from `likes` WHERE userID = '$userID' AND songID = '$songID'";

                            $result2 = mysqli_query($con, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);

                            if ($songID != 0){
                            // LIKE BUTTON TOGGLE
                            if ($row2['songID'] == NULL) {

                                echo '<a href = "includes/likesong.inc.php?plname=' . $_SESSION['usersName'] . '&plsongid=' . $songID . '"><div class="circle">
                                        <i class="fa-regular fa-thumbs-up"></i>
                                        </div></a>';
                            } else {
                                echo '<a href = "includes/likesong.inc.php?plulname=' . $_SESSION['usersName'] . '&plulsongid=' . $songID . '"><div class="circle1">
                                            <i class="fa-regular fa-thumbs-up"></i>
                                            </div></a>';
                            }

                            // PLAYLIST BUTTON TOGGLE
                            $sql3 = "SELECT * from `playlists` WHERE usersID = '$userID' AND songID = '$songID'";
                            $result3 = mysqli_query($con, $sql3);
                            $row3 = mysqli_fetch_assoc($result3);
                            if ($row3['songID'] == NULL) {

                                echo ' <a href = "includes/playlist.inc.php?plusername=' . $_SESSION['usersName'] . '&plsongID=' . $songID . '"> <div class="circle">
                                                <i class="fa-regular fa-plus"></i>
                                            </div></a>';
                            } else {
                                echo ' <a href = "includes/playlist.inc.php?pldeleteplaylistdisplayname=' . $_SESSION['usersName'] . '&pldeleteplaylistdisplaysong=' . $songID . '"> <div class="circle1">
                                                <i class="fa-regular fa-plus"></i>
                                            </div> </a>';
                            }
                            }
                        } ?>
            </nav>
            <?php

            if ($songID == 0) {
                echo '<img src="assets/mysquare.png" class="song-img">
                <h1> Playlist</h1>
                <p> Choose Song To Start Playing </p>';
            } else {

                $sql = "SELECT * from `songs` WHERE songID = '$songID'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);

                $id = $row['songID'];
                $name = $row['songName'];
                $artist = $row['songArtist'];
                $year = $row['songYear'];
                $img = $row['songImg'];
                $mp3 = $row['songAudio'];

                echo '   <img src="uploads/' . $img . '"  class ="song-img">
                        <h1>' . $name . '</h1>
                        <p>' . $artist . '</p>';
            } ?>


            <audio id="song">
                <?php
                echo ' <source src = "uploads/' . $mp3 . '" type = "audio/mpeg">';
                ?>
            </audio>

            <input type="range" value="0" id="progress">

            <div class="controls">
                <a href="javascript:history.back()">
                    <div> <i class="fa-solid fa-backward"></i> </div>
                </a>
                <div onclick="playPause()"> <i class="fa-solid fa-play" id="ctrlIcon"></i> </div>

                <?php
                if ($songID != 0) {
                    // GET NEXT SONG IN PLAYLIST
                    $sql = "SELECT addID FROM `playlists` WHERE usersID = '$userID' AND songID = '$songID' ";
                    $result = mysqli_query($con, $sql);

                    // IF PLAYLIST GOT ANYTHING
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['addID'];

                            $sql2 = "SELECT songID FROM `playlists` WHERE usersID = '$userID' AND addID > '$id' LIMIT 1";
                            $result2 = mysqli_query($con, $sql2);

                            if ($result2) {
                                $row = mysqli_fetch_assoc($result2);
                                $nextsong = $row['songID'];
                                if ($nextsong == NULL) {
                                    $sql3 = "SELECT * FROM `playlists` WHERE usersID = '$userID' ORDER BY addID LIMIT 1";
                                    $result3 = mysqli_query($con, $sql3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                    $nextsong = $row3['songID'];
                                }

                                echo '
                                <a href="playlist.php?songid=' . $nextsong . '">
                                    <div> <i class="fa-solid fa-forward"></i> </div>
                                </a>';
                            }
                        }
                    }
                } else {
                    $sql3 = "SELECT * FROM `playlists` WHERE usersID = '$userID' ORDER BY addID LIMIT 1";
                    $result3 = mysqli_query($con, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);
                    $nextsong = $row3['songID'];
                    echo '
                        <a href="playlist.php?songid=' . $nextsong . '">
                            <div> <i class="fa-solid fa-forward"></i> </div>
                        </a>';
                }


                ?>
            </div>
        </div>

        <div class="musicplayer1">
            <table class="table">
                <h1> PLAYLIST </h1>

                <?php

                // FIND SONGS IN PLAYLIST
                $sql = "SELECT songID FROM `playlists` WHERE usersID = '$userID' ORDER BY addID ";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $song = $row['songID'];

                        $sql2 = "SELECT * from `songs` WHERE songID = $song";
                        $result2 = mysqli_query($con, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);

                        $id = $row2['songID'];
                        $name = $row2['songName'];
                        $artist = $row2['songArtist'];
                        $year = $row2['songYear'];
                        $img = $row2['songImg'];
                        $mp3 = $row2['songAudio'];

                        if ($songID == $row2['songID']) {
                            echo '<tr class = "darkgreen">';
                        } else {
                            echo '<tr>';
                        }
                        echo '
                        <td> <a href="playlist.php?songid=' . $id . '"><img src="../uploads/' . $img . '" > </a></td>
                        <td> ' . $name . '</td>
                        <td>' . $artist . '</td>
                        <td>    
                            <a class = "delete" href="includes/playlist.inc.php?removeplaylistsong=' . $id . '&removeplaylistname=' . $userID . '"> <button class="Delete"> <i class="fa-solid fa-x"></i> </button> </a> 
                        </td>

                        </tr>';
                    }
                }

                ?>
            </table>
        </div>
    </div>
    </div>

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