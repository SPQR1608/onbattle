<div class="header">
    <div id="header">
        <ul class="nav">
            <table>
                <tr>
                    <td>
                        <li class="main-menu">
                            <a href="index.php"><img src="img/home.png" alt="Main" align="left">Начальная</a>
                            <a href="game_photos.php">Скриншоты/Арт</a>
                            <a href="game_video.php">Видео</a>
                        </li>
                    </td>
                    <td>
                        <li class="settings">
                            <a href="account_settings.php"><img src="img/settings.png" alt="Setting" align="left">Аккаунт</a>
                            <a href="download.php">Загрузка</a>
                            <a href="addnews.php">Добавление новости</a>
                        </li>
                    </td>
                    <td>
                        <li class="link">
                            <a href="forum.php"><img src="img/link.png" alt="Link" align="left">Форум</a>
                        </li>
                    </td>
                </tr>
            </table>
        </ul>
    </div>
</div>
<div id="header" class="default">
    <ul class="nav">
        <li class="main-menu">
            <a href="index.php"><img src="img/home.png" alt="Main" align="left">Начальняя</a>
            <a href="game_photos.php">Скриншоты/Арт</a>
            <a href="game_video.php">Видео</a>
        </li>
        <li class="settings">
            <a href="account_settings.php"><img src="img/settings.png" alt="Setting" align="left">Аккаунт</a>
            <a href="download.php">Загрузка</a>
            <a href="addnews.php">Добавление новости</a>
        </li>
        <li class="link">
            <a href="forum.php"><img src="img/link.png" alt="Link" align="left">Форум</a>
        </li>
    </ul>
</div>
<div class="Logotip">

</div>
<div class="userPanel">
    <? if (checkUser($_SESSION['user_login']))
        require_once "user_panel.php";
    else require_once "auth_form.php";
    ?>
</div>