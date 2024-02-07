<?php 
    include_once "dbh.inc.php";


    
    if(isset($_GET['deleteplaylistdisplayn']) && isset($_GET['deleteplaylistdisplays'])){
        $songdel = $_GET['deleteplaylistdisplays'];
        $name = $_GET['deleteplaylistdisplayn'];


            // FOR LOOP TO CHECK FOR DELETION
            for ($x = 1; $x <= 10; $x++) {
                $sql = "SELECT song$x from `playlists` WHERE usersID = '$name'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_assoc($result);
                
                $song = $row['song' . $x .''];


                if ($song == $songdel){
                    $sql = "UPDATE `playlists` SET song$x = 0
                    WHERE usersID = '$name'";

                    $result = mysqli_query($con, $sql);

                    if($result){
                        header("location: ../displaysong.php??songid=" . $songdel ."");
                        exit();
                    }           
                }
        }


    }

    if(isset($_GET['removeplaylistsong']) && isset($_GET['removeplaylistname'])){
        $songdel = $_GET['removeplaylistsong'];
        $name = $_GET['removeplaylistname'];


            // FOR LOOP TO CHECK FOR DELETION
            for ($x = 1; $x <= 10; $x++) {
                $sql = "SELECT song$x from `playlists` WHERE usersID = '$name'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_assoc($result);
                
                $song = $row['song' . $x .''];


                if ($song == $songdel){
                    $sql = "UPDATE `playlists` SET song$x = 0
                    WHERE usersID = '$name'";

                    $result = mysqli_query($con, $sql);

                    if($result){
                        header("location: ../playlist.php?error=none");
                        exit();
                    }           
                }
        }


    }


    if(isset($_GET['deleteplaylist'])){
        $id = $_GET['deleteplaylist'];


        $sql = "DELETE from `playlists` WHERE usersID = '$id'";
        mysqli_query($con,$sql);

    }

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE from `users` WHERE usersID = '$id'";
        $result=mysqli_query($con,$sql);


        if($result){
            header("location: ../admin/AM_accountcontrol.php?error=deletesuccess");
        }
        else{
            die(mysqli_error($con));
        }
    }




    else if(isset($_GET['deletereq'])){
        $id = $_GET['deletereq'];

        $sql = "DELETE from `requests` WHERE songID = $id";
        $result=mysqli_query($con,$sql);

        if($result){
            header("location: ../admin/AM_requestcontrol.php?error=deletesuccess");
        }
        else{
            die(mysqli_error($con));
        }
    }

    else if(isset($_GET['cdeletereq'])){
        $id = $_GET['cdeletereq'];

        $sql = "DELETE from `requests` WHERE songID = $id";
        $result = mysqli_query($con,$sql);

        if($result){

            header("location: ../admin/AM_requestcontrol.php?error=crequestadded");
        }
        else{
            die(mysqli_error($con));
        }
    }

    //$sql = "SELECT usersType FROM users WHERE usersName = '$name';";
    //$result = mysqli_query($con , $sql);
    //$row = mysqli_fetch_assoc($result);

    else if(isset($_GET['deletesong'])){
        $id = $_GET['deletesong'];
        $sqlget = "SELECT songImg FROM `songs` WHERE songID = '$id'";
        $query = mysqli_query($con , $sqlget);

        while ($row = $query->fetch_assoc()) {
            $imagePath = "../uploads/" . $row['songImg'];
            $songPath = "../uploads/" . $row['songAudio'];
        }
        unlink($imagePath);
        unlink($songPath);

        $sql = "DELETE from `songs` WHERE songID = $id";
        $result=mysqli_query($con,$sql);

        if($result){
            header("location: ../admin/AM_songcontrol.php?error=songdeleted");
        }
        else{
            die(mysqli_error($con));
        }
    }



    else{
         header("location: ../admin/AM_accountcontrol.php");
    }