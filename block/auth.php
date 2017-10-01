<?php
session_start();
if ($_POST['authSubmit']) {
    $login = trim($_POST['auth_login']);
    $pass = trim($_POST['auth_pass']);

    if (!get_magic_quotes_gpc()) {
        $login = addslashes($login);
        $pass = addslashes($pass);
    }

    if (!$login || !$pass) {
        Alert("Введите логин/пароль");
        echo '<script>ReloadPage()</script>';
        exit();
    }

    $bd = new mysqli('localhost', 'user', '', 'onbattle');
    $pass = md5(md5($pass));

    $query = "SELECT * FROM users WHERE user_login='" . $login . "'"; #AND user_password='".$pass."'";
    $result = $bd->query($query) or trigger_error(mysql_error() . $query);

    if ($row = $result->fetch_assoc()) {
        $_SESSION['user_login'] = stripslashes($row['user_login']);
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    } else {
        Alert('Такой логин с паролем не найдены в базе данных.');
        echo '<script>ReloadPage()</script>';
        exit();
    }
}

if (isset($_SESSION['user_login']) AND $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}
$bd->close();
?>