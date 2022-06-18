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
    <title>Консоль SQL</title>
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
            <?php
                $conn = new mysqli("localhost", "artem", "A331166a", "site");
                if($conn->connect_error){
                    die("Ошибка: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM users";
                if($result = $conn->query($sql)){
                echo 'Таблица Пользователи';
                echo "<table><tr><th>Номер</th><th>ФИО</th><th>Почта</th><th>Логин</th><th>Пароль</th></tr>";
                foreach($result as $row){
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["fio"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["login"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $result->free();
                } else{
                    echo "Ошибка: " . $conn->error;
                }
                $conn->close();
            ?>
        </div>
    </div>
    <div class="features">
        <div class="block">
        <?php
                $conn = new mysqli("localhost", "artem", "A331166a", "site");
                if($conn->connect_error){
                    die("Ошибка: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM state";
                if($result = $conn->query($sql)){
                    echo 'Таблица Статьи';
                    echo "<table><tr><th>Номер</th><th>Статья</th></tr>";
                    foreach($result as $row){
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    $result->free();
                    } else{
                        echo "Ошибка: " . $conn->error;
                    }
                    $conn->close();
            ?>
        </div>
    </div>
    <div class="features">
        <div class="block">
            <form method="post">
                <?php
                    $conn = new mysqli("localhost", "artem", "A331166a", "site");
                    if($conn->connect_error){
                        die("Ошибка: " . $conn->connect_error);
                    }
                    if (isset($_POST['sqlConsole'])) {
                        $sqlConsole = $_POST['sqlConsole'];
                        $sql = $sqlConsole;
                        if($result = mysqli_query($conn, $sql)){
                            header("Location: console.php");
                        } else{
                            echo "Ошибка: " . $conn->error;
                        }
                        $conn->close();
                    }
                ?>
                <textarea name="sqlConsole" style="resize: none; height: 200px; width: 630px;" placeholder="Запрос..."></textarea>
                <input type="submit" value="Выполнить запрос"/>
            </form>
        </div>
    </div>
</main>
</body>
</html>