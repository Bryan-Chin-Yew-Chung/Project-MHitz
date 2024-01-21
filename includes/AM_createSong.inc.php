<?php

    require_once 'dbh.inc.php';
    require_once 'func.inc.php';

    if(isset($_POST["submit"]) && isset($_FILES["songimg"])){

        // Check if input if empty

        // Get variables
        $name = $_POST["name"];
        $artist = $_POST["artist"];
        $year = $_POST["date"];


        $imgName = $_FILES["songimg"]["name"];
        $imgSize = $_FILES["songimg"]["size"];
        $tmpName = $_FILES["songimg"]["tmp_name"];
        $error = $_FILES["songimg"]["error"];


        if (signupEmptyInput($name , $artist , $year , $imgName) !== false) {
            header("location: ../admin/AM_songcreator.php?error=emptyinput");
            exit();
        }
        

        // Check file size
        if($error === 0){
            if($imgSize > 125000){
                header("location: ../admin/AM_songcreator.php?error=filetoolarge");     
            }
            else{
                // double check if file is an image
                $imgEX = pathinfo($imgName, PATHINFO_EXTENSION);
                //convert to lower case
                $imgExlc = strtolower($imgEX);

                $allowedEX = array("jpg", "jpeg" , "png");

                // All checks passed
                if(in_array($imgExlc,$allowedEX)){
                    $newImageName = uniqid("SongImg-", true). " . " . $imgExlc;
                    $imagePath = "../uploads/" .$newImageName;
                    move_uploaded_file($tmpName, $imagePath );

                    createSong($con , $name , $artist , $year , $newImageName);
                    
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