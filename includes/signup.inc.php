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

        // Check if input if empty
        if (signupEmptyInput($name , $email , $pwd , $pwdrepeat) !== false) {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }

        // Check if username is valid (A-Z | 0-9)
        if (usernameInvalid($name) !== false) {
            header("location: ../signup.php?error=invalidusername");
            exit();
        }

        // Check if email is valid 
        if (emailInvalid($email) !== false) {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }

        // Check if passwords match
        if (matchPasswords($pwd , $pwdrepeat) !== false) {
            header("location: ../signup.php?error=passwordmismatch");
            exit();
        }

        // Check if username exist in database
        if (usernameEmailUsed($con , $name , $email) !== false) {
            header("location: ../signup.php?error=username/emailtaken");
            exit();
        }

        // Create user in database if all error handlers passed
        createUser($con, $name, $email, $pwd);


    }

    // Else banish to right page
    else{
        header("location: ../signup.php?error=none");
        exit();
    }