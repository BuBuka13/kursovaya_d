<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добро пожаловать!</title>
    <meta name="description" content="Наш аккаунт"/>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="fon">
        <div class="container">
            <div class="ar">
                <a class="logo" style="font-family: Georgia serif; color: darkslategray"> <i> Student's Diary</i></a>
                <a class="logo" href="exit.php">Выход из аккаунта</a>
                <a class="logo" href="chat.php">Чат</a>

            </div>
        </div>
        <hr>
    </div>
    <?php
    session_start();
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

    ?>



    <div class ="header-content">
        <div class="intro">
            <h1 class="place" style="text-align: center;" >Здравствуй, <?php echo $_SESSION["nam"]; ?>!</h1>



        </div>

    </div>
</header>

    <div class="navi">
    <div class="container">
        <div class="navi" style="text-align: center" >
        <a class = "logo" href="#s" >Список домашки        </a>
        <a class = "logo" href="#f"> Нужные файлы          </a>
        <a class = "logo" href="#d" > Добавить дз</a>
    </div>

        <h2 id="d">Добавить дз</h2>
        <form action="add.php" method="post">
            <p> <textarea name="title" cols="30" rows="3" maxlength="100" placeholder="Введите название заметки..."></textarea></p>
            <p> <textarea name="list" cols="100" rows="6" maxlength="100" placeholder="Введите текст заметки..."></textarea> </p>



            <button class="btn" type="submit" name="send"> Добавить </button>
        </form>
        <hr>

        <h2 id="s">Список дз</h2>
        <?php


        $sql = "SELECT * FROM posts";
        if($result = $db->query($sql)){
            $rowsCount = $result->num_rows; // количество полученных строк
            echo "<p>Заметок: $rowsCount</p>";
            echo "<table  border='1' cellpadding='0' cellspacing='0' ><tr><th>Название</th><th>Заметка</th><th>Delete</th></tr>";
            foreach($result as $row){
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";

                echo "<td>
           <form action='delete.php' method='post'>
           <input type='hidden' name='id' value='" . $row["id"] . "' />
                <button class='btn'>Удалить</button>
                </form>
               </td>";


                echo "</tr>";
            }
            echo "</table>";
            $result->free();
        } else{
            echo "Ошибка: " . $db->error;
        }

        ?>
        <hr>

        <h2 id="f">Нужные файлы</h2>

        <p><a style="color: black">Методичка по ТВИМС </a>
            <a href="img/Metodichka_TVMS.pdf" download>Скачать файл</a>
        </p>

        <p><a style="color: black">Законы распределения </a>
            <a href="img/Zakony_raspredelenia.docx" download>Скачать файл</a>
        </p>

        <p><a style="color: black">Варианты РГР </a>
            <a href="img/Metodichka_TVMS.pdf" download>Скачать файл</a>
        </p>

        <p><a style="color: black">ФХ методичка </a>
            <a href="img/Metodichka_TVMS.pdf" download>Скачать файл</a>
        </p>

        <p><a style="color: black">Пример отчета </a>
            <a href="img/Metodichka_TVMS.pdf" download>Скачать файл</a>
        </p>
    </div>




</div>
<div class="foot">
    <hr>
    <footer>@2022 - Student's diary</footer>
</div>


</body>
</html>
