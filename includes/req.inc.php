   <?php 
    // Error handling files
    require_once 'dbh.inc.php';
    require_once 'func.inc.php';
    
    // Check if reached page legitimatly
    if(isset($_GET["reqdata"])){

        // Get variables
        $reqid = $_GET["reqdata"];

        $sql = "DELETE from `requests` WHERE songID = '$reqid'";
        $result=mysqli_query($con,$sql);

        header("location: ../profile.php?error=requpdated");
        exit();

    }
    // Else banish to right page
    else{
        header("location: ../index.php?error=none");
        exit();
    }
