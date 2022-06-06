<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "boltik4704QlramS_t";
$db_name = "kurs";
$charset= "utf8";
try {

    $db = new mysqli($db_server, $db_user, $db_password, $db_name);
    if ($db->connect_error){
        die("Connection failed: " . $db->connect_error);
    }

}

catch(PDOException $e) {
    echo "Ошибка при создании записи в базе данных: " . $e->getMessage();
}

