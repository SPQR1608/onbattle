<?php
if (isset($_POST['themeSubmit']) && (!empty($_POST['forum_theme']))) {
    $theme = trim($_POST['forum_theme']);
    if (!get_magic_quotes_gpc()) {
        $theme = addslashes($theme);
    }
    addTheme($theme);
}
?>
<button id="AddThemeButton" onclick="AddForumThemeButton()">Добавить тему</button>