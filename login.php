<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href = "css/reset.css">
    <link rel="stylesheet" href = "css/form.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
</head>
<body>
    <!-- Log In Form-->
    <div class="signup-form">
        <a href="index.php"><img src="./assets/logo.jpg" alt="logo" /> </a>
        <h2> Login </h2>
        <form action="includes/login.inc.php" method="post">
            <input type ="text" name="name" placeholder="Username/Email...." minlength="4" maxlength="50">
            <input type ="password" name="pwd" placeholder="Password...." minlength="4" maxlength="20">
                <?php
                    // Return error messages
                    if (isset($_GET["error"])){
                        if($_GET["error"] == "none"){
                            echo "<h3> Signup sucessful please log in! </h3>";
                        }
                        if($_GET["error"] == "emptyinput"){
                            echo "<h1> Require input is missing! </h1>";
                        }
                        if($_GET["error"] == "incorrectlogin"){
                            echo "<h1> Username/Email or passwords dont match! </h1>";
                        }
                    }

                ?>            
            <button type="submit" name = "submit">Login!</button>
        </form>
        <p> Dont have an account? <a href="signup.php"> Sign Up Here </a> </p>
    </div>
    
</body>
</html>