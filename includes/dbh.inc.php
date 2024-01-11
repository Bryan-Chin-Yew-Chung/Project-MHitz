<?php

    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "mhitz";

    $con = mysqli_connect($serverName, $dbUsername , $dbPassword , $dbName);

    if(!$con){
        die("Connection Failed: " . mysqli_connect_error());
    }
