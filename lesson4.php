<?php
session_start();
require_once 'auth.php';

$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

$sql = mysqli_query($conn, "SELECT `id`, `title` FROM `state` WHERE `id`='4'");

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
            <p>
                Теперь когда у нас есть базовое представление о данных, давайте расширим его с помощью визуализаций.
            </p><br>
            <p>
                Мы рассмотрим два типа графиков:
            </p><br>
            <ul>
                <li>Одномерные (Univariate) графики, чтобы лучше понять каждый атрибут.</li>
                <li>Многомерные (Multivariate) графики, чтобы лучше понять взаимосвязь между атрибутами.</li>
            </ul>
            <br>
            <h3> 4.1 Одномерные графики </h3><br>
            <p>
                Начнем с некоторых одномерных графиков, то есть графики каждой отдельной переменной. Учитывая, что
                входные
                переменные являются числовыми, мы можем создавать диаграмма размаха (или "ящик с усами",
                по-английски <a
                        href="https://ru.wikipedia.org/wiki/%D0%AF%D1%89%D0%B8%D0%BA_%D1%81_%D1%83%D1%81%D0%B0%D0%BC%D0%B8">"box
                    and whiskers diagram" </a>
                ) каждого из них.
            </p><br>
            <textarea readonly style="width: 633px; height: 65px; resize: none;">
# Диаграмма размаха
dataset.plot(kind='box', subplots=True, layout=(2,2), sharex=False, sharey=False)
pyplot.show()
        </textarea><br><br>
            <p>
                Это дает нам более четкое представление о распределении атрибутов на входе.
            </p>
            <img src="img/learn/1.png"/><br>
            <p>
                Диаграмма размаха атрибутов входных данных
            </p><br>
            <p>
                Мы также можем создать гистограмму входных данных каждой переменной, чтобы получить представление о
                распределении.
            </p><br>
            <textarea readonly style="width: 633px; height: 65px; resize: none;">
# Гистограмма распределения атрибутов датасета
dataset.hist()
pyplot.show()
        </textarea><br><br>
            <p>
                Из графиков видно, что две из входных переменных имеют около гауссово (нормальное) распределение. Это
                полезно отметить,
                поскольку мы можем использовать алгоритмы, которые могут использовать это предположение.
            </p><br>
            <img src="img/learn/2.png"/><br>
            <p>
                Гистограммы входных данных атрибутов датасета
            </p><br>
            <h3>4.2 Многомерные графики</h3><br>
            <p>
                Теперь мы можем посмотреть на взаимодействия между переменными.
            </p><br>
            <p>
                Во-первых, давайте посмотрим на диаграммы рассеяния всех пар атрибутов. Это может быть полезно для
                выявления
                структурированных взаимосвязей между входными переменными.
            </p>
            <textarea readonly style="width: 633px; height: 65px; resize: none;">
#Матрица диаграмм рассеяния
scatter_matrix(dataset)
pyplot.show()
        </textarea><br><br>
            <p>
                Обратите внимание на диагональ некоторых пар атрибутов. Это говорит о высокой корреляции и предсказуемой
                взаимосвязи.
            </p><br>
            <img src="img/learn/3.png"><br>
            <h3>4.3 Резюме визуализации данных</h3><br>
            <p>
                Для справки мы можем связать все предыдущие элементы вместе в один скрипт. Полный пример приведен ниже.
            </p>
            <textarea readonly style="width: 633px; height: 335px; resize: none;">
# Загрузка библиотек
from pandas import read_csv

# Загрузка датасета
url = "https://raw.githubusercontent.com/jbrownlee/Datasets/master/iris.csv"
names = ['sepal-length', 'sepal-width', 'petal-length', 'petal-width', 'class']
dataset = read_csv(url, names=names)

# Диаграмма размаха
dataset.plot(kind='box', subplots=True, layout=(2,2), sharex=False, sharey=False)
pyplot.show()

# Гистограмма распределения атрибутов датасета
dataset.hist()
pyplot.show()

#Матрица диаграмм рассеяния
scatter_matrix(dataset)
pyplot.show()
        </textarea>
            <button type="submit" class="btn alert-warning"><a href="lesson3.php"> Назад </a></button>
            <button type="submit" class="btn alert-warning"><a href="lesson5.php"> Следующее </a></button>
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
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S` WHERE `state` = 4;");

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
