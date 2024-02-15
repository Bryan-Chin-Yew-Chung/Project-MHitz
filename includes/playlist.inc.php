<?php 
    include_once "dbh.inc.php";


    
    if(isset($_GET['username']) && isset($_GET['songID'])){
        $userID = $_GET['username'];
        $songID = $_GET['songID'];

        $sql = "INSERT INTO playlists (usersID , songID) VALUES (? , ?)";

        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../admin/AM_accountcreator.php?error=statementfailed");
            exit();
        }


        mysqli_stmt_bind_param($stmt, "ss" , $userID , $songID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../displaysong.php?songid=".$songID ."");
    }

    if(isset($_GET['deleteplaylistdisplayname']) && isset($_GET['deleteplaylistdisplaysong'])){
        $userID = $_GET['deleteplaylistdisplayname'];
        $songID = $_GET['deleteplaylistdisplaysong'];

        $sql = "DELETE from `playlists` WHERE usersID = '$userID' AND songID = '$songID'";
        $result=mysqli_query($con,$sql);

        header("location: ../displaysong.php?songid=".$songID ."");
    }

    if(isset($_GET['plusername']) && isset($_GET['plsongID'])){
        $userID = $_GET['plusername'];
        $songID = $_GET['plsongID'];

        $sql = "INSERT INTO playlists (usersID , songID) VALUES (? , ?)";

        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../admin/AM_accountcreator.php?error=statementfailed");
            exit();
        }


        mysqli_stmt_bind_param($stmt, "ss" , $userID , $songID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../playlist.php?songid=".$songID ."");
    }

    if(isset($_GET['pldeleteplaylistdisplayname']) && isset($_GET['pldeleteplaylistdisplaysong'])){
        $userID = $_GET['pldeleteplaylistdisplayname'];
        $songID = $_GET['pldeleteplaylistdisplaysong'];

        $sql = "DELETE from `playlists` WHERE usersID = '$userID' AND songID = '$songID'";
        $result=mysqli_query($con,$sql);

        header("location: ../playlist.php?songid=0");
    }

    if(isset($_GET['removeplaylistsong']) && isset($_GET['removeplaylistname'])){
        $userID = $_GET['removeplaylistname'];
        $songID = $_GET['removeplaylistsong'];

        $sql = "DELETE from `playlists` WHERE usersID = '$userID' AND songID = '$songID'";
        $result=mysqli_query($con,$sql);

        header("location: ../playlist.php?songid=0");
    }


