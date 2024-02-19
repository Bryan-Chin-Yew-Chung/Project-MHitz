<?php
include_once 'userUI.php';
include_once 'includes/dbh.inc.php';
include_once 'includes/func.inc.php';
if (!isset($_SESSION['usersName'])) {
    header("location: login.php");
}
$userID = $_SESSION['usersName'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/user.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
    <title> Profile </title>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            $("a.delete").click(function(e) {
                if (!confirm('Are you sure you want to delete request?')) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        });
        $(document).ready(function() {
            $("a.deleteacc").click(function(e) {
                if (!confirm('Are you sure you want to delete account?')) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        });
    </script>
</head>

<body>
    <?php

    $sql = "SELECT * from `users` WHERE usersName = '$userID'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $id = $row['usersID'];
    $name = $row['usersName'];
    $email = $row['usersEmail'];
    $date = $row['userjoinDate'];

    echo '
    <div class="profilecontainer">
        <div class="storage">
            <div class="infocontainer">
                <div class="info">
                <h4>    Information </h4>
                    <h1> Username&emsp; : &nbsp ' . $name . '</h1>
                    <h1> Email &emsp;&emsp;&emsp; : &nbsp ' . $email . '</h1>
                    <h1> Password &emsp;&nbsp;: &nbsp &nbsp***************</h1>
                    <h1> Join Date &emsp; : &nbsp ' . $date . '</h1>
                    <br>
                    <a class = "updateprofile" href="updateprofile.php?id=' . $id . '"><button class="Update"><i class="fa-solid fa-pen"> Update </i></button></a> 
                    <a class = "deleteacc" href="includes/userdeleteprofile.inc.php?username='.$userID.'"><button class="Deleteuser"><i class="fa-solid fa-pen"> Delete </i></button></a> 
                </div>
            

            </div>
                    <div class="infocontainer2">
                    <div class="info">
                    <h4> Requests  </h4>';

    // Return error messages
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "requpdated") {
            echo "<h5> Request Deleted! </h5>";
        }
    }
    echo '
                    <h5> Green = Accepted, Red = Rejected, Black = Pending </h5>
                    <table class = "profiletable">
';


    $sql = "SELECT * from `requests` WHERE usersName = '$userID'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

        $reqID = $row['songID'];
        $songName = $row['songName'];
        $songArtist = $row['songArtist'];
        $reqDate = $row['reqDate'];
        $reqState = $row['reqState'];

        if ($reqState == 1) {
            echo '<tr class = "darkgreen">';
        } else if ($reqState == 2) {
            echo '<tr class = "red">';
        } else {
            echo '<tr>';
        }
        echo '
                <td>' . $songName . '</td>
                <td>' . $songArtist . '</td>
                <td>' . $reqDate . '</td>
                <td> 
                    <a class = "delete" href="includes/req.inc.php?reqdata=' . $reqID . '"> <button class="remove"> <i class="fa-solid fa-x"></i> </button> </a> 
                </td>
                </tr>
           
                ';
    } ?>


    </table>
    </div>
    </div>




    </div>
    </div>


</body>

</html>