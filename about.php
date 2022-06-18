<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/block.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <title>О нас</title>
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
            <p class="text"> Курс программы </p><br>
            <p class="text-designer">
                Предоставленные пособие вам покажет общее представление: Что такое машинное обучение?
                Как это работает? Почему она натолько важна для сегоднешнего времени? И какие перспективы на будушее?
                Данное пособие машинное обучение разрабатывается на языку Python. Но вы спросите почему именно Python а
                не
                другие языки программирование.<br><br>
                Python — высокоуровневый язык программирования общего назначения с динамической
                строгой типизацией и автоматическим управлением памятью, ориентированный на повышение производительности
                разработчика,
                читаемости кода и его качества, а также на обеспечение переносимости написанных на нём программ. Язык
                является полностью
                объектно-ориентированным — всё является объектами. Необычной особенностью языка является выделение
                блоков
                кода пробельными отступами.
                Синтаксис ядра языка минималистичен, за счёт чего на практике редко возникает необходимость обращаться к
                документации.
                Сам же язык известен как интерпретируемый и используется в том числе для написания скриптов.
                Недостатками
                языка
                являются зачастую более низкая скорость работы и более высокое потребление памяти написанных на нём
                программ
                по
                сравнению с аналогичным кодом, написанным на компилируемых языках, таких как Си или C++.<br><br>
                Сам Python очень легкий язык для усвоение начинающего программиста. Для разработки проектов
                рекомендуется
                скачать
                <a href="https://www.python.org/ftp/python/3.10.0/python-3.10.0-amd64.exe">Pyhton</a> с официального
                сайта,
                после этого рекомендуется установить редактор
                <a href="https://www.jetbrains.com/ru-ru/pycharm/download/download-thanks.html?platform=windows&code=PCC">PyCharm
                    Communnity.</a>
            </p>
        </div>
    </div>
</main>
</body>
</html>