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
    <title>Admin Dashboard</title>
</head>
<body>
    <div class = "adminDashboard">
        <h1> Dashboard </h1>
        
        <!--Data-->
        <div class="adminData">
            <div class="list">
            <div class="item">
                <h6> Most Liked Song </h6>
                <div class="itemstuff">
                    <div class="itemgroup">
                        <img src="../assets/song1.jpeg" /> 
                        <h4> Steady Bom Bibi </h4>
                        <p> 低清DISSY </p>
                    </div>
                    <div class="itemdesc">
                        <h4> Likes : 66 </h4>
                        <h4> Comments : 10 </h4>
                    </div>


                </div>
                </div>

              <div class="item">
                <h6> Most Liked Song </h6>
                <div class="itemstuff">
                    <div class="itemgroup">
                        <img src="../assets/song1.jpeg" /> 
                        <h4> Steady Bom Bibi </h4>
                        <p> 低清DISSY </p>
                    </div>
                    <div class="itemdesc">
                        <h4> Likes : 66 </h4>
                        <h4> Comments : 10 </h4>
                    </div>


                </div>
                </div>

        
        </div>
    </div>
</body>
</html>


