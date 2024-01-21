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
    <title>Request Manager</title>
</head>
<body>
    <div class = "adminDashboard">
        <div class = "topRow">
        <h1> Request Manager </h1>
        </div>
        <!--Data-->
            <div class="container">
                    <?php if (isset($_GET["error"])){
                        if($_GET["error"] == "deletesuccess"){
                            echo "<h6> Request Deleted! </h6>";
                        }
                    }
                    ?>

        <!--Table from database-->
            <table class = "table">
                <thread>
                    <th scope = "col"> Date</th>
                    <th scope = "col"> User</th>
                    <th scope = "col"> Song Name </th>  
                    <th scope = "col"> Artist </th>
                    <th scope = "col"> Release</th>

                    <th scope = "col"> Operations </th>
                </thread>

            <!--Get data from database-->
            <?php
                $sql = "SELECT * from `requests`";
                $result = mysqli_query($con, $sql);



                if($result){

                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['songID'];
                        $name = $row['usersName'];
                        $song = $row['songName'];
                        $artist = $row['songArtist'];
                        $sdate = $row['songDate'];
                        $rdate = $row['reqDate'];
                        echo '<tr>
                            <td scope="row">'. $rdate .' </td>
                            <td>' .$name. '</td>
                            <td>' .$song. '</td>
                            <td>' .$artist. '</td>
                            <td>' .$sdate. '</td>
                        <td>    
                            <button class="Accept"> <a href="AM_accountupdate.php?updateid='.$id.'"> <i class="fa-solid fa-check"></i> </a> </button>
                            <button class="Deny"> <a href="../includes/AM_delete.inc.php?deletereq='.$id.'"><i class="fa-solid fa-x"></i></a> </button>
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


