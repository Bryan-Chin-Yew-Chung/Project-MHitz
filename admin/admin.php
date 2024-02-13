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
    <link rel="stylesheet" href="../css/user.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="indexdisplay">
        <h1> Top Played </h1>
        <div class="list">
            <?php
            //GET ACCOUNTS
            $sql = "SELECT * FROM songs 
                ORDER BY songPlays DESC 
                LIMIT 5";
            $result = mysqli_query($con, $sql);


            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $id = $row['songID'];
                    $name = $row['songName'];
                    $artist = $row['songArtist'];
                    $year = $row['songYear'];
                    $img = $row['songImg'];
                    $play = $row['songPlays'];

                    echo '
                                    <a href="AM_search.php?search=' . $name . '">
                                        <div class="item" >
                                            <img src="../uploads/' . $row['songImg'] . '"/>
                                                <div class = "play">
                                                    <span class = "fa fa-play"> </span>
                                                </div>
                                            <h4>' . $name . '</h4>
                                            <p>' . $artist . '</p>
                                            <p>' . $year . '</p>
                                            <br>
                                            <h4> Play Count : ' . $play . '</h4>
                                        </div> 
                                    </a>';
                }
            }
            ?>


        </div>
    </div>
    <div class="indexdisplay">
        <h1> Top Liked </h1>
        <div class="list">
            <?php
            //GET ACCOUNTS

            $sql = "SELECT songID , Count(songID) as TotalRepetitions 
                    FROM likes
                    GROUP BY songID
                    ORDER BY TotalRepetitions DESC 
                    LIMIT 5";
            $result = mysqli_query($con, $sql);
            while ($row =  mysqli_fetch_assoc($result)) {
                
                $songID = $row['songID'];

                $sql2 = "SELECT * FROM songs WHERE songID = $songID";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $id = $row2['songID'];
                $name = $row2['songName'];
                $artist = $row2['songArtist'];
                $year = $row2['songYear'];
                $img = $row2['songImg'];
                $play = $row2['songPlays'];

                $sql3 = "SELECT * FROM likes WHERE songID = $songID";
                $result3 = mysqli_query($con, $sql3);
                $queryResult = mysqli_num_rows($result3);
                echo '
                    <a href="AM_search.php?search=' . $name . '">
                        <div class="item" >
                            <img src="../uploads/' . $img . '"/>
                                <div class = "play">
                                    <span class = "fa fa-play"> </span>
                                </div>
                            <h4>' . $name . '</h4>
                            <p>' . $artist . '</p>
                            <p>' . $year . '</p>
                            <br>
                            <h4> Like Count : ' . $queryResult . '</h4>
                        </div> 
                    </a>';
            }

            ?>


        </div>
    </div>
</body>

</html>