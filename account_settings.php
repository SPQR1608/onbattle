<? require_once "block/start.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>On Battle:Пользователь</title>
    <? require_once "block/links.php"; ?>
</head>

<body>
<?php require_once "block/top.php" ?>
<div class="accountSet">
    <? if (isset($_SESSION['user_login'])) {
        echo '<p>Профиль пользователя:</p>';
        require_once "block/account.php";
    }
    else{
        ?>
        <script>
            document.location.href = 'reg.php';
            alert('Для входа в настройки аккаунта авторизуйтесь или зарегестрируйтесь!')
        </script>
        <?
    }
 ?>
</div>

<div class="footer">
    <?require_once "block/footer.php"?>
</div>
</body>

</html>