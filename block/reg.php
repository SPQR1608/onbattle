<?php
if (isset($_POST['regSubmit'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $day = trim($_POST['day']);
    $moth = trim($_POST['moth']);
    $year = trim($_POST['year']);
    $date_rojd = strtotime("$year-$moth-$day");
    $date_rojd = date("Y-m-d", $date_rojd);

    if (!$login || !$password || !$email || !$day || !$moth || !$year) {
        Alert("Не все строки были заполнены.");
        //header("Location: " . $_SERVER["HTTP_REFERER"]);
        echo '<script>ReloadPage()</script>';
        exit();
    }

    if (!get_magic_quotes_gpc()) {
        $login = addslashes($login);
        $password = addslashes($password);
        $email = addslashes($email);
        $day = addslashes($day);
        $moth = addslashes($moth);
        $year = addslashes($year);
    }
    $err = array();
    # проверям логин
    if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
        Alert("Логин может состоять только из букв английского алфавита и цифр");
        echo '<script>ReloadPage()</script>';
        exit();
    }

    if (strlen($login) < 3 or strlen($login) > 30) {
        Alert("Логин должен быть не меньше 3-х символов и не больше 30");
        echo '<script>ReloadPage()</script>';
        exit();
    }
    connectBD();

    # проверяем, не сущестует ли пользователя с таким именем
    $query = "SELECT * FROM users WHERE user_login='" . $login . "'";

    $result = $bd->query($query);
    $num_result = $result->num_rows;

    if ($num_result > 0) {
        Alert("Пользователь с таким логином уже существует в базе данных");
        echo '<script>ReloadPage()</script>';
        exit();
    }

    if (count($err) == 0) {
        # Убераем лишние пробелы и делаем двойное шифрование
        $password = md5(md5($password));

        $userPhotoRow = getOnePhotoURL();
        $userPhoto = $userPhotoRow->fetch_assoc();
        addUser($login, $password, $email, $date_rojd, $userPhoto['image']);
        TruncateTable();
        echo '<script>IndexPage()</script>';
        Alert('Регистрация прошла успешною. Теперь вы можете авторизоваться');
        exit();
    } else {
        echo "При регистрации произошли следующие ошибки:";
        foreach ($err AS $error) {
            //echo $error . "<br>";
        }
    }
}
?>
<div class="regBody">
    <div id="messegeResult"><h1>Регистрация</h1></div>
    <form method="POST" id="formReg">
        <table align="center">
            <tr>
                <td>Логин</td>
                <td><p><input name="login" type="text"></p></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><p><input name="password" type="password"></p></td>
            </tr>
            <tr>
                <td>Е-mail</td>
                <td><p><input name="email" type="text"></p></td>
            </tr>
        </table>
        <table align="center">
            <tr>
                <td>
                    <p>День</p>
                    <p><input name="day" type="text" size="3" maxlength="2"></p>
                </td>
                <td>
                    <p>Месяц</p>
                    <p><input name="moth" type="text" size="3" maxlength="2"></p>
                </td>
                <td>
                    <p>Год</p>
                    <p><input name="year" type="text" size="5" maxlength="4"></p>
                </td>
            </tr>
        </table>
        <p>Перед нажатие кнопки "Зарегестрироваться" загрузите фото.</p>
        <p><input type="submit" name="regSubmit" value="Зарегестрироваться"></p>
    </form>
    <p></p>
    <div id="messegeResult">Загрузка фото</div>
    <form enctype="multipart/form-data" method="post" target="myIFR">
        <p>Изображение: <input type="file" name="userPhoto"><br></p>
        <input type="submit" id="photoButton" name = "photoSubmit" value="Загрузить">
    </form>
</div>
<?
if (isset($_POST['photoSubmit'])) {
    if (isset($_FILES['userPhoto']['name'])) {

        if ($_FILES['userPhoto']['error'] == 0) {

            if (substr($_FILES['userPhoto']['type'], 0, 5) == 'image') {

                $uploadDir = './img/userPhoto/';
                $uploadFile = $uploadDir . basename($_FILES['userPhoto']['name']);

// Копируем файл из каталога для временного хранения файлов:
                if (copy($_FILES['userPhoto']['tmp_name'], $uploadFile)) {
                    bufferPhoto($uploadFile);
                }

            }
        }
    }
}
?>
