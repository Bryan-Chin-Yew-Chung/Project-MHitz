<?php 
    include_once "../admin/adminUI.php";
    include_once "dbh.inc.php";


    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        if ($id == 1){
            header("location: ../admin/AM_accountcontrol.php?error=nicetry");
            exit();
        }

        $sql = "SELECT usersName from `users` WHERE usersID = '$id'";
        $result = mysqli_query($con,$sql);

        $row = mysqli_fetch_assoc($result);
        $userName = $row['usersName'];

        $sql = "DELETE from `playlists` WHERE usersID = '$userName'";
        mysqli_query($con,$sql);

        $sql2 = "DELETE from `likes` WHERE userID = '$userName'";
        mysqli_query($con,$sql2);
 
        $sql3 = "DELETE from `requests` WHERE usersName = '$userName'";
        mysqli_query($con,$sql3);


        $sql4 = "DELETE from `users` WHERE usersID = '$id'";
        $result4 = mysqli_query($con,$sql4);



        if($result4){
            header("location: ../admin/AM_accountcontrol.php?error=deletesuccess");
        }
        else{
            die(mysqli_error($con));
        }
    }




    else if(isset($_GET['deletereq'])){
        $id = $_GET['deletereq'];

        $sql = "UPDATE `requests` SET reqState = 2
        WHERE songID = $id";
        $result=mysqli_query($con,$sql);

        if($result){
            header("location: ../admin/AM_requestcontrol.php?error=deletesuccess");
        }
        else{
            die(mysqli_error($con));
        }
    }


    //$sql = "SELECT usersType FROM users WHERE usersName = '$name';";
    //$result = mysqli_query($con , $sql);
    //$row = mysqli_fetch_assoc($result);

    else if(isset($_GET['deletesong'])){
        $id = $_GET['deletesong'];
        $sqlget = "SELECT songImg FROM `songs` WHERE songID = '$id'";
        $query = mysqli_query($con , $sqlget);

        while ($row = $query->fetch_assoc()) {
            $imagePath = "../uploads/" . $row['songImg'];
            $songPath = "../uploads/" . $row['songAudio'];
        }
        unlink($imagePath);
        unlink($songPath);

        $sql = "DELETE from `songs` WHERE songID = $id";
        $result=mysqli_query($con,$sql);

        if($result){
            header("location: ../admin/AM_songcontrol.php?error=songdeleted");
        }
        else{
            die(mysqli_error($con));
        }
    }



    else{
         header("location: ../admin/AM_accountcontrol.php");
    }