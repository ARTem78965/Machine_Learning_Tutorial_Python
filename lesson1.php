<?php
session_start();
require_once 'auth.php';

$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

$sql = mysqli_query($conn, "SELECT `title` FROM `state` WHERE `id`='1'");
$num_state = mysqli_num_rows($sql);


while ($result = mysqli_fetch_array($sql)) {
    $title = $result['title'];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/block.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <title><?php echo $title; ?></title>
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
            <h1 name="title"> <?php echo $title; ?> </h1><br>
            <p>
                Раздел для тех, у кого ее не установлен Python и SciPy. Мы не будем подробно останавливаться на том как
                устанавливать Python, есть много пошаговых руководств в интернете как это сделать или рекомендуем
                посетить
                раздел "Введение в Python".
            </p><br>
            <h3> 1.1 Установка библиотек SciPy </h3><br>
            <p>
                Есть 5 ключевых библиотек, которые необходимо установить. Ниже приведен список библиотек Python SciPy,
                необходимых для этого руководства:
            </p><br>
            <ul>
                <li>scipy</li>
                <li>numpy</li>
                <li>matlibplot</li>
                <li>pandas</li>
                <li>sklearn</li>
            </ul>
            <br>
            <p>
                На сайте <a href="https://www.scipy.org/install.html"> SciPy </a>есть отличная инструкция по установке
                вышеуказанных библиотек на ключевых платформах: Windows, Linux, OS X mac. Если у вас есть какие-либо
                сомнения
                или вопросы, обратитесь к этому руководству, через него прошли миллионы людей.
            </p><br>
            <p>
                Существует множество способов установить библиотеки. В качестве совета мы рекомендуем выбрать один метод
                и
                быть
                последовательным в установке каждой библиотеки. Если вы пользуетесь Windows или вы не уверены как это
                сделать,
                мы рекомендуем установить бесплатную версию Anaconda, которая включает в себя все, что вам нужно
                (windows,
                macOS, Linux).
            </p><br>
            <h3>1.2 Запуск Python и проверка версий</h3><br>
            <p>
                Рекомендуется убедиться, что среда Python была успешно установлена и работает в штатном состоянии.
                Сценарий
                ниже
                поможет вам проверить вашу среду. Он импортирует каждую библиотеку, требуемую в этом учебнике, и
                печатает
                версию.
            </p><br>
            <p>Откройте командную строку и запустите Python:</p>
            <textarea readonly style="width: 633px; height: 74px; resize: none;">python</textarea><br><br>
            <p>
                Мы рекомендуем работать непосредственно в интерпретаторе или писать скрипты и запускать их в командной
                строке,
                нежели редакторах и IDEs. Это позволит сосредоточиться на машинном обучении, а не инструментарии
                программиста.
            </p><br>
            <p>Введите или скопируйте и вставьте следующий скрипт в интерпретатор:</p>
            <textarea readonly style="width: 633px; height: 378px; resize: none;">
# Проерка версий библиотек
# Версия Python
import sys
print('Python: {}'.format(sys.version))

# Загрузка scipy
import scipy
print('scipy: {}'.format(scipy.__version__))

# Загрузка numpy
import numpy
print('numpy: {}'.format(numpy.__version__))

# Загрузка matplotlib
import matplotlib
print('matplotlib: {}'.format(matplotlib.__version__))

# Загрузка pandas
import pandas
print('pandas: {}'.format(pandas.__version__))

# Загрукзка scikit-learn
import sklearn
print('sklearn: {}'.format(sklearn.__version__))
        </textarea><br><br>
            <p>Вот пример вывода:</p>
            <textarea readonly style="width: 633px; height: 105px; resize: none;">
Python: 3.7.0 (default, Jun 28 2018, 08:04:48) [MSC v.1912 64 bit (AMD64)]
scipy: 1.1.0
numpy: 1.15.1
matplotlib: 2.2.3
pandas: 0.23.4
sklearn: 0.19.2
        </textarea><br><br>
            <p>
                В идеале, ваши версии должны соответствовать или быть более поздними. API библиотек не меняются быстро,
                так
                что
                не не стоит переживать, если ваша версии другие. Все в этом урове, скорее всего, все еще будет работать
                для
                вас.
            </p><br>
            <p>
                Если же выдает ошибку, рекомендуем обновить версионность системы. Если вы не можете запустить скрипт
                выше,
                вы не сможете пройти урок.
            </p><br>
            <button type="submit" class="btn alert-warning"><a href="lesson2.php"> Следующее </a></button>

        </div>
    </div>
    <div class="features">
        <div class="block">
            <form method="post">
                <main>
                    <!--Комментарий-->
                    <?php
                    if (isset($_POST['comment'])) {
                        $comment = $_POST['comment'];

                        $sql1 = mysqli_query($conn, "SELECT `id` FROM `users` WHERE `login`='$login'");

                        while ($result = mysqli_fetch_array($sql1)) {
                            $num_user = $result['id'];
                        }

                        $result = mysqli_query($conn, "INSERT INTO `comments` (state, user, comment) VALUES('$num_state','$num_user','$comment');");

                        if ($result) {
                            header("Location: lesson1.php");
                        } else {
                            $fmsg = "Войдите или зарегистрируйтесь чтоб оставить комментарий!";
                        }
                    }
                    ?>
                    <div class="form-group help">
                        <h1> Комментарии </h1>
                        <textarea name="comment" style="resize: none; height: 200px; width: 630px;"
                                  placeholder="Комментарий..."></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn alert-warning"><a> Отправить </a></button>
                    </div>
                    <?php if (isset($fmsg)) { ?>
                        <div class="alert alert-danger"><?php echo $fmsg; ?> </div><?php } ?>
                </main>
                <?php
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S` WHERE `state` = 1;");

                while ($row = $sql2->fetch_assoc()) {
                    echo '<div style=" margin: 25px; padding: 50px; background: grey; border-radius: 10px; width: 550px; height: 5px; margin-left: 10px;"><h2> ' . $row['login'] . '</h2>';
                    echo '<h4>' . $row['comment'] . '</h4></div>';
                }
                ?>
            </form>
        </div>
    </div>
</main>
</body>
</html>