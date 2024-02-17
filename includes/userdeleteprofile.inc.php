  <?php  
    include_once '../userUI.php';
    include_once 'dbh.inc.php';
    
     if(isset($_GET["username"])){

        echo $check = $_GET["username"];
        echo $current = $_SESSION['usersName'];

        if ($check == $current){

            $sql = "DELETE from `playlists` WHERE usersID = '$current'";
            mysqli_query($con,$sql);

            $sql2 = "DELETE from `likes` WHERE userID = '$current'";
            mysqli_query($con,$sql2);
    
            $sql3 = "DELETE from `requests` WHERE usersName = '$current'";
            mysqli_query($con,$sql3);

            $sql4 = "DELETE from `users` WHERE usersName = '$current'";
            $result=mysqli_query($con,$sql4);

            header("location: logout.inc.php");
            exit();
        }
        else {
            header("location: logout.inc.php");
            exit();
        }

     }
        else {
            header("location: logout.inc.php");
            exit();
        }