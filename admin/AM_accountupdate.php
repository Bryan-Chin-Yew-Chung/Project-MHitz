<?php
    include_once 'adminUI.php';
    include_once '../includes/dbh.inc.php';

    if(!isset($_GET["updateid"])){
        header("location: AM_accountcontrol.php");
    }

    if($_GET["updateid"] == 1){
        header("location: AM_accountcontrol.php?error=nicetry");
    }

    $id = $_GET['updateid'];

    $sql = "SELECT * from `users` WHERE usersID = $id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['usersName'];
    $email = $row['usersEmail'];
    $pwd = $row['usersPwd'];
    $type = $row['usersType'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
    <title>Update Account</title>
</head>
<body>
    <div class = "adminUserControl">
        <h1> Update Account </h1>

        <!-- Sign Up Form-->
            <div class="signup-form">
                <br> 
                <form action="../includes/AM_update.inc.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type ="text" name="name" value="<?php echo $name;?>">
                    <input type ="text" name="email" value="<?php echo $email;?>">
                    <input type ="password" name="pwd" placeholder="Leave Empty To Keep Old Password...">

                    <?php
                        if($type == "admin"){
                            echo'    <label for = "usertype"> Choose Usertype </label>';
                            echo'    <select name = "usertype">';
                            echo'    <option value = "admin"> admin </option>';
                            echo'    <option value = "user"> user </option>';
                            echo'    </select>';
                        }
                        else{
                            echo'    <label for = "usertype"> Choose Usertype </label>';
                            echo'    <select name = "usertype">';
                            echo'    <option value = "user"> user </option>';
                            echo'    <option value = "admin"> admin </option>';
                            echo'    </select>';                           
                        }
                    ?>

                    <button type="submit" name = "submit">Update!</button>
                </form>      

                <form class = "backACC">
                    <input type="submit" value="Back To Account Control" formaction="AM_accountcontrol.php">
                </form>
            </div>


        
        </div>
    </div>
</body>
</html>


