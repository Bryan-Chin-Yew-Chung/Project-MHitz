<?php 

    require_once "dbh.inc.php";
    require_once "func.inc.php";

    if(isset($_POST["submit"])){


        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $type = $_POST["usertype"];

        // Check if input if empty
        if (signupEmptyInput($id , $name , $email , $type) !== false) {
            header("location: ../admin/AM_accountcontrol.php?error=emptyinput");
            exit();
        }

        // Check if username is valid (A-Z | 0-9)
        if (usernameInvalid($name) !== false) {
            header("location: ../admin/AM_accountcontrol.php?error=invalidusername");
            exit();
        }

        // Check if email is valid 
        if (emailInvalid($email) !== false) {
            header("location: ../admin/AM_accountcontrol.php?error=invalidemail");
            exit();
        }


        // Check if username exist in database
        if (usernameEmailUsedUpdate($con , $id , $name , $email) !== false) {
            header("location: ../admin/AM_accountcontrol.php?error=username/emailtaken");
            exit();
        }

        if($pwd == ""){
            UpdatenoPassword($con,$id,$name,$email,$type);
        }
        else{
            UpdatePassword($con,$id,$name,$email,$pwd,$type);
        }


       
    }

    else{
        header("location: ../admin/AM_accountcontrol.php");
        exit();
    }

