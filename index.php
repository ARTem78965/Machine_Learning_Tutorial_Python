<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/block.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <title>Главная</title>
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
            $login = $_SESSION['login'];
            ?>
            <div class="header__item headerButton">
                <a class="panel">
                    <?php echo $login;?>
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
            <p class="text"> О курсе </p><br>
            <p class="text-designer">

                Data Scientist is The Sexiest Job of the 21st Century, а машинное обучение и анализ данных - это
                захватывающие
                области,знакомство с которыми точно не оставит вас равнодушными! Мы начнем с самого начала, разберем
                центральные понятия
                и темы. Познакомимся с такими методами машинного обучения как деревья решений и нейронные сети.
                Практическая
                часть курса будет посвящена знакомству с наиболее популярными библиотеками для анализа данных, используя
                язык
                программирования Python - Pandas и Scikit-learn.<br><br>

                Умение программировать - необходимый навык для анализа данных и машинного обучения. В этом курсе мы
                будем
                решать
                практические задания на Python. Однако, если вы не программировали раньше, вы можете начать этот курс и
                параллельно изучать основы программирования, применяя полученные теоретически знания для решения
                конкретных
                задач из области
                анализа данных. Втрой курс по Python скорее показывает, на каком уровне нужно знать программирование,
                чтобы
                уверенно
                начать развиваться в области Data Science, где вас ждет не только машинное обучение, но и работа c
                кодом,
                базами
                данных, большими данными, Linux, удаленными серверами, Git, в общем, нужно уметь все и немного
                больше.<br><br>

                Помимо лекций и практических занятий нас ждет много всего увлекательного на курсе, мы поспорим про
                будущее
                искусственного интеллекта, поговорим про то, что нужно для успешной карьеры в области Data Science, а
                также
                пообщаемся с
                ведущими специалистами в области анализа данных и машинного обучения. Будет интересно!<br><br>

                Курс подготовлен на базе программы Института биоинформатики.<br><br>

                Для кого этот курс<br><br>
                Все заинтересованные в Data Science<br><br>

                Курс вводный и рассчитан на слушателей, не обладающих специализированными знаниями в области машинного
                обучения.
                Для успешного прохождения потребуются базовые знания в области статистики и программирования на Python
                для
                решения практических задач.<br><br>

                Однако, если раньше вы никогда не программировали, но интересуетесь анализом данных, вы можете смело
                начинать
                этот курс, и подтягивать Python в процессе.<br><br>
            </p>
        </div>
    </div>
</main>
</body>
</html>