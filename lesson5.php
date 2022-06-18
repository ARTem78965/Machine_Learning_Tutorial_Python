<?php
session_start();
require_once 'auth.php';

$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

$sql = mysqli_query($conn, "SELECT `id`, `title` FROM `state` WHERE `id`='5'");

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
                Вот что мы собираемся охватить в этом шаге:
            </p><br>
            <ul>
                <li>Отделим обучающая выборка от контрольной (тестовой) выборке.</li>
                <li>Настройка 10-кратной кросс-валидации</li>
                <li>Построим несколько различных моделей для прогнозирования класса цветка из измерений цветов</li>
                <li>Выберем лучшую модель.</li>
            </ul>
            <br>
            <h3> 5.1 Создание контрольной выборки </h3><br>
            <p>
                Мы должны знать, что модель, которую мы создали, хороша.
            </p><br>
            <p>
                Позже мы будем использовать статистические методы для оценки точности моделей. Мы также хотим получить
                более
                конкретную оценку точности наилучшей модели на контрольных данных, оценив ее по фактических контрольным
                данным.
            </p><br>
            <p>
                То есть, мы собираемся удержать некоторые данные, на которых алгоритмы не будут обучаться, и мы будем
                использовать эти данные,
                чтобы получить второе и независимое представление о том, насколько точной может быть лучшая модель на
                самом деле.
            </p><br>
            <p>
                Разделим загруженный датасет на два:
            </p><br>
            <ul>
                <li>80% данных мы будем использовать для обучения, оценки и выбора лучшей среди наших моделей</li>
                <li>20% данных, что мы будем использовать в качестве контрольного теста качества полученных моделей</li>
            </ul>
            <textarea readonly style="width: 633px; height: 195px; resize: none;">
# Разделение датасета на обучающую и контрольную выборки
array = dataset.values

# Выбор первых 4-х столбцов
X = array[:,0:4]

# Выбор 5-го столбца
y = array[:,4]

# Разделение X и y на обучающую и контрольную выборки
X_train, X_validation, Y_train, Y_validation = train_test_split(X, y, test_size=0.20, random_state=1)
        </textarea><br><br>
            <p>
                Теперь у вас есть обучающиеся данные в X_train и Y_train для подготовки моделей и контрольная выборка
                X_validation и Y_validation, которые мы можем использовать позже.
            </p><br>
            <p>
                Обратите внимание, что мы использовали срез в Python для выбора столбцов в массиве NumPy.
            </p><br>
            <h3>5.2 Тестирование проверки</h3><br>
            <p>
                Для оценки точности модели мы будем использовать стратифицированную 10-кратную кросс-валидацию.
            </p><br>
            <p>
                Это разделит наш датасет на 10 частей, обучающийся на 9 частях и 1 тестовой проверке и будет повторять
                обучение
                на всех комбинаций из выборок train-test.
            </p>
            <p>
                Стратифицированная означает, что каждый прогон по выборке данных будет стремиться иметь такое же
                распределение
                примера по классу, как это существует во всем наборе обучаемых данных.
            </p><br>
            <p>
                Для получения дополнительной информации о том как работает метод k-fold кросс-валидации можно посмотреть
                по
                <a href="https://ghost.codecamp.ru/cross-validation-k-fold/">ссылке.</a>
            </p><br>
            <p>
                Мы устанавливаем случайное затравку через random_state аргумент на фиксированное число, чтобы
                гарантировать, что каждый
                алгоритм оценивается на тех же выборках обучающихся данных. Конкретные случайные затравки не имеет
                значения.
            </p><br>
            <p>
                Мы используем метрику «acccuracy» для оценки моделей.
            </p><br>
            <p>
                Это соотношение числа правильно предсказанных экземпляров, разделенных на общее количество экземпляров в
                наборе данных,
                умноженном на 100, чтобы дать процент (например, точность 95%). Мы будем использовать оценочную
                переменную, когда мы будем
                запускать сборку и оценивать каждую модель.
            </p><br>
            <h3>5.3 Строим модели машинного обучения</h3><br>
            <p>
                Мы не знаем, какие алгоритмы будет хороши для этой задачи или какие конфигурации их использовать.
            </p><br>
            <p>
                Все что увидела выше, что некоторые классы частично линейно зависят в некоторых измерениях, поэтому в
                целом ожидаем хорошие результаты.
            </p><br>
            <p>
                Давайте протестируем 6 различных алгоритмов:
            </p><br>
            <ul>
                <li>Логистическая регрессия или логит-модель (LR)</li>
                <li>Линейный дискриминантный анализ (LDA)</li>
                <li>Метод k-ближайших соседей (KNN)</li>
                <li>Классификация и регрессия с помощью деревьев (CART)</li>
                <li>Наивный байесовский классификатор (NB)</li>
                <li>Метод опорных векторов (SVM)</li>
            </ul>
            <br>
            <p>
                Здесь приведена смесь простых линейных (LR и LDA), нелинейных (KNN, CART, NB и SVM) алгоритмов.
            </p><br>
            <p>
                Давайте построим и оценим наши модели:
            </p>
            <textarea readonly style="width: 633px; height: 335px; resize: none;">
# Загружаем алгоритмы модели
models = []
models.append(('LR', LogisticRegression(solver='liblinear', multi_class='ovr')))
models.append(('LDA', LinearDiscriminantAnalysis()))
models.append(('KNN', KNeighborsClassifier()))
models.append(('CART', DecisionTreeClassifier()))
models.append(('NB', GaussianNB()))
models.append(('SVM', SVC(gamma='auto')))

# оцениваем модель на каждой итерации
results = []
names = []

for name, model in models:
	kfold = StratifiedKFold(n_splits=10, random_state=1, shuffle=True)
	cv_results = cross_val_score(model, X_train, Y_train, cv=kfold, scoring='accuracy')
	results.append(cv_results)
	names.append(name)
	print('%s: %f (%f)' % (name, cv_results.mean(), cv_results.std()))
        </textarea><br><br>
            <h3>5.4 Выбираем модель</h3><br>
            <p>
                Теперь у нас есть 6 моделей и оценки точности каждой из них. Мы должны сравнить модели друг с другом и
                выбрать наиболее точные.
            </p><br>
            <p>
                Запустив приведенный выше пример, мы получим следующие необработанные результаты:
            </p>
            <textarea readonly style="width: 633px; height: 115px; resize: none;">
LR: 0.955909 (0.044337)
LDA: 0.975641 (0.037246)
KNN: 0.950524 (0.040563)
CART: 0.951166 (0.052812)
NB: 0.951166 (0.052812)
SVM: 0.983333 (0.033333)
        </textarea><br><br>
            <p>
                Обратите внимание, что ваши результаты могут немного варьироваться, учитывая стохастический характер
                алгоритмов обучения.
            </p><br>
            <p><b>Как интерпретировать полученные значения качества моделей?</b></p><br>
            <p>В этом случае, мы видим, что это выглядит как метод опорных векторов (SVM) имеет самый большой расчет
                точности около 0,98 или 98%.</p>
            <br>
            <p>
                Мы также можем создать график результатов оценки модели и сравнить расхождение средней точность каждой
                модели. Существует разбор
                показателей точности для каждого алгоритма, потому что каждый алгоритм был оценен 10 раз (в рамках
                10-кратной кросс-валидации).
            </p><br>
            <p>
                Хороший способ сравнить результаты для каждого алгоритма заключается в создании диаграмме размаха
                атрибутов выходных данных и их
                усов для каждого распределения и сравнения распределений.
            </p><br>
            <textarea readonly style="width: 633px; height: 85px; resize: none;">
# Сравниванием алгоритмы
pyplot.boxplot(results, labels=names)
pyplot.title('Algorithm Comparison')
pyplot.show()
        </textarea><br><br>
            <p>
                Мы видим, что ящики и усы участков в верхней части диапазона достигают 100% точности, а некоторые
                находятся в районе 85% точности.
            </p><br>
            <img src="img/learn/4.png"/><br>
            <h3>5.5 Резюме оценки алгоритмов</h3><br>
            <p>
                Для справки мы можем связать все предыдущие элементы вместе в один скрипт. Полный пример приведен ниже.
            </p>
            <textarea readonly style="width: 633px; height: 985px; resize: none;">
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

# Загружаем алгоритмы моделей
models = []
models.append(('LR', LogisticRegression(solver='liblinear', multi_class='ovr')))
models.append(('LDA', LinearDiscriminantAnalysis()))
models.append(('KNN', KNeighborsClassifier()))
models.append(('CART', DecisionTreeClassifier()))
models.append(('NB', GaussianNB()))
models.append(('SVM', SVC(gamma='auto')))

# оцениваем модель на каждой итерации
results = []
names = []

for name, model in models:
	kfold = StratifiedKFold(n_splits=10, random_state=1, shuffle=True)
	cv_results = cross_val_score(model, X_train, Y_train, cv=kfold, scoring='accuracy')
	results.append(cv_results)
	names.append(name)
	print('%s: %f (%f)' % (name, cv_results.mean(), cv_results.std()))

# Сравниванием алгоритмы
pyplot.boxplot(results, labels=names)
pyplot.title('Algorithm Comparison')
pyplot.show()
        </textarea>
            <button type="submit"  class="btn alert-warning"><a href="lesson4.php"> Назад </a></button>
            <button type="submit"  class="btn alert-warning"><a href="lesson6.php"> Следующее </a></button>
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
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S` WHERE `state` = 5;");

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
