<?php 
    include_once "dbh.inc.php";

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE from `users` WHERE usersID = $id";
        $result=mysqli_query($con,$sql);

        if($result){
            header("location: ../admin/AM_accountcontrol.php?error=deletesuccess");
        }
        else{
            die(mysqli_error($con));
        }
    }

    else if(isset($_GET['deletereq'])){
        $id = $_GET['deletereq'];

        $sql = "DELETE from `requests` WHERE songID = $id";
        $result=mysqli_query($con,$sql);

        if($result){
            header("location: ../admin/AM_requestcontrol.php?error=deletesuccess");
        }
        else{
            die(mysqli_error($con));
        }
    }

    else if(isset($_GET['cdeletereq'])){
        $id = $_GET['cdeletereq'];

        echo $id;
        $sql = "DELETE from `requests` WHERE songID = $id";
        $result=mysqli_query($con,$sql);

        if($result){

            header("location: ../admin/AM_requestcontrol.php?error=crequestadded");
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
        }
        echo $imagePath;
        unlink($imagePath);

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