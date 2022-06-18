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
    <title>Авторизация</title>
</head>
<body class="body">
<?php
session_start();
require_once 'auth.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form class="form-horizontal" method="post">
                <span class="heading">Вход</span>
                <!--Логин-->
                <div class="form-group help">
                    <input type="text" name="login" class="form-control" placeholder="Логин"/>
                </div>
                <!--Пароль-->
                <div class="form-group help">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Пароль"/>
                </div>
                <!--Кнопка-->
                <div class="form-group">
                    <button type="submit" class="btn btn-default">ВХОД</button>
                </div>
                <div class="form-group">
                    <a href="registr.php"> У вас нет аккаунта! </a>
                </div>
                <div class="form-group">
                    <a href="adminIn.php"> Вход под Админ. </a>
                </div>
                <?php if (isset($fmsg)) { ?>
                    <div class="alert alert-danger"><?php echo $fmsg; ?></div><?php } ?>
            </form>
        </div>
    </div>
</div>
</body>
</html>