<?php
    include_once 'adminUI.php'
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
        <h1> Account Manager </h1>

        <!--Data-->
        <div class="widgetAM">
            <div class="listAM">
                <div class="itemAM">
                    <span class="fa-solid fa-list-check fa-5x"></span>
                    <h4> Manage Accounts </h4>
                </div>
                
                <a href = "AM_accountcreator.php">
                    <div class="itemAM">
                        <span class="fa-solid fa-plus fa-5x"></span>
                        <h4> Make New Accounts </h4>
                    </div>
                </a>
            </div>

        
        </div>
    </div>
</body>
</html>


