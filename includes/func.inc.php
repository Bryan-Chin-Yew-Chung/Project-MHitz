<?php
// SIGN UP PAGE ////////////////////////////////////////////
    // Check if input if empty
    function signupEmptyInput($name , $email , $pwd , $pwdrepeat){

        if (empty($name) || empty($email) || empty($pwd) || empty($pwdrepeat)){
            $test = true;
        }

        else{
            $test = false;
        }
        return $test;
    }

    // Check if username is valid (A-Z | 0-9)
    function usernameInvalid($name){

        if (!preg_match("/^[a-zA-Z0-9]*$/",$name)){
            $test = true; 
        }
        else{
            $test = false;
        }
        return $test;
    }

    // Check if email is valid
    function emailInvalid($email){

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $test = true; 
        }
        else{
            $test = false;
        }
        return $test;
    }

    // Check if passwords match
    function matchPasswords($pwd , $pwdrepeat){

        if ($pwd !== $pwdrepeat){
            $test = true; 
        }
        else{
            $test = false;
        }
        return $test;
    }

    // Check if username exists to deny signup or allow login
    function usernameEmailUsed($con , $name , $email){
        $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";

        // Prevent code injection
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../signup.php?error=statementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss" , $name , $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // Getting data from database
        if($row = mysqli_fetch_assoc($result)){
            return $row;
        }
        else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);

    }

    // Create user
    function createUser($con , $name , $email , $pwd){
        $sql = "INSERT INTO users (usersName , usersEmail , usersPwd) VALUES (? , ? , ?)";

        // Prevent code injection
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../signup.php?error=statementfailed");
            exit();
        }

        //Big Brain password hashing
        $hashPwd = password_hash($pwd , PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss" , $name , $email , $hashPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../login.php?error=none");
        exit();
    }


// LOG IN PAGE ////////////////////////////////////////////

    // Check if input if empty
    function loginEmptyInput($name, $pwd){

        if (empty($name) || empty($pwd)){
            $test = true;
        }
        else{
            $test = false;
        }
        return $test;
    }



    // Log In user
    function loginUser($con, $name, $pwd ){
        $nameExists = usernameEmailUsed($con , $name , $name);
        $sql = "SELECT usersType FROM users WHERE usersName = '$name';";
        $result = mysqli_query($con , $sql);
        $row = mysqli_fetch_assoc($result);

        if ($nameExists === false){
            header("location: ../login.php?error=incorrectlogin");
            exit();
        }

        $unhashPwd = $nameExists["usersPwd"];
        $pwdMatch = password_verify($pwd , $unhashPwd);

        if($pwdMatch === false) {
            header("location: ../login.php?error=incorrectlogin");
        }

        else if($pwdMatch === true){
            session_start();
            $_SESSION["usersID"] = $nameExists["usersID"];
            $_SESSION["usersName"] = $nameExists["usersName"];
            $_SESSION["usersType"] = $row["usersType"];


            header("location: ../index.php");


            exit();

        }
    }

    // ADMIN FUNCTIONS //////////////////////////////////////////
    // Admin Create user
    function adminCreateUser($con , $name , $email , $pwd){
        $sql = "INSERT INTO users (usersName , usersEmail , usersPwd) VALUES (? , ? , ?)";

        // Prevent code injection
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../admin/AM_accountcreator.php?error=statementfailed");
            exit();
        }

        //Big Brain password hashing
        $hashPwd = password_hash($pwd , PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss" , $name , $email , $hashPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../admin/AM_accountcreator.php?error=noneuser");
        exit();
    }

    function createAdmin($con , $name , $email , $pwd){
        $sql = "INSERT INTO users (usersName , usersEmail , usersPwd , usersType) VALUES (? , ? , ? , ?)";

        // Prevent code injection
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../admin/AM_accountcreator.php?error=statementfailed");
            exit();
        }

        //Big Brain password hashing
        $hashPwd = password_hash($pwd , PASSWORD_DEFAULT);

        $type = "admin";

        mysqli_stmt_bind_param($stmt, "ssss" , $name , $email , $hashPwd , $type);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../admin/AM_accountcreator.php?error=noneadmin");
        exit();
    }



    function getRequests(){
        
    }


    // SONG REQUESTS ////////////////////////////////////
    function sendSongRequest($con , $usersname , $songname , $songartist , $songdate ){
        $sql = "INSERT INTO requests (usersName , songname , songartist , songdate) VALUES (? , ? , ? , ?)";

        // Prevent code injection
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt , $sql)){
            header("location: ../userRequest.php?error=statementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss" , $usersname ,$songname , $songartist , $songdate );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../userRequest.php?error=none");
        exit();
    }



