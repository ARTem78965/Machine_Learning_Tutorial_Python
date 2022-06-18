<?php
session_start();
require_once 'auth.php';

$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

$sql = mysqli_query($conn, "SELECT `id`, `title` FROM `state` WHERE `id`='3'");

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
                Теперь пришло время взглянуть на данные более детально. На этом этапе мы погрузимся в анализ данные
                несколькими способами:
            </p><br>
            <ul>
                <li>Размерность датасета</li>
                <li>Просмотр среза данных</li>
                <li>Статистическая сводка атрибутов</li>
                <li>Разбивка данных по атрибуту класса.</li>
            </ul>
            <br>
            <p>
                Не волнуйтесь, каждый взгляд на данные является одной командой. Это полезные команды, которые можно
                использовать снова и снова в будущих проектах.
            </p><br>
            <h3>3.1 Размерность датасета</h3><br>
            <p>
                Рекомендуется убедиться, что среда Python была успешно установлена и работает в штатном состоянии.
                Сценарий ниже
                поможет вам проверить вашу среду. Он импортирует каждую библиотеку, требуемую в этом учебнике, и
                печатает версию.
            </p><br>
            <p>Откройте командную строку и запустите Python:</p>
            <textarea readonly style="width: 633px; height: 35px; resize: none;">
# shape
print(dataset.shape)
        </textarea><br><br>
            <p>
                Мы можем получить быстрое представление о том, сколько экземпляров (строк) и сколько атрибутов
                (столбцов) содержится в датасете с помощью метода shape.
            </p>
            <textarea readonly style="width: 633px; height: 20px; resize: none;">
(150, 5)
        </textarea><br><br>
            <p>Вы должны увидеть 150 экземпляров и 5 атрибутов:</p>
            <textarea readonly style="width: 633px; height: 50px; resize: none;">
# Срез данных head
print(dataset.head(20))
        </textarea><br><br>
            <h3>3.2 Просмотр среза данных</h3><br>
            <p>
                Исследовании данных, стоит сразу в них заглянуть, для этого есть метод head()
            </p>
            <textarea readonly style="width: 633px; height: 365px; resize: none;">
        sepal-length  sepal-width  petal-length  petal-width        class
0            5.1          3.5           1.4          0.2        Iris-setosa
1            4.9          3.0           1.4          0.2        Iris-setosa
2            4.7          3.2           1.3          0.2        Iris-setosa
3            4.6          3.1           1.5          0.2        Iris-setosa
4            5.0          3.6           1.4          0.2        Iris-setosa
5            5.4          3.9           1.7          0.4        Iris-setosa
6            4.6          3.4           1.4          0.3        Iris-setosa
7            5.0          3.4           1.5          0.2        Iris-setosa
8            4.4          2.9           1.4          0.2        Iris-setosa
9            4.9          3.1           1.5          0.1        Iris-setosa
10           5.4          3.7           1.5          0.2        Iris-setosa
11           4.8          3.4           1.6          0.2        Iris-setosa
12           4.8          3.0           1.4          0.1        Iris-setosa
13           4.3          3.0           1.1          0.1        Iris-setosa
14           5.8          4.0           1.2          0.2        Iris-setosa
15           5.7          4.4           1.5          0.4        Iris-setosa
16           5.4          3.9           1.3          0.4        Iris-setosa
17           5.1          3.5           1.4          0.3        Iris-setosa
18           5.7          3.8           1.7          0.3        Iris-setosa
19           5.1          3.8           1.5          0.3        Iris-setosa
        </textarea><br><br>
            <p>
                Это должно вывести первые 20 строк датасета.
            </p>
            <textarea readonly style="width: 633px; height: 55px; resize: none;">
# Стастические сводка методом describe
print(dataset.describe())
        </textarea><br><br>
            <h3>3.3 Статистическая сводка</h3>
            <br>
            <p>
                Давайте взглянем теперь на статистическое резюме каждого атрибута. Статистическая сводка включает в себя
                количество экземпляров, их среднее,
                мин и макс значения, а также некоторые процентили.
            </p><br>
            <textarea readonly style="width: 633px; height: 55px; resize: none;">
# Стастические сводка методом describe
print(dataset.describe()
        </textarea>
            <p>Мы видим, что все численные значения имеют одинаковую шкалу (сантиметры) и аналогичные диапазоны от 0 до
                8 сантиметров.</p>
            <textarea readonly style="width: 633px; height: 165px; resize: none;">
                sepal-length        sepal-width        petal-length        petal-width
count       150.000000        150.000000        150.000000       150.000000
mean        5.843333            3.054000            3.758667           1.198667
std            0.828066            0.433594            1.764420           0.763161
min           4.300000            2.000000            1.000000            0.100000
25%         5.100000            2.800000            1.600000            0.300000
50%         5.800000            3.000000            4.350000            1.300000
75%         6.400000            3.300000            5.100000            1.800000
max         7.900000            4.400000            6.900000             2.500000
        </textarea>
            <h3>3.4 Распределение классов</h3><br>
            <p>
                Давайте теперь рассмотрим количество экземпляров (строк), которые принадлежат к каждому классу. Мы можем
                рассматривать это как абсолютный счет.
            </p><br>
            <textarea readonly style="width: 633px; height: 95px; resize: none;">
# Распределение по атрибуту class
print(dataset.groupby('class').size())
        </textarea>
            <p>
                Мы видим, что каждый класс имеет одинаковое количество экземпляров (50 или 33% от датасета).
            </p>
            <textarea readonly style="width: 633px; height: 105px; resize: none;">
class
Iris-setosa        50
Iris-versicolor    50
Iris-virginica     50
dtype: int64
        </textarea>
            <h3>3.5 Резюме загрузки датасета</h3><br>
            <p>
                На будущее мы можем объединить все предыдущие элементы вместе в один скрипт..
            </p><br>
            <textarea readonly style="width: 633px; height: 335px; resize: none;">
# Загрузка библиотек
from pandas import read_csv

# Загрузка датасета
url = "https://raw.githubusercontent.com/jbrownlee/Datasets/master/iris.csv"
names = ['sepal-length', 'sepal-width', 'petal-length', 'petal-width', 'class']
dataset = read_csv(url, names=names)

# shape
print(dataset.shape)

# Срез данных head
print(dataset.head(20))

# Стастические сводка методом describe
print(dataset.describe())

# Распределение по атрибуту class
print(dataset.groupby('class').size())
        </textarea>
            <button type="submit"  class="btn alert-warning"><a href="lesson2.php"> Назад </a></button>
            <button type="submit"  class="btn alert-warning"><a href="lesson4.php"> Следующее </a></button>
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
                    <textarea name="comment" style="resize: none; height: 200px; width: 630px;" placeholder="Комментарий..."></textarea>
                </div>
                <div>
                    <button type="submit" class="btn alert-warning"><a> Отправить </a></button>
                </div>
                <?php if (isset($fmsg)) { ?>
                    <div class="alert alert-danger"><?php echo $fmsg; ?> </div><?php } ?>
                <?php
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S` WHERE `state` = 3;");

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
