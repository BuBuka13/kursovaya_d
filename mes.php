<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "boltik4704QlramS_t";
$db_name = "kurs";
$charset= "utf8";


$db = mysqli_connect($db_server, $db_user, $db_password, $db_name);
//new mysqli($db_server, $db_user, $db_password, $db_name);
//    if ($db->connect_error){
//        die("Connection failed: " . $db->connect_error);
//    }

if (!isset($_POST['add_message'])){
        echo '<form action="mes.php?add_message" method="post"> <input type="text" name="name" style="width: 100%; height: 25px;">
        <br><br>
        <input type="text" name="message" style="width: 100%; height: 40px;">
        <br><br>
        <button name="submit" >Send</button>
        </form>';
}




if (!isset($_POST['submit'])){
    if (!empty($_POST['name']) && !empty($_POST['message'])){
        $sql = "INSERT INTO chat(name, message, date) VALUES('".$_POST['name']."', '".$_POST['message']."', '".date('Y-m-d H:i')."'); ";
        mysqli_query($db, $sql);
    }
}

$sqll = "SELECT * FROM `chat` ORDER BY `date` ASC";
$result = $db->query($sqll);
if (!isset($_POST['add_message'])){
    if (mysqli_num_rows($result) >= 1){
        while ($out = mysqli_fetch_assoc($result)){
            echo $out['name'] ." | " . $out['date'] . "<br>" . $out['message'] . "<hr>";

        }
    }
}





