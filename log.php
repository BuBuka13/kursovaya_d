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

$login = filter_var(trim($_POST['nam']), FILTER_SANITIZE_STRING); // Удаляет все лишнее и записываем значение в переменную //$login
$name = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

if(mb_strlen($login) < 5 || mb_strlen($login) > 90){
    echo "Недопустимая длина логина";
    exit();
}
else if(mb_strlen($name) < 5){
    echo "Недопустимая длина имени.";
    exit();
} // Проверяем длину имени

$pass = md5($pass."thisisforhabr"); // Создаем хэш из пароля
    //$name=$_POST['nam'];
    //$spec=$_POST['speci'];
    //$hob = $_POST['hob'];
// Переносим данные (отмеченные жанры) из полей формы в массив


   $sql = "INSERT INTO user(id, name, email, password) VALUES(NULL, '$login','$name', '$pass')";
if ($db->query($sql) === TRUE) {

    header("Location: enter.php");


}
else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$result1 = $db->query("SELECT * FROM `user` WHERE `name` = '$login'");
$user1 = $result1->fetch_assoc(); // Конвертируем в массив
if(!empty($user1)){
    echo "Данный логин уже используется!";
    exit();
}

header('Location: /');



?>
