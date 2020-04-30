<?php 
    $serverName = "localhost" ;
    $dbName = "ead";
    $password = "fx92m67";
    $userName = "root";    

    $con = mysqli_connect($serverName,$userName,$password,$dbName);
    $name = array();
    $id = array();
    $data = array();
if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="bringFolders")
{
    $query = "Select*from folder where parentid='0'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $fname = $row["name"];
            $fid = $row["id"];
            $name[] = $fname;
            $id[] = $fid;
        }
        $data[] = $name;
        $data[] = $id;
    }
    echo json_encode($data);
}
if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="bringChilds")
{
    $getId = $_REQUEST["pid"];

    $serverName = "localhost" ;
    $dbName = "ead";
    $password = "fx92m67";
    $userName = "root";    

    $con = mysqli_connect($serverName,$userName,$password,$dbName);
    $name = array();
    $id = array();
    $data = array();

    $query = "Select*from folder where parentid=$getId";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $fname = $row["name"];
            $fid = $row["id"];
            $name[] = $fname;
            $id[] = $fid;
        }
        $data[] = $name;
        $data[] = $id;
    }

        echo json_encode($data);
    
}
if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="addFolder")
{
    $getId = $_REQUEST["pid"];
    $getName=$_REQUEST["inp-name"];
    $insertData="INSERT INTO folder (name,parentid) VALUES ('$getName','$getId')";
    $checkDuplicate = "SELECT name FROM folder where name='$getName'";
    $isDuplicate = mysqli_query($con,$checkDuplicate);

    if(mysqli_num_rows($isDuplicate)>0)
    {
        echo json_encode("0");
    }
    else
    {
        mysqli_query($con,$insertData);
        echo json_encode("Folder added successfully!");
    }
}

?>