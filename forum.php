<? require_once "block/start.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>On Battle:Форум</title>
    <? require_once "block/links.php"; ?>
</head>

<body>
<? require_once "block/top.php" ?>
<div class="forumContent">
    <?
    if (isset($_SESSION['user_login'])) {
    if (isset($_GET['id_theme'])) {
        require_once "block/forum.php";
    }else {
        ?>
        <br>
        <table class="forumTable">
            <tr>
                <td colspan="3"><h2>Форум</h2></td>
                <td>
                    <? require_once "block/add_theme.php"; ?>
                </td>
            </tr>
            <tr>
                <th>Тема</th>
                <th>Ответы</th>
                <th>Автор</th>
                <th>Последнее сообщение</th>
            </tr>
            <?
            $theme = getAllTheme();
            for ($i = count($theme); $i>0; $i--) {
                //извлекаем найденную строку из массива
                //$row = $theme->fetch_assoc();
                $row_theme = $theme[$i-1]['id_theme'];
                $countAnswerRow = getCountAnswer($row_theme);
                $countAnswer = count($countAnswerRow);
                $lastAnswerRow = getLastAnswer($row_theme);
                $lastAnswer = $lastAnswerRow->fetch_assoc();
                $theme_author = htmlspecialchars(stripslashes($theme[$i-1]['theme_author']));
                echo "<tr>";
                echo "<td id='themeTdforumTable'><a href='forum.php?id_theme=" . $row_theme . "'>" . htmlspecialchars(stripslashes($theme[$i-1]['theme'])) . "</a></td>";
                echo "<td>".$countAnswer."</td>";
                echo "<td id='authorTdforumTable'>";
                echo $theme_author . "</td>";
                echo "<td>".$lastAnswer['answer_author']."</td>";
                echo "</p>";
            }
            ?>
        </table>
    <?
    }
    } else {
    ?>
        <script>
            document.location.href = 'reg.php';
            alert('Для доступа к форуму авторизуйтесь или зарегестрируйтесь!')
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
