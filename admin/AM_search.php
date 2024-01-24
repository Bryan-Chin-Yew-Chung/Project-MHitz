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
    <title>Song Control</title>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            $("a.delete").click(function(e) {
                if (!confirm('Are you sure you want to delete song?')) {
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
            <h1> Song Manager </h1>
            <form class="search" action = "AM_search.php" method = "POST">
                <input type = "text" name="searchbox" placeholder="Search... ">
                <button type = "submit" name="submitsearch"><i class="fa-solid fa-magnifying-glass fa-2x"></i></button>
            </form>
            <form class="addUserButton">
                <input type="submit" value="Create Song" formaction="AM_songcreator.php">
            </form>
        </div>
        <!--Data-->
        <div class="container">

            <?php if (isset($_GET["error"])) {
                if ($_GET["error"] == "songdeleted") {
                    echo "<h6> Song Deleted! </h6>";
                }
            }
            ?>
            <!--Table from database-->
            <table class="table">
                <thread>
                    <th scope="col"> Image </th>
                    <th scope="col"> Name </th>
                    <th scope="col"> Artist </th>
                    <th scope="col"> Year </th>
                    <th scope="col"> Listen </th>
                    <th scope="col"> Likes </th>
                    <th scope="col"> Comments </th>
                    <th scope="col"> Operations </th>
                </thread>


                <!--Get data from database-->
                <?php
                if (isset($_POST['submitsearch'])){
                    if(!empty($_POST['searchbox'])){

                    $search = mysqli_real_escape_string($con , $_POST['searchbox']);
                    //GET ACCOUNTS
                    $sql = "SELECT * from `songs` WHERE songName LIKE '%$search%' OR songArtist LIKE '%$search%' 
                    OR songYear = '$search'";
                    $result = mysqli_query($con, $sql);
                    $queryResult = mysqli_num_rows($result);



                    if($queryResult > 0){
                            echo "<h2> There are " . $queryResult . " results </h2> ";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['songID'];
                                $name = $row['songName'];
                                $artist = $row['songArtist'];
                                $year = $row['songYear'];
                                $img = $row['songImg'];

                                echo '<tr>
                                    <td> <img src="../uploads/' . $row['songImg'] . '" ></td>
                                    <td>' . $name . '</td>
                                    <td>' . $artist . '</td>
                                    <td>' . $year . '</td>
                                    <td> <i class="fa-solid fa-play"></i> </td>
                                    <td> 5 </td>
                                    <td> 10 </td>
                                <td>    
                                    <a href=""> <button class="Edit"> Update </button>  </a> 
                                    <a class = "delete" href="../includes/AM_delete.inc.php?deletesong=' . $id . '"> <button class="Delete"> Delete </button> </a> 
                                </td>
                                </tr>';
                            }
                    }
                    else{
                           echo  '<h2>No items matched your search</h2>';
                                   
                    }
                    }

                    else {
                        exit();
                    }
                }
                else{
                    header("location: AM_songcontrol");
                    exit();
                }

                ?>


            </table>

        </div>
    </div>
</body>

</html>