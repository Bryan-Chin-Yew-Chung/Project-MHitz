<?php
    include_once 'adminUI.php';
    include_once '../includes/dbh.inc.php';
    include_once '../includes/func.inc.php';

    $reqid = $_GET['reqid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/admin.css">
    <title> Create Song</title>
</head>

<body>
    <div class="songcreator">
        <h1> Create Song </h1>


    <div class = "flexbox">
        <!-- Sign Up Form-->
        <div class="signup-form">
            <br>
            <form action="../includes/AM_createSong.inc.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="reqID" value=" <?php echo $reqid ?>">
                <input type="text" name="name" placeholder="Song Name..." minlength="1" maxlength="20">
                <input type="text" name="artist" placeholder="Artist Name..." minlength="1" maxlength="20">
                <input type="number" min="1940" max="2024" name="date" placeholder="Year Released....">
                <label> Upload Image [png , jpg , jpeg] </label>
                <input type="file" name="songimg"  accept=".png, .jpg , .jpeg">
                <?php
                // Return error messages
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<h1> Required input is missing! </h1>";
                    }
                    if ($_GET["error"] == "filetoolarge") {
                        echo "<h1> File Too Large! </h1>";
                    }
                    if ($_GET["error"] == "badfile") {
                        echo "<h1> Not an accepted file type! </h1>";
                    }
                    if ($_GET["error"] == "songadded") {
                        echo "<h3> Song Succesfully Added! </h3>";
                    }
                }
                ?>
                <button type="submit" name="submit">Create Song!</button>
            </form>

            <form class="backACC">
                <input type="submit" value="Back To Song Control" formaction="AM_songcontrol.php">
            </form>
        </div>
<?php  

   if(isset($_GET["reqid"])) {
            

            //GET ACCOUNTS
            $sql = "SELECT * from `requests` WHERE songID = $reqid";
            $result = mysqli_query($con, $sql);  

            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['songID'];
                    $name = $row['usersName'];
                    $sname = $row['songName'];
                    $artist = $row['songArtist'];
                    $year = $row['songDate'];
                    $date = $row['reqDate'];

                    echo '<div class="reqHandler">';
                    echo '<div class="signup-form">'; 
                        echo '<h2> Selected Request </h2>';
                        echo '<div class="inner-form">'; 
                        echo '<h4> ID : ' .$id .'</h4>' ;
                        echo '<h4> User : ' .$name .'</h4>' ;
                        echo '<h4> Song Name : ' .$sname .'</h4>' ;
                        echo '<h4> Artist : ' .$artist .'</h4>' ;
                        echo '<h4> Year : ' .$year .'</h4>' ;
                        echo '<h4> Request Date : ' .$date .'</h4>' ;

                        echo '<br>';
                        echo '<br>';
                        echo '<br>';
                        echo '<br>';
                        echo '<br>';
                        echo '<br>';
    
                        echo '</div>';

                    echo '</div>';
                    echo '</div>';        
                            


                }
                }
        }

        else {
            $reqid = 0;
        }
            
    ?>
        

    </div>
    </div>
</body>

</html>