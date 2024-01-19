<?php 
    include_once "../includes/dbh.inc.php";
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