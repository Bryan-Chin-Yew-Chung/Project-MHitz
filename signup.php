<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href = "css/reset.css">
    <link rel="stylesheet" href = "css/form.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
</head>
<body>
    <!-- Sign Up Form-->
    <div class="signup-form">
        <a href="index.php"><img src="./assets/logo.jpg" alt="logo" /> </a>
        <h2> Sign Up </h2>
        <form action="includes/signup.inc.php" method="post">
            <input type ="text" name="name" placeholder="Username...." minlength="4" maxlength="20">
            <input type ="text" name="email" placeholder="Email...." minlength="4" maxlength="50">
            <input type ="password" name="pwd" placeholder="Password...." minlength="4" maxlength="20">
            <input type ="password" name="pwdrepeat" placeholder="Repeat Password...." minlength="4" maxlength="20">
                <?php
                    // Return error messages
                    if (isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                            echo "<h1> Required input is missing! </h1>";
                        }
                        if($_GET["error"] == "invalidusername"){
                            echo "<h1> Invalid Username! [A-Z | 0-9] </h1>";
                        }
                        if($_GET["error"] == "invalidemail"){
                            echo "<h1> Invalid Email! </h1>";
                        }
                        if($_GET["error"] == "passwordmismatch"){
                            echo "<h1> Passwords don't match! </h1>";
                        }
                        if($_GET["error"] == "username/emailtaken"){
                            echo "<h1> Username or Email Taken! </h1>";
                        }
                    }

                ?>
            <button type="submit" name = "submit">Sign Up!</button>
        </form>
        <p> Already Have An Account? <a href="login.php"> Login Here </a> </p>
        

    </div>


    
</body>
</html>