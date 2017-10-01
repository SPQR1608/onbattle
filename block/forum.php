<?php
$oneThemeRow = getOneForumTheme($_GET['id_theme']);
$oneTheme = $oneThemeRow->fetch_assoc();

$themeAuthor = htmlspecialchars(stripslashes($oneTheme['theme_author']));
$fTheme = htmlspecialchars(stripslashes($oneTheme['theme']));
$createDate = htmlspecialchars(stripslashes($oneTheme['create_date']));

$answerPhotoInForumRow = getUserPhotoInForum($themeAuthor);
$answerPhotoInForum = $answerPhotoInForumRow->fetch_assoc();
$userThemePhoto = $answerPhotoInForum['user_photo'];

$idTheme = htmlspecialchars(stripslashes($oneTheme['id_theme']));
?>
<div class="InTheme">
    <table class="tableInTheme">
        <tr>
            <td id="authorInTheme">Автор: <? echo '<img src="' . $userThemePhoto . '" class = "Avatar" width="30" height="30">'.$themeAuthor; ?></td>
        </tr>
        <tr>
            <td id="fInTheme"><? echo $fTheme; ?></td>
        </tr>
        <tr>
            <td id="dateInTheme"><? echo $createDate; ?></td>
        </tr>
    </table>
</div>
<h2 id="answerToForum">Ответы</h2>
<?
$forumAnswer = getAnswers($idTheme);
for ($j = 1; $j <= count($forumAnswer); $j++) {

    include "block/forumanswers.php";
}
?>
<div class="forumAnswerSubmitDiv">
    <form method="POST">
        <p><textarea name="answerToForumTheme" rows="5" cols="30" maxlength="500"></textarea></p>
        <p><input type="submit" name="forumAnswerSubmit" value="Ответить">
    </form>
</div>
<?

if (isset($_POST['forumAnswerSubmit']) && (!empty($_POST['answerToForumTheme']))) {
    $answerToForum = trim($_POST['answerToForumTheme']);
    if (!get_magic_quotes_gpc()) {
        $answerToForum = addslashes($answerToForum);
    }
    addForumAnswer($idTheme, $answerToForum);
    ?>
    <script>
        ReloadPage();
    </script>
    <?
}

if (isset($_POST['answerToForumAnswerSubmit']) && (!empty($_POST['forumAnswerToAnswer']))) {
    $answerToAnswerForum = trim($_POST['forumAnswerToAnswer']);
    if (!get_magic_quotes_gpc()) {
        $answerToAnswerForum = addslashes($answerToAnswerForum);
    }
    addAnswersToForumAnswer($idTheme, $answerToAnswerForum);
    ?>
    <script>
        ReloadPage();
    </script>
    <?
}
?>
