<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <meta name="description" content="Заполнение формы"/>
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
                <a class = "logo" href="index.php" > Главная</a>
                <a class = "logo" href="login.php"> Регистрация</a>
                <a class = "logo" href="enter.php" > Вход</a>

            </div>
        </div>
        <hr>
    </div>
    <div class ="header-content">
    <div class="intro">
        <h1 class="place" style="text-align: center">Регистрация</h1>


    </div>

    </div>





</header>

<div class="navi" style="text-align: center">
    <main>
        <h2 class="names">Заполните форму</h2>
        <div class="form">
            <form action="log.php" method="post">

                <p>Ваш логин:<span>*</span>  <input type="text" name = "nam" style="width: 400px" required ></p>
                <p>Пароль:<span>*</span> <input type="text" name = "pass" style="width: 400px" required></p>
                <p>Почта:<span>*</span> <input type="text" name = "email" style="width: 400px" required></p>



                <button class="btn">Добавить новую запись</button>

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



