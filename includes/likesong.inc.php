<?php 

    require_once "dbh.inc.php";
    require_once "func.inc.php";

    if (isset($_GET["name"]) && $songID = $_GET["songid"]){

        $name = $_GET["name"];
        $songID = $_GET["songid"];

        $sql = "INSERT INTO likes (userID , songID) VALUES (? , ?)";

        // Prevent code injection
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../index.php?error=statementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss" , $name , $songID );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../displaysong.php?songid=" . $songID ."");
        exit();        


    }

    if (isset($_GET["ulname"]) && $songID = $_GET["ulsongid"]){

        $name = $_GET["ulname"];
        $songID = $_GET["ulsongid"];

        $sql = "DELETE from `likes` WHERE `userID` = '$name' AND `songID` = '$songID'";
        $result = mysqli_query($con,$sql);


        header("location: ../displaysong.php?songid=" . $songID ."");
        exit();        


    }

    if (isset($_GET["plname"]) && $songID = $_GET["plsongid"]){

        $name = $_GET["plname"];
        $songID = $_GET["plsongid"];

        $sql = "INSERT INTO likes (userID , songID) VALUES (? , ?)";

        // Prevent code injection
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../index.php?error=statementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss" , $name , $songID );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../playlist.php?songid=" . $songID ."");
        exit();        


    }

    if (isset($_GET["plulname"]) && $songID = $_GET["plulsongid"]){

        $name = $_GET["plulname"];
        $songID = $_GET["plulsongid"];

        $sql = "DELETE from `likes` WHERE `userID` = '$name' AND `songID` = '$songID'";
        $result = mysqli_query($con,$sql);


        header("location: ../playlist.php?songid=" . $songID ."");
        exit();        


    }


       
    
