<?php 
    include_once "dbh.inc.php";
    include_once "func.inc.php";


        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $type = $_POST['usertype'];

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
        if (usernameEmailUsed($con , $name , $email) !== false) {
            header("location: ../admin/AM_accountcontrol.php?error=username/emailtaken");
            exit();
        }

        if ($pwd == ""){
            $sql = "UPDATE `users` SET usersID = $id, usersName = '$name',
            usersEmail = '$email', usersType = '$type'
            WHERE usersID = $id";
        }
        else{
            $sql = "UPDATE `users` SET usersID = $id, usersName = '$name',
            usersEmail = '$email', usersPwd = '$pwd' , usersType = '$type'
            WHERE usersID = $id";
        }

        $result = mysqli_query($con, $sql);

    

        if($result){
            header("../admin/AM_accountcontrol.php?error=updatesuccess");
        }

?>