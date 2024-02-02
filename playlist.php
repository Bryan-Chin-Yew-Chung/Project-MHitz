<?php
include_once 'userUI.php';
include_once 'includes/dbh.inc.php';
$userID = $_SESSION['usersName'];

if (!isset($userID)) {
    header('location:login.php');
};


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
    <div class="container"> 

            <?php
                if (!isset ($songID)){
                    $songID = 0;
                }
                else {
                    $songID = $_GET['songid'];
                    $sqlplay = $query = "UPDATE songs SET songPlays = songPlays + 1 WHERE songID = $songID";
                    mysqli_query($con,$sqlplay);
                }

                


                if ($songID != 0){
                    //GET SONG DETAIL AND SHOW
                    $sql = "SELECT * from `playlists` WHERE userID = $userID";
                    $result = mysqli_query($con, $sql);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                                
                            $id = $row['songID'];
                            $name = $row['songName'];
                            $artist = $row['songArtist'];
                            $year = $row['songYear'];
                            $img = $row['songImg'];
                            $mp3 = $row['songAudio'];

                        echo '<div class="musicplayer">
                            <nav>
                                <a href = "search.php"><div class="circle">
                                    <i class="fa-solid fa-angle-left"> </i> 
                                </div></a>
                                <div class="circle">
                                    <i class="fa-regular fa-thumbs-up"></i>
                                </div>
                            </nav>     
                            <img src="uploads/' . $row['songImg'] . '"  class ="song-img">
                            <h1>' . $name . '</h1>
                            <p>' . $artist . '</p>


                            <audio id ="song">
                                <source src = "uploads/' . $row['songAudio'] . '" type = "audio/mpeg">
                            </audio>

                            <input type = "range" value = "0" id ="progress">

                                <div class="controls">
                                    <div> <i class="fa-solid fa-backward"></i> </div>
                                    <div onclick = "playPause()"> <i class="fa-solid fa-play" id = "ctrlIcon"></i> </div>    
                                    <div> <i class="fa-solid fa-forward"></i> </div>
                                </div>
                        </div>';
                    } 
                }  

                else {
                        echo '<div class="musicplayer">
                            <nav>
                                <a href = "index.php"><div class="circle">
                                    <i class="fa-solid fa-angle-left"> </i> 
                                </div></a>
                            </nav>     
                            <img src="assets/empty.jpeg"  class ="song-img">
                            <h1> Empty Playlist</h1>
                            <p> Browse Songs And Add Them To Your Playlist </p>


                            <audio id ="song">
                                <source type = "audio/mpeg">
                            </audio>

                            <input type = "range" value = "0" id ="progress">

                                <div class="controls">
                                    <div> <i class="fa-solid fa-backward"></i> </div>
                                    <div onclick = "playPause()"> <i class="fa-solid fa-play" id = "ctrlIcon"></i> </div>    
                                    <div> <i class="fa-solid fa-forward"></i> </div>
                                </div>
                        </div>';                    
                }        
                ?>
               
            </div>              
        </div> 

    
    <!-- SCRIPT TO RUN MUSIC PLAYER -->
    <script>
        let progress = document.getElementById("progress");
        let song = document.getElementById("song");
        let icon = document.getElementById("ctrlIcon");

        song.onloadeddata = function(){
            progress.max = song.duration;
            progress.value = song.currentTime;
            song.pause();
        }

    // SCRIPT to change play icon to pause vice versa
    function playPause(){
        if(icon.classList.contains("fa-pause")){
            song.pause();
            icon.classList.remove("fa-pause");
            icon.classList.add("fa-play");
        }
        else{
            song.play();
            icon.classList.add("fa-pause");
            icon.classList.remove("fa-play");
        }
    }



    if(song.play()){
        setInterval(()=>{
            progress.value = song.currentTime;
        } , 500);


    }




    </script>


</body>
</html>


</body>
</html>