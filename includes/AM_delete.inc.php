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

    if(isset($_GET['deletereq'])){
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


    else{
         header("location: ../admin/AM_accountcontrol.php");
    }