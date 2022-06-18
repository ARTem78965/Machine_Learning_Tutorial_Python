<?php
session_start();
require_once 'auth.php';

$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

$sql = mysqli_query($conn, "SELECT `id`, `title` FROM `state` WHERE `id`='7'");

while ($result = mysqli_fetch_array($sql)) {
    $id = $result['id'];
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
    <link rel="icon" href='img/logo.png' type='image/x-icon'>
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
            <h1> <?php echo $title; ?> </h1><br>
            <p>Проработайте примеры из урока, это не займет дольше 10-15 минут.</p><br>
            <p>
                <b>Вам не обязательно сразу все понимать. </b>Ваша цель состоит в том, чтобы запустить ряд скриптов
                описанных в уроке
                и получить конечный результат. Вам не нужно понимать все при первом проходе. Записывайте свои вопросы
                параллельно с тем
                как пишите код. Рекомендуем использовать справку ("FunctionName") в Python чтобы разобраться глубже во
                всех функциях, которые
                вы используете.
            </p><br>
            <p>
                <b>Вам не нужно знать, как работают алгоритмы. </b>Важно знать об ограничениях и о том, как настроить
                алгоритмы машинного обучения.
                Более подробное узнать о конкретных алгоритмах можно и позже. Вы должны постепенно накапливать знания о
                работе алгоритмы. Сегодня,
                начните с того что поймете как его использовать в Python.
            </p><br>
            <p>
                <b>Вам не нужно быть программистом Python. </b>Синтаксис языка Python может быть интуитивно понятным,
                даже если вы новичок в нем.
                Как и на других языках, сосредоточьтесь на вызовах функций (например,function()) и назначениях
                (например, a = "b"). Если вы являетесь
                разработчиком, вы итак уже знаете, как подобрать основы языка очень быстро.
            </p><br>
            <p>
                <b>Вам не нужно быть экспертом по машинного обучению. </b>Вы можете узнать о преимуществах и
                ограничениях различных алгоритмов гораздо позже,
                и есть много информации в интернете, о более глубинных тонкостях алгоритмов и этапах проекта машинного
                обучения и важности оценки точности с
                помощью перекрестной валидации.
            </p><br>
            <h3> Итог </h3><br>
            <p>Вы сделали свой первый мини-проект по машинному обучению в Python.</p><br>
            <p>
                Вы наверняка обнаружили, что после завершения даже небольшого проекта от загрузки данных до
                прогнозирования — вы уже намного сильнее продвинулись.
            </p><br>
            <p>
                <b>Какие могут быть следующие шаги по изучению машинного обучения?</b>
            </p><br>
            <p>
                Мы не освещали все этапы проекта машинного обучения, потому что это ваш первый проект, и нам нужно
                сосредоточиться на ключевых этапах. А именно,
                загрузке данных, анализе данных, оценка некоторых алгоритмов и прогнозировании данных. В других уроках
                мы рассмотрим другие аспекты машинного
                обучения по подготовке данных и улучшению результатов.
            </p><br>
            <button type="submit"  class="btn alert-warning"><a href="lesson6.php"> Назад </a></button>
        </div>
    </div>
    <div class="features">
        <div class="block">
            <form method="post">

                <!--Комментарий-->
                <?php
                if (isset($_POST['comment'])) {
                    $comment = $_POST['comment'];

                    $sql1 = mysqli_query($conn, "SELECT `id` FROM `users` WHERE `login`='$login'");

                    while ($result = mysqli_fetch_array($sql1)) {
                        $num_user = $result['id'];
                    }
                    $result = mysqli_query($conn, "INSERT INTO `comments` (state, user, comment) VALUES('$id','$num_user','$comment');");

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
                <?php
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S` WHERE `state` = 7;");

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

