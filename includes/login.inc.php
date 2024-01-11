<?php

    // Check if reached page legitimatly
    if(isset($_POST["submit"])){
        // Error handling files
        require_once 'dbh.inc.php';
        require_once 'func.inc.php';

        // Get variables
        $name = $_POST["name"];
        $pwd = $_POST["pwd"];

        // Check if input if empty
        if (loginEmptyInput($name, $pwd) !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        
        loginUser($con, $name , $pwd);


    }

    else{
        header("location: ../login.php");
        exit();
    }