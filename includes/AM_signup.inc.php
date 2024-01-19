<?php

    // Check if reached page legitimatly
    if(isset($_POST["submit"])){
        // Error handling files
        require_once 'dbh.inc.php';
        require_once 'func.inc.php';

        // Get variables
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $pwdrepeat = $_POST["pwdrepeat"];
        $usertype = $_POST["usertype"];

        // Check if input if empty
        if (signupEmptyInput($name , $email , $pwd , $pwdrepeat) !== false) {
            header("location: ../admin/AM_accountcreator.php?error=emptyinput");
            exit();
        }

        // Check if username is valid (A-Z | 0-9)
        if (usernameInvalid($name) !== false) {
            header("location: ../admin/AM_accountcreator.php?error=invalidusername");
            exit();
        }

        // Check if email is valid 
        if (emailInvalid($email) !== false) {
            header("location: ../admin/AM_accountcreator.php?error=invalidemail");
            exit();
        }

        // Check if passwords match
        if (matchPasswords($pwd , $pwdrepeat) !== false) {
            header("location: ../admin/AM_accountcreator.php?error=passwordmismatch");
            exit();
        }

        // Check if username exist in database
        if (usernameEmailUsed($con , $name , $email) !== false) {
            header("location: ../admin/AM_accountcreator.php?error=username/emailtaken");
            exit();
        }


        if($usertype == "user"){
            // Create user in database if all error handlers passed
            adminCreateUser($con, $name, $email, $pwd);
        }

        else if($usertype == "admin"){
            createAdmin($con, $name, $email, $pwd);
        }


    }

    // Else banish to back to admin
    else{
        header("location: ../admin/AM_accountcreator.php?error=none");
        exit();
    }