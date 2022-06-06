<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вы успешно зарегистрированы!</title>
    <meta name="description" content="Заполнение формы"/>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href="css/style.css">

</head>


<body>
<?php
ob_start();
session_start();

$dbhost 	= "localhost";
$dbuser 	= "root";
$dbpass 	= "boltik4704QlramS_t";
$dbname 	= "kurs";
$charset 	= "utf8";

$dbcon = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$dbcon) {
    die("Ошибка подключения" . mysqli_connect_error());
}


require_once 'header.php';


if (isset($_POST['log'])) {
    $username = mysqli_real_escape_string($dbcon, $_POST['nam']);
    $password = mysqli_real_escape_string($dbcon, $_POST['pass']);
    $sql = "SELECT * FROM user WHERE name = '$username'";
    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_assoc($result);
    $row_count = mysqli_num_rows($result);


    if ($row_count == 1 && md5($password, $row['pass'])) {
        $_SESSION['nam'] = $username;
        header("location: page.php");

    } else {
        echo "<div>Ошибка</div>";
    }
}
    ?>
    <div class="navi">
        <main>
        <div class="form" style="text-align: center" >

           <form action="" method="POST">

             <label for="exampleInputEmail1" >Логин </label>
             <input type="text" class='form-control' id="exampleInputEmail1" placeholder="Login" name="nam"  value="<?php if(isset($_POST['nam'])){ echo strip_tags($_POST['nam']);}?>">
               <label for="exampleInputPassword1">Пароль</label>
               <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
             <br>
               <p><input type="submit" name="log" value="Войти" class="btn"></p>

            </form>
        </div>
        </main>
    </div>

<div class="foot">
    <hr>
    <footer>@2022 - Student's diary</footer>
</div>
</body>

</html>



