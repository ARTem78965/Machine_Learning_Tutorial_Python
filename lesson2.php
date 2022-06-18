<?php
session_start();
require_once 'auth.php';

$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

$sql = mysqli_query($conn, "SELECT `id`, `title` FROM `state` WHERE `id`='2'");

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
                Мы будем использовать датасет цветов ирисов Фишера. Этот датасет известен тем, что он используется
                практически
                всеми в качестве "hello world" примера в машинном обучении и статистике.
            </p><br>
            <p>
                Набор данных содержит 150 наблюдений за цветами ириса. В датасете есть четыре колонки измерений цветов в
                сантиметрах.
                Пятая колонна является видом наблюдаемого цветка.
            </p>
            <p>
                Все наблюдаемые цветы принадлежат к одному из трех видов. Узнать больше об этом датасете можно в
                <a href="https://ru.wikipedia.org/wiki/%D0%98%D1%80%D0%B8%D1%81%D1%8B_%D0%A4%D0%B8%D1%88%D0%B5%D1%80%D0%B0">
                    Википедия.
                </a>
            </p>
            <p>
                На этом этапе мы загрузим данные из URL-адреса в CSV файл.
            </p><br>
            <h3> 2.1 Импорт библиотек </h3><br>
            <p>
                Во-первых, давайте импортировать все модули, функции и объекты, которые мы планируем использовать в этом
                уроке.
            </p><br>
            <textarea readonly style="width: 633px; height: 276px; resize: none;">
# Загрузка библиотек

from pandas import read_csv
from pandas.plotting import scatter_matrix
from matplotlib import pyplot
from sklearn.model_selection import train_test_split
from sklearn.model_selection import cross_val_score
from sklearn.model_selection import StratifiedKFold
from sklearn.metrics import classification_report
from sklearn.metrics import confusion_matrix
from sklearn.metrics import accuracy_score
from sklearn.linear_model import LogisticRegression
from sklearn.tree import DecisionTreeClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis
from sklearn.naive_bayes import GaussianNB
from sklearn.svm import SVC
        </textarea><br><br>
            <p>
                Все должно загружаться без ошибок. Если у вас есть ошибка, остановитесь. Перед продолжением необходима
                рабочая
                среда SciPy. Посмотрите совет выше о настройке вашей среды.
            </p><br>
            <h3> 2.2 Загрузка датасета</h3><br>
            <p>
                Мы можем загрузить данные непосредственно из репозитория машинного обучения UCI.
            </p><br>
            <p>
                Мы используем модуль pandas для загрузки данных. Мы также будем использовать pandas чтобы исследовать
                данные
                как целей описательной статистики, так для визуализации данных.
            </p><br>
            <p>
                Обратите внимание, что при загрузке данных мы указываем имена каждого столбца. Это поможет позже, когда
                мы
                будем исследовать данные.
            </p>
            <textarea readonly style="width: 633px; height: 95px; resize: none;">
# Загрузка датасета

url = "https://raw.githubusercontent.com/jbrownlee/Datasets/master/iris.csv"
names = ['sepal-length', 'sepal-width', 'petal-length', 'petal-width', 'class']
dataset = read_csv(url, names=names)
        </textarea><br><br>
            <p>
                Датасет должен загрузиться без происшествий.
            </p><br>
            <p>
                Если у вас есть проблемы с сетью, вы можете скачать файл
                <a href="https://ssl.microsofttranslator.com/bv.aspx?ref=TVert&from=&to=ru&a=iris.csv">iris.csv</a> в
                рабочую
                директорию и загрузить его с помощью того же метода, изменив URL на локальное имя файла.
            </p><br>
            <button type="submit" class="btn alert-warning"><a href="lesson1.php"> Назад </a></button>
            <button type="submit" class="btn alert-warning"><a href="lesson3.php"> Следующее </a></button>
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
                </main>
                <?php
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S` WHERE `state` = 2;");

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