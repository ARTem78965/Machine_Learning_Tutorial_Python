<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <title>Регистрация</title>
</head>
<body class="body">
<?php
$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

if (isset($_POST['login']) && isset($_POST['login'])) {
    $fio = $_POST['fio'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = md5($password);

    $select = "SELECT * FROM `users` WHERE `login` = '$login' AND `email` = '$email'";
    $check = mysqli_num_rows(mysqli_query($conn, $select));


    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email) && $check < 0) {
        $query = "INSERT INTO users (fio, email, login, password) VALUES('$fio', '$email', '$login', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: singin.php");
        } else {
            $fmsg = "Ошибка";
        }
    }else{
        $fmsg = "Пользователь уже существует или заполненные поля не проходят валидацию?";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form class="form-horizontal" method="post">
                <span class="heading">Регистрация</span>
                <!--ФИО-->
                <div class="form-group">
                    <input type="text" name="fio" class="form-control" placeholder="ФИО" required/>
                </div>
                <!--Почта-->
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Почта" required/>
                </div>
                <!--Логин-->
                <div class="form-group help">
                    <input type="text" name="login" class="form-control" placeholder="Логин" required/>
                </div>
                <!--Пароль-->
                <div class="form-group help">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Пароль"
                    required/>
                </div>
                <!--Кнопка-->
                <div class="form-group">
                    <button type="submit" class="btn btn-default">ЗАРЕГИСТРИРОВАТЬСЯ</button>
                </div>
                <?php if (isset($fmsg)) { ?>
                    <div class="alert alert-danger"><?php echo $fmsg; ?></div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
</body>
</html>