<?
$userAccount = getUser();
$oneAccount = $userAccount->fetch_assoc();
?>
    <table>
        <tr>
            <td>
                <p>Аватарка</p>
                <img src="<? echo $oneAccount['user_photo']; ?>" class = "Avatar" width="50" height="50"><br>
                <button id="photoButtonCorrect" onclick="photoCorrect()">Править</button>
            </td>
            <td>
                <p>Nick Name</p>
                <? echo htmlspecialchars(stripslashes($oneAccount['user_login'])); ?>
                <button id="nickButtonCorrect" onclick="nickCorrect()">Править</button>
            </td>
            <td>
                <p>Дата регистрации</p>
                <?echo htmlspecialchars(stripslashes($oneAccount['reg_date']));?>
            </td>
        </tr>
        <tr>
            <td>
                <p>E-mail</p>
                <? echo htmlspecialchars(stripslashes($oneAccount['email'])); ?>
                <button id="emailButtonCorrect" onclick="emailCorrect()">Править</button>
            </td>
        </tr>
        <tr>
            <td>
                <p>Дата рождения</p>
                <? echo htmlspecialchars(stripslashes($oneAccount['date_rojd'])); ?>
                <button id="dateButtonCorrect" onclick="dateCorrect()">Править</button>
            </td>
        </tr>
    </table>

<?
if (isset($_POST['nickButtonChange']) && (!empty($_POST['nickChange']))) {
    $userNick = trim($_POST['nickChange']);
    if (!get_magic_quotes_gpc()) {
        $userNick = addslashes($userNick);
    }
    changeUserNick($userNick);
}

if (isset($_POST['emailButtonChange']) && (!empty($_POST['emailChange']))) {
    $userEmail = trim($_POST['emailChange']);
    if (!get_magic_quotes_gpc()) {
        $userEmail = addslashes($userEmail);
    }
    changeUserEmail($userEmail);
}

if (isset($_POST['dateButtonChange'])) {
    if ((!empty($_POST['changeDay'])) && (!empty($_POST['changeMoth'])) && (!empty($_POST['changeYear']))) {
        $dayChange = trim($_POST['day']);
        $mothChange = trim($_POST['moth']);
        $yearChange = trim($_POST['year']);
        $date_rojd = strtotime("$year-$moth-$day");
        $date_rojdChange = date("Y-m-d", $date_rojd);

        changeUserEmail($date_rojdChange);
    } else {
        echo "<script>alert('Ошибка ввода! Заполните все поля.')</script>";
    }

}

//Change photo
if (isset($_POST['photoButtonChange'])) {
    if (isset($_FILES['photoChange']['name'])) {

        if ($_FILES['photoChange']['error'] == 0) {

            if (substr($_FILES['photoChange']['type'], 0, 5) == 'image') {

                $uploadDir = './img/userPhoto/';
                $uploadFile = $uploadDir . basename($_FILES['photoChange']['name']);

// Копируем файл из каталога для временного хранения файлов:
                if (copy($_FILES['photoChange']['tmp_name'], $uploadFile)) {
                    changeUserPhoto($uploadFile);
                }

            }
        }
    }
}
?>