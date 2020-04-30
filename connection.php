<?php

    $serverName = "localhost" ;
    $dbName = "ead";
    $password = "fx92m67";
    $userName = "root";    

    $con = mysqli_connect($serverName,$userName,$password,$dbName);
    //IF ANY ERROR

    if(mysqli_connect_error($con))
    {
        echo "error: " . mysqli_connect_error($con) . "</br>";
    }
?>