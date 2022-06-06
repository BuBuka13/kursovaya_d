<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "boltik4704QlramS_t";
$db_name = "kurs";
$charset 	= "utf8";


$db = new mysqli($db_server, $db_user, $db_password, $db_name);
if ($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}



if(isset($_POST["id"]))
{

    $userid = $db->real_escape_string($_POST["id"]);

    $sql = "DELETE FROM posts WHERE id = '$userid'";


    if($db->query($sql)){

        header("Location: page.php");
    }
    else{
        echo "Ошибка: " . $db->error;
    }

    $db->close();
}

















