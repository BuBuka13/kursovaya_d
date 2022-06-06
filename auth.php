<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "boltik4704QlramS_t";
$db_name = "kurs";
$charset= "utf8";


$db = new mysqli($db_server, $db_user, $db_password, $db_name);
if ($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}



function auth($db,$login,$pass) {
    //Находим совпадение в базе данных
    $result = mysqli_query($db,"SELECT * FROM user WHERE name='$login' AND password='$pass'");
    if($result) {
        if(mysqli_num_rows($result) == 1) {//Проверяем, одно ли совпадение
            $user = mysqli_fetch_array($result); //Получаем данные пользователя и заносим их в сессию
            $_SESSION['name'] = $login;
            $_SESSION['password'] = $pass;
            $_SESSION['id'] = $user['id'];
            return true; //Возвращаем true, потому что авторизация успешна
        } else {
            unset($_SESSION); //Удаляем все данные из сессии и возвращаем false, если совпадений нет или их больше 1
            return false;
        }
    } else {
        return false; //Возвращаем ложь, если произошла ошибка
    }
}

function load($db) {
    $echo = "";
    if(auth($db,$_SESSION['name'],$_SESSION['password'])) {//Проверяем успешность авторизации
        $result = mysqli_query($db,"SELECT * FROM chat"); //Запрашиваем сообщения из базы
        if($result) {
            if(mysqli_num_rows($result) >= 1) {
                while($array = mysqli_fetch_array($result)) {//Выводим их с помощью цикла
                    $user_result = mysqli_query($db,"SELECT * FROM user WHERE id='$array[user_id]'");//Получаем данные об авторе сообщения
                    if(mysqli_num_rows($user_result) == 1) {
                        $user = mysqli_fetch_array($user_result);
                        $echo .= "<div class='chat__message chat__message_$user[nick_color]'><b>$user[login]:</b> $array[message]</div>"; //Добавляем сообщения в переменную $echo
                    }
                }

            } else {
                $echo = "Нет сообщений!";//В базе ноль записей
            }
        }
    } else {
        $echo = "Проблема авторизации";//Авторизация не удалась
    }

    return $echo;//Возвращаем результат работы функции
}

function send($db,$message) {
    if(auth($db,$_SESSION['login'],$_SESSION['password'])) {//Если авторизация удачна
        $message = htmlspecialchars($message);//Заменяем символы ‘<’ и ‘>’на ASCII-код
        $message = trim($message); //Удаляем лишние пробелы
        $message = addslashes($message); //Экранируем запрещенные символы
        $result = mysqli_query($db,"INSERT INTO chat (id, message) VALUES ('$_SESSION[id]','$message')");//Заносим сообщение в базу данных
    }
    return load($db); //Вызываем функцию загрузки сообщений
}
if(isset($_POST['act'])) {$act = $_POST['act'];}
if(isset($_POST['var1'])) {$var1 = $_POST['var1'];}
if(isset($_POST['var2'])) {$var2 = $_POST['var2'];}

switch($_POST['act']) {//В зависимости от значения act вызываем разные функции
    case 'load':
        $echo = load($db); //Загружаем сообщения
        break;

    case 'send':
        if(isset($var1)) {
            $echo = send($db,$var1); //Отправляем сообщение
        }
        break;

    case 'auth':
        if(isset($var1) && isset($var2)) {//Авторизуемся
            if(auth($db,$var1,$var2)) {
                $echo = load($db);
            }
        }
        break;
}

echo $echo;//Выводим результат работы кода