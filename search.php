<?php
    include_once 'userUI.php';
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
                <input type = "text" name="searchbox" placeholder="Search... ">
                <button type = "submit" name="submitsearch"><i class="fa-solid fa-magnifying-glass fa-2x"></i></button>
            </form>            
        </div>


        <div class="display">

            <div class = "list">
                <div class="item">
                <img src= "assets/song1.jpeg" />
                    <div class = "play">
                        <span class = "fa fa-play"> </span>
                    </div>
                    <h4> GAmer Hits </h4>
                    <p> Wololo </p>
                </div>
                <div class="item">
                <img src= "assets/song1.jpeg" />
                    <div class = "play">
                        <span class = "fa fa-play"> </span>
                    </div>
                    <h4> GAmer Hits </h4>
                    <p> Wololo </p>
                </div>
                <div class="item">
                <img src= "assets/song1.jpeg" />
                    <div class = "play">
                        <span class = "fa fa-play"> </span>
                    </div>
                    <h4> GAmer Hits </h4>
                    <p> Wololo </p>
                </div>
                <div class="item">
                <img src= "assets/song1.jpeg" />
                    <div class = "play">
                        <span class = "fa fa-play"> </span>
                    </div>
                    <h4> GAmer Hits </h4>
                    <p> Wololo </p>
                </div>
                <div class="item">
                <img src= "assets/song1.jpeg" />
                    <div class = "play">
                        <span class = "fa fa-play"> </span>
                    </div>
                    <h4> GAmer Hits </h4>
                    <p> Wololo </p>
                </div>
                <div class="item">
                <img src= "assets/song1.jpeg" />
                    <div class = "play">
                        <span class = "fa fa-play"> </span>
                    </div>
                    <h4> GAmer Hits </h4>
                    <p> Wololo </p>
                </div>
                <div class="item">
                <img src= "assets/song1.jpeg" />
                    <div class = "play">
                        <span class = "fa fa-play"> </span>
                    </div>
                    <h4> GAmer Hits </h4>
                    <p> Wololo </p>
                </div>
            </div>
    </div>

        <div class = "search">
            <form class="searcharea" action = "searchresult.php" method = "POST">
                <input type = "text" name="searchbox" placeholder="Search... ">
                <button type = "submit" name="submitsearch"><i class="fa-solid fa-magnifying-glass fa-2x"></i></button>
            </form>            
        </div>

</body>
</html>