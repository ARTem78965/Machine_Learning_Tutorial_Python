<?php
$conn = new mysqli('localhost', 'artem', 'A331166a', 'site');

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = md5($password);

    $query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login'] = $login;
        header("Location: index.php");
    } else {
        $fmsg = "Не верный логин или пароль!";
    }
}
?>