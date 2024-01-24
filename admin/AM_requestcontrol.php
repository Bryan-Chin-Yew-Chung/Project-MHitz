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
    </script>
</head>

<body>
    <div class="adminDashboard">
        <div class="topRow">
            <h1> Request Manager </h1>
        </div>
        <!--Data-->
        <div class="container">
            <?php if (isset($_GET["error"])) {
                if ($_GET["error"] == "deletesuccess") {
                    echo "<h6> Request Deleted! </h6>";
                }
                if ($_GET["error"] == "requestadded") {
                    echo "<h6> Request Added! </h6>";
                }
            }
            ?>

            <!--Table from database-->
            <table class="table">
                <thread>
                    <th scope="col"> Date</th>
                    <th scope="col"> User</th>
                    <th scope="col"> Song Name </th>
                    <th scope="col"> Artist </th>
                    <th scope="col"> Release</th>

                    <th scope="col"> Operations </th>
                </thread>

                <!--Get data from database-->
                <?php
                $sql = "SELECT * from `requests`";
                $result = mysqli_query($con, $sql);



                if ($result) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['songID'];
                        $name = $row['usersName'];
                        $song = $row['songName'];
                        $artist = $row['songArtist'];
                        $sdate = $row['songDate'];
                        $rdate = $row['reqDate'];
                        echo '<tr>
                            <td scope="row">' . $rdate . ' </td>
                            <td>' . $name . '</td>
                            <td>' . $song . '</td>
                            <td>' . $artist . '</td>
                            <td>' . $sdate . '</td>
                        <td>    
                            <a href="AM_songcreator.php?reqid=' . $id . '"> <button class="Accept"> <i class="fa-solid fa-check"></i> </button></a> 
                            <a class = "delete" href="../includes/AM_delete.inc.php?deletereq=' . $id . '"><button class="Deny"><i class="fa-solid fa-x"></i></button></a> 
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