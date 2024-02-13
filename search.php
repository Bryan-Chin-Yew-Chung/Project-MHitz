<?php
    include_once 'userUI.php';
    include_once 'includes/dbh.inc.php';
    include_once 'includes/func.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/user.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
    <title> Search </title>
</head>
<body>
        <div class = "search">
            <form class="searcharea" action = "searchresult.php" method = "POST">
                <input type = "text" name="searchbox" placeholder="Enter Song Name / Artist / Year.... ">
                <button type = "submit" name="submitsearch"><i class="fa-solid fa-magnifying-glass fa-2x"></i></button>
            </form>            
        </div>



        <div class="display">
            <div class = "list">
               <?php
                //GET ACCOUNTS
                $sql = "SELECT * from `songs` LIMIT 20 ";
                $result = mysqli_query($con, $sql);


                if ($result) {
                        while ($row = mysqli_fetch_assoc($result)){
                            
                                $id = $row['songID'];
                                $name = $row['songName'];
                                $artist = $row['songArtist'];
                                $year = $row['songYear'];
                                $img = $row['songImg'];

                                echo '
                                    <a href="displaysong.php?songid=' . $id . '">
                                        <div class="item" >
                                            <img src="../uploads/' . $row['songImg'] . '"/>
                                                <div class = "play">
                                                    <span class = "fa fa-play"> </span>
                                                </div>
                                            <h4>' . $name . '</h4>
                                            <p>' . $artist . '</p>
                                        </div> 
                                    </a>';
                            }
                }           
                ?>


            </div>
    </div>


</body>
</html>