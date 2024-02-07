<?php 

    require_once "dbh.inc.php";
    require_once "func.inc.php";

    $name = $_GET["username"];
    $songID = $_GET["songID"];

    // FOR LOOP TO CHECK IF SONG ALREADY EXISTS ON PLAYLIST
    for ($x = 1; $x <= 10; $x++) {
            $sql = "SELECT song$x from `playlists` WHERE usersID = '$name'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);

            $song = $row['song' . $x .''];

            if ($song == $songID){
                header("location: ../displaysong.php?songid=" . $songID . "&error=songexists");
                exit();
            }

    }

        // FOR LOOP TO CHECK FOR 0
    for ($x = 1; $x <= 10; $x++) {
        $sql = "SELECT song$x from `playlists` WHERE usersID = '$name'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        
        $song = $row['song' . $x .''];


        if ($song == 0){
            $sql = "UPDATE `playlists` SET song$x = '$songID'
            WHERE usersID = '$name'";

            $result = mysqli_query($con, $sql);

            if($result){
                header("location: ../displaysong.php?songid=" . $songID . "&error=none");
                exit();
            }           
        }

        else {
                header("location: ../displaysong.php?songid=" . $songID . "&error=playlistfull");
        }
    }


       
    
