<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/block.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <title>Учебник</title>
</head
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
            <p class="text" align="center"> Учебник </p>
            <div class="post-anonce">
                <p class="text-designer">1 Загрузка, установка и запуск Python и SciPy</p>
                <a class="btn-next alert-warning" href="lesson1.php"> Читать далее </a>
            </div>
            <br>
            <div class="post-anonce">
                <p class="text-designer">2. Загрузите данные</p>
                <a class="btn-next alert-warning" href="lesson2.php"> Читать далее </a>
            </div>
            <br>
            <div class="post-anonce">
                <p class="text-designer">3. Анализ датасета</p>
                <a class="btn-next alert-warning" href="lesson3.php"> Читать далее </a>
            </div>
            <br>
            <div class="post-anonce">
                <p class="text-designer">4. Визуализация данных</p>
                <a class="btn-next alert-warning" href="lesson4.php"> Читать далее </a>
            </div>
            <br>
            <div class="post-anonce">
                <p class="text-designer">5. Оценка алгоритмов</p>
                <a class="btn-next alert-warning" href="lesson5.php"> Читать далее </a>
            </div>
            <br>
            <div class="post-anonce">
                <p class="text-designer">6. Прогнозирование данных</p>
                <a class="btn-next alert-warning" href="lesson6.php"> Читать далее </a>
            </div>
            <br>
            <div class="post-anonce">
                <p class="text-designer">Машинное обучение в Python это не сложно</p>
                <a class="btn-next alert-warning" href="MLearn.php"> Читать далее </a>
            </div>
            <br>
        </div>
    </div>
</main>
</body>
</html>