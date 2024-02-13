<?php 

    require_once "dbh.inc.php";
    require_once "func.inc.php";

    if(isset($_POST["submit"])){

        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];

        // Check if input if empty
        if (signupEmptyInput($id , $name , $email , $name) !== false) {
            header("location: ../updateprofile.php?error=emptyinput");
            exit();
        }

        // Check if username is valid (A-Z | 0-9)
        if (usernameInvalid($name) !== false) {
            header("location: ../updateprofile.php?error=invalidusername");
            exit();
        }

        // Check if email is valid 
        if (emailInvalid($email) !== false) {
            header("location: ../updateprofile.php?error=invalidemail");
            exit();
        }


        // Check if username exist in database
        if (usernameEmailUsedUpdate($con , $id , $name , $email) !== false) {
            header("location: ../updateprofile.php?error=username/emailtaken");
            exit();
        }

        if($pwd == ""){
            userUpdatenoPassword($con,$id,$name,$email);
        }
        else{
            userUpdatePassword($con,$id,$name,$email,$pwd);
        }


       
    }

    else{
        header("location: ../updateprofile.php?=megaerror");
        exit();
    }

