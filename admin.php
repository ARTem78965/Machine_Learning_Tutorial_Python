<?php
    session_start();
    if(!$_SESSION['login']){
        header('Location: adminIn.php');
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
    <title>Панель администратора</title>
</head>
<body>
<div class="header">
    <div class="header__section">
        <div><a href="index.php"><img class="logo" src="img/logo.png" alt="Машинное обучение"/></a></div>
        <div class="header__item headerButton"><a class="panel" href="admin.php">Главная</a></div>
        <div class="header__item headerButton"><a class="panel" href="console.php">Консоль SQL</a></div>
    </div>
    <div class="header__section">
        <?php
        session_start();
        require_once 'admin_auth.php';

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
        <?php } ?>
    </div>
</div>
<main>
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
                        <?php if (isset($fmsg)) { ?>
                            <div class="alert alert-danger"><?php echo $fmsg; ?> </div>
                        <?php } ?>
                </main>
                <?php
                $sql2 = mysqli_query($conn, "SELECT `login`, `comment` FROM `comments_S`");

                while ($row = $sql2->fetch_assoc()) {
                    echo '<div style=" margin: 25px; padding: 50px; background: grey; border-radius: 10px; width: 550px; height: 5px; margin-left: 10px;"><h2> ' . $row['login'] . '</h2>';
                    echo '<h4>' . $row['comment'] . '</h4></div>';
                }
                ?>
            </form>
        </div>
    </div>
</div>
</main>
</body>
</html>