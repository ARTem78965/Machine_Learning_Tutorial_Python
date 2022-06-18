<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/block.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <title>Контакты</title>
</head>
<body>
<div class="header">
    <div class="header__section">
        <div><a href="index.php"><img class="logo" src="img/logo.png" alt="Машинное обучение"/></a></div>
        <div class="header__item headerButton"><a class="panel" href="index.php">Главная</a></div>
        <div class="header__item headerButton"><a class="panel" href="learning.php">Учебник</a></div>
        <div class="header__item headerButton"><a class="panel" href="about.php">Курс программы</a></div>
        <div class="header__item headerButton"><a class="panel" href="contact.php">Контакты</a></div>
    </div>
    <div class="header__section">
        <?php
        session_start();
        require_once 'auth.php';

        if (isset($_SESSION['login'])) {
            $login = $_SESSION['login']; ?>
            <div class="header__item headerButton">
                <a class="panel">
                    <?php echo $login; ?>
                </a>
            </div>
            <div class="header__item headerButton">
                <a href='logout.php' class='panel'>
                    Выход
                </a>
            </div>
        <?php } else { ?>
            <div class="header__item headerButton"><a class="panel" href="singin.php">Вход</a></div>
            <div class="header__item headerButton"><a class="panel" href="registr.php">Регистрация</a></div>
        <?php } ?>
    </div>
</div>
<main>
    <div class="features">
        <div class="block">
            <p align="center" class="text"> Как с нами связаться </p><br><br><br><br>
            <img class="photo" src="https://teatral-online.ru/i/ph/xl/xl_20191211150357.jpg"><!--  Исправить  -->
            <div class="text-designer">
                <p>Симонов Иннокентий Витальевич</p>
                <p>Почта: <a href="123@gmail.com">123@gmail.com</a></p>
                <p>Telegram: <a href="https://web.telegram.org/@sall">@Sa11y</a></p>
                <p>Вконтакте: <a href="https://vk.com/el_barto">Sally_W20</a></p>
            </div>
        </div>
    </div>
</main>
</body>
</html>
