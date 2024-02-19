<?php
// SIGN UP PAGE ////////////////////////////////////////////
// Check if input if empty
function signupEmptyInput($name, $email, $pwd, $pwdrepeat)
{

    if (empty($name) || empty($email) || empty($pwd) || empty($pwdrepeat)) {
        $test = true;
    } else {
        $test = false;
    }
    return $test;
}

// Check if username is valid (A-Z | 0-9)
function usernameInvalid($name)
{

    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $test = true;
    } else {
        $test = false;
    }
    return $test;
}

// Check if email is valid
function emailInvalid($email)
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $test = true;
    } else {
        $test = false;
    }
    return $test;
}

// Check if passwords match
function matchPasswords($pwd, $pwdrepeat)
{

    if ($pwd !== $pwdrepeat) {
        $test = true;
    } else {
        $test = false;
    }
    return $test;
}

// Check if username exists to deny signup or allow login
function usernameEmailUsed($con, $name, $email)
{
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";

    // Prevent code injection
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=statementfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Getting data from database
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// Check if username exists to deny signup or allow login
function usernameEmailUsedUpdate($con, $id, $name, $email)
{
    $sql = "SELECT * FROM users WHERE usersID != $id AND (usersName = ? OR usersEmail = ?) ";

    // Prevent code injection
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=statementfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Getting data from database
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// Create user
function createUser($con, $name, $email, $pwd)
{
    $sql = "INSERT INTO users (usersName , usersEmail , usersPwd , userjoinDate) VALUES (? , ? , ? , CURDATE())";

    // Prevent code injection
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=statementfailed");
        exit();
    }

    //Big Brain password hashing
    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();
}


// LOG IN PAGE ////////////////////////////////////////////

// Check if input if empty
function loginEmptyInput($name, $pwd)
{

    if (empty($name) || empty($pwd)) {
        $test = true;
    } else {
        $test = false;
    }
    return $test;
}



// Log In user
function loginUser($con, $name, $pwd)
{
    $nameExists = usernameEmailUsed($con, $name, $name);
    $sql = "SELECT usersType FROM users WHERE usersName = '$name';";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($nameExists === false) {
        header("location: ../login.php?error=incorrectlogin");
        exit();
    }

    $unhashPwd = $nameExists["usersPwd"];
    $pwdMatch = password_verify($pwd, $unhashPwd);

    if ($pwdMatch === false) {
        header("location: ../login.php?error=incorrectlogin");
    } else if ($pwdMatch === true) {
        session_start();
        $_SESSION["usersID"] = $nameExists["usersID"];
        $_SESSION["usersName"] = $nameExists["usersName"];
        $_SESSION["usersType"] = $row["usersType"];

        if ($_SESSION["usersType"] == "admin") {
            header("location: ../admin/admin.php");
            exit();
        } else {
            header("location: ../index.php");
            exit();
        }


        exit();
    }
}

// ADMIN FUNCTIONS //////////////////////////////////////////
// Admin Create user
function adminCreateUser($con, $name, $email, $pwd)
{
    $sql = "INSERT INTO users (usersName , usersEmail , usersPwd , userjoinDate) VALUES (? , ? , ? , CURDATE())";


    // Prevent code injection
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/AM_accountcreator.php?error=statementfailed");
        exit();
    }

    //Big Brain password hashing
    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin/AM_accountcreator.php?error=noneuser");
    exit();
}



function createAdmin($con, $name, $email, $pwd)
{
    $sql = "INSERT INTO users (usersName , usersEmail , usersPwd , usersType , userjoinDate) VALUES (? , ? , ? , ? , CURDATE())";

    // Prevent code injection
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/AM_accountcreator.php?error=statementfailed");
        exit();
    }

    //Big Brain password hashing
    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $type = "admin";

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashPwd, $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin/AM_accountcreator.php?error=noneadmin");
    exit();
}



function getRequests($con)
{
    $query = "SELECT * FROM requests";
    $result = mysqli_query($con, $query);
    echo "<table>";
    $first_row = true;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($first_row) {
            $first_row = false;
            // Before displaying first row of data.
            // ---> Display row of column headers, from keys. <---
            echo '<tr>';
            foreach ($row as $column_name => $value) {
                echo '<th>' . htmlspecialchars($column_name) . '</th>';
            }
            echo '</tr>';
        }
        echo '<tr>';
        // Display row of data.
        foreach ($row as $column_name => $value) {
            echo '<td>' . htmlspecialchars($value) . '</td>';
        }
        echo '</tr>';
    }
    echo "</table>";
}



// Create song
function createSong($con, $songName, $songArtist, $songYear, $songImg, $songAudio, $songLike, $songPlays, $reqID)
{
    $sql = "INSERT INTO songs (songName , songArtist , songYear , songImg , songAudio , songLike , songPlays) VALUES (? , ? , ? , ? , ? , ? , ?)";

    // Prevent code injection
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/AM_songcreator.php?error=statementfailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "sssssss", $songName, $songArtist, $songYear, $songImg, $songAudio, $songLike, $songPlays);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    if ($reqID > 0) {

        $sql = "UPDATE `requests` SET reqState = 1
        WHERE songID = $reqID";
        $result = mysqli_query($con,$sql);

        if($result){
            header("location: ../admin/AM_requestcontrol.php?error=crequestadded");
        }
        else{
            die(mysqli_error($con));
        }

        exit();
    } else {

        header("location: ../admin/AM_songcreator.php?error=songadded");
        exit();
    }

    exit();
}



// SONG REQUESTS ////////////////////////////////////
function sendSongRequest($con, $usersname, $songname, $songartist, $songdate)
{

    $currentDate = date('Y-m-d');
    $sql = "INSERT INTO requests (usersName , songName , songArtist , songDate , reqDate) VALUES (? , ? , ? , ? , ?)";

    // Prevent code injection
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../userRequest.php?error=statementfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $usersname, $songname, $songartist, $songdate, $currentDate);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../userRequest.php?error=none");
    exit();
}

function UpdatenoPassword($con, $id, $name, $email, $type)
{
    $sql = "UPDATE `users` SET usersID = $id, usersName = '$name',
        usersEmail = '$email', usersType = '$type'
        WHERE usersID = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header("location: ../admin/AM_accountcontrol.php?error=updatesuccess");
    }
}

function UpdatePassword($con, $id, $name, $email, $pwd, $type)
{
    //Big Brain password hashing
    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "UPDATE `users` SET usersID = $id, usersName = '$name',
        usersEmail = '$email', usersPwd = '$hashPwd' , usersType = '$type'
        WHERE usersID = $id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        header("location: ../admin/AM_accountcontrol.php?error=updatesuccess");
    }
}

function userUpdatenoPassword($con, $id, $name, $email , $oldname)
{
        $sql = "UPDATE `playlists` SET usersID = '$name'
        WHERE usersID = '$oldname'";
        mysqli_query($con, $sql);

        $sql2 = "UPDATE `likes` SET userID = '$name'
        WHERE userID = '$oldname'";
        mysqli_query($con, $sql2);

        
        $sql3 = "UPDATE `requests` SET usersName = '$name'
        WHERE usersName = '$oldname'";
        mysqli_query($con, $sql3);

        
        

    $sql = "UPDATE `users` SET usersID = $id, usersName = '$name',
        usersEmail = '$email' 
        WHERE usersID = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header("location: ../login.php?error=updatesuccess");
    }
}

function userUpdatePassword($con, $id, $name, $email, $pwd , $oldname)
{
        $sql = "UPDATE `playlists` SET usersID = '$name'
        WHERE usersID = '$oldname'";
        mysqli_query($con, $sql);

        $sql2 = "UPDATE `likes` SET userID = '$name'
        WHERE userID = '$oldname'";
        mysqli_query($con, $sql2);

        
        $sql3 = "UPDATE `requests` SET usersName = '$name'
        WHERE usersName = '$oldname'";
        mysqli_query($con, $sql3);


        mysqli_query($con, $sql);
        mysqli_query($con, $sql2);
        //Big Brain password hashing
        $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET usersID = $id, usersName = '$name',
            usersEmail = '$email', usersPwd = '$hashPwd'  
        WHERE usersID = $id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        header("location: ../login.php?error=updatesuccess");
    }
}


