<?php

    require_once 'dbh.inc.php';
    require_once 'func.inc.php';

    // Check if reached legitamately
    if(isset($_POST["submit"]) && isset($_FILES["songimg"]) && isset($_FILES["songaudio"])){

        // Get variables
        if (isset($_POST["reqID"])){        
            $reqid = $_POST["reqID"];}
        else {
            $reqid = 0;
        }

        $name = $_POST["name"];
        $artist = $_POST["artist"];
        $year = $_POST["date"];

        // Image data to send to database
        $imgName = $_FILES["songimg"]["name"];
        $imgSize = $_FILES["songimg"]["size"];
        $tmpName = $_FILES["songimg"]["tmp_name"];
        $error = $_FILES["songimg"]["error"];

        // Audio data to send to database
        $audioName = $_FILES["songaudio"]["name"];
        $audioSize = $_FILES["songaudio"]["size"];
        $audiotmpName = $_FILES["songaudio"]["tmp_name"];
        $audioerror = $_FILES["songaudio"]["error"];

        // Check if input if empty
        if (signupEmptyInput($name , $artist , $year , $imgName) !== false) {
            header("location: ../admin/AM_songcreator.php?error=emptyinput");
            exit();
        }
        

        // Check file size
        if($error === 0 && $audioerror === 0){
            if($imgSize > 10485760 && $audioSize > 524288000){
                header("location: ../admin/AM_songcreator.php?error=filetoolarge");     
            }
            else{
                // double check if file is an image
                $imgEX = pathinfo($imgName, PATHINFO_EXTENSION);
                //convert to lower case
                $imgExlc = strtolower($imgEX);
                $allowedEX = array("jpg", "jpeg" , "png");

                // double check if file is an mp3
                $audioEX = pathinfo($audioName, PATHINFO_EXTENSION);
                //convert to lower case
                $audioExlc = strtolower($audioEX);
                $allowedaudioEX = array("mp3" , "m4a");

                // All checks passed
                if(in_array($imgExlc,$allowedEX) && in_array($audioExlc,$allowedaudioEX)){
                    $newImageName = uniqid("SongImg-", true). "." . $imgExlc;
                    $imagePath = "../uploads/" .$newImageName;

                    $newAudioName = uniqid("SongAudio-", true). "." . $audioExlc;
                    $songPath = "../uploads/" .$newAudioName;

                    move_uploaded_file($tmpName, $imagePath);
                    move_uploaded_file($audiotmpName, $songPath);

                    createSong($con , $name , $artist , $year , $newImageName  , $newAudioName , 0 , 0 , $reqid);
                }
                else{
                    header("location: ../admin/AM_songcreator.php?error=badfile");
                }
                
            }
        }



        else{
            header("location: ../admin/AM_songcreator.php?error=error");
        }

    }

    else{
        header("location: ../admin/AM_songcontrol.php");
    }