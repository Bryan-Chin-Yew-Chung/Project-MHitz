<?php
    include_once 'adminUI.php';
    include_once '../includes/dbh.inc.php';
    include_once '../includes/func.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
    <title>Account Manager</title>
</head>
<body>
    <div class = "adminDashboard">
        <div class = "topRow">
        <h1> Account Manager </h1>
            <form class = "addUserButton">
                    <input type="submit" value="Add User" formaction="AM_accountcreator.php">
            </form>
        </div>
        <!--Data-->
        <div class="container">
                    <?php if (isset($_GET["error"])){
                        if($_GET["error"] == "deletesuccess"){
                            echo "<h6> User Deleted Succesfully! </h6>";
                        }
                        if($_GET["error"] == "updatesuccess"){
                            echo "<h6> User Updated Succesfully!</h6>";
                        }
                        if($_GET["error"] == "emptyinput"){
                            echo "<h5> Empty Input! </h5>";
                        }                        
                        if($_GET["error"] == "invalidusername"){
                            echo "<h5> Invalid Username! </h5>";
                        }              
                        if($_GET["error"] == "invalidemail"){
                            echo "<h5> Invalid Email! </h5>";
                        }
                        if($_GET["error"] == "username/emailtaken"){
                            echo "<h5> Username/Email Already In Use! </h5>";
                        }
                    }
                    ?>

        <!--Table from database-->
            <table class = "table">
                <thread>
                    <th scope = "col"> ID </th>
                    <th scope = "col"> Username </th>
                    <th scope = "col"> Email </th>  
                    <th scope = "col"> Role </th>
                    <th scope = "col"> Operations </th>
                </thread>

            <!--Get data from database-->
            <?php
                $sql = "SELECT * from `users` ";
                $result = mysqli_query($con, $sql);

                if($result){

                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['usersID'];
                        $name = $row['usersName'];
                        $email = $row['usersEmail'];
                        $role = $row['usersType'];
                        echo '<tr>
                            <td scope="row">'. $id .' </td>
                            <td>' .$name. '</td>
                            <td>' .$email. '</td>
                            <td>' .$role. '</td>

                        <td>    
                            <button class="Edit"> <a href="AM_accountupdate.php?updateid='.$id.'"> Update </a> </button>
                            <button class="Delete"> <a href="../includes/AM_delete.inc.php?deleteid='.$id.'"> Delete </a> </button>
                        </td>
                        </tr>';
                    }
                }

            ?>


            </table>

        </div>       
        </div>
</body>
</html>


