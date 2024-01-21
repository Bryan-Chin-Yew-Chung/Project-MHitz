<?php

    session_start();
    // Check if reached page legitimatly
    if(isset($_POST["submit"])){
        // Error handling files
        require_once 'dbh.inc.php';
        require_once 'func.inc.php';

        // Get variables
        $usersName = $_SESSION["usersName"];
        $songname = $_POST["songName"];
        $songartist = $_POST["songArtist"];
        $songdate = $_POST["songDate"];


        // Check if input if empty
        if (signupEmptyInput($songname , $songartist , $songdate , $songdate) !== false) {
            header("location: ../userRequest.php?error=emptyinput");
            exit();
        }   

        // Create song request
        sendSongRequest($con, $usersName ,$songname, $songartist, $songdate);



    }

    // Else banish to right page
    else{
        header("location: ../songRequest.php?error=none");
        exit();
    }