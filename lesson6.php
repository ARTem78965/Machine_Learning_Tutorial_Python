<?php
session_start();
require_once 'auth.php';

$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

$sql = mysqli_query($conn, "SELECT `id`, `title` FROM `state` WHERE `id`='6'");

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
                Прежде чем что-либо прогнозировать необходимо выбрать алгоритм для прогнозирования. По результатам
                оценки моделей
                предыдущего раздела мы выбрали модель SVM как наиболее точную. Мы будем использовать эту модель в
                качестве нашей конечной модели.
            </p><br>
            <p>
                Теперь мы хотим получить представление о точности модели на нашей контрольной выборке данных.
            </p><br>
            <p>
                Это даст нам независимую окончательную проверку точности лучшей модели. Полезно сохранить контрольную
                выборку для случаев когда была
                допущена ошибки в процессе обучения, такая как переобучение или утечка данных. Обе эти проблемы могут
                привести к чрезмерно оптимистичному результату.
            </p><br>
            <h3>6.1 Создаем прогноз</h3><br>
            <p>
                Мы можем протестировать модель на всей выборке обучаемых данных и сделать прогноз на контрольной
                выборке.
            </p><br>
            <textarea readonly style="width: 633px; height: 85px; resize: none;">
# Создаем прогноз на контрольной выборке
model = SVC(gamma='auto')
model.fit(X_train, Y_train)
predictions = model.predict(X_validation)
        </textarea><br><br>
            <h3>6.2 Оцениваем прогноз</h3><br>
            <p>
                Мы можем оценить прогноз, сравнив его с ожидаемым результатом контрольной выборки, а затем вычислить
                точность классификации, а также матрицу ошибок и отчет о классификации.
            </p><br>
            <textarea readonly style="width: 633px; height: 85px; resize: none;">
# Оцениваем прогноз
print(accuracy_score(Y_validation, predictions))
print(confusion_matrix(Y_validation, predictions))
print(classification_report(Y_validation, predictions))
        </textarea><br><br>
            <p>
                Мы видим, что точность 0,966 или около 96% на контрольной выборке.
            </p><br>
            <p>
                Матрица ошибок дает представление об одной допущенной ошибке (сумма недиагональных значений).
            </p><br>
            <p>
                Наконец, отчет о классификации предусматривает разбивку каждого класса по точности (precision), полнота
                (recall),
                f1-оценка, показывающим отличные результаты (при этом контрольная выборка была небольшая, всего 30
                значений)..
            </p><br>
            <textarea readonly style="width: 633px; height: 195px; resize: none;">
0.9666666666666667
[[11  0  0]
 [ 0 12  1]
 [ 0  0  6]]
                 precision    recall  f1-score   support

    Iris-setosa       1.00      1.00      1.00        11
Iris-versicolor       1.00      0.92      0.96        13
 Iris-virginica       0.86      1.00      0.92         6

    avg / total       0.97      0.97      0.97        30
        </textarea><br><br>
            <h3>6.3 Резюме прогнозирование данных</h3><br>
            <p>Для справки мы можем связать все предыдущие элементы вместе в один скрипт. Полный пример приведен
                ниже.</p><br>
            <textarea readonly style="width: 633px; height: 565px; resize: none;">
# Загрузка библиотек
from pandas import read_csv
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from sklearn.metrics import confusion_matrix
from sklearn.metrics import accuracy_score

# Загрузка датасета
url = "https://raw.githubusercontent.com/jbrownlee/Datasets/master/iris.csv"
names = ['sepal-length', 'sepal-width', 'petal-length', 'petal-width', 'class']
dataset = read_csv(url, names=names)

# Разделение датасета на обучающую и контрольную выборки
array = dataset.values

# Выбор первых 4-х столбцов
X = array[:,0:4]

# Выбор 5-го столбца
y = array[:,4]

# Разделение X и y на обучающую и контрольную выборки
X_train, X_validation, Y_train, Y_validation = train_test_split(X, y, test_size=0.20, random_state=1)

# Создаем прогноз на контрольной выборке
model = SVC(gamma='auto')
model.fit(X_train, Y_train)
predictions = model.predict(X_validation)

# Оцениваем прогноз
print(accuracy_score(Y_validation, predictions))
print(confusion_matrix(Y_validation, predictions))
print(classification_report(Y_validation, predictions))
        </textarea>
            <button type="submit"  class="btn alert-warning"><a href="lesson5.php"> Назад </a></button>
            <button type="submit"  class="btn alert-warning"><a href="MLearn.php"> Следующее </a></button>
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
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S` WHERE `state` = 6;");

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

