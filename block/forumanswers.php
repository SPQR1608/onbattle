<?
$authorForumAnswer = htmlspecialchars(stripslashes($forumAnswer[$j - 1]['answer_author']));
$answerPhotoInForumRow = getUserPhotoInForum($authorForumAnswer);
$answerPhotoInForum = $answerPhotoInForumRow->fetch_assoc();
$userPhoto = $answerPhotoInForum['user_photo'];

$fWhomForumAnswer = htmlspecialchars(stripslashes($forumAnswer[$j - 1]['f_whom']));
$forWhomPhotoInForumRow = getFWhomPhotoInForum($fWhomForumAnswer);
$forWhomPhotoInForum = $forWhomPhotoInForumRow->fetch_assoc();
$forWhomPhoto = $forWhomPhotoInForum['user_photo'];
?>
<div class="forumAnswers" id="<? echo strval($j) ?>">
    <table>
        <tr>
            <td width="200px">
                <?
                echo '<span class = "answerAuthor"><img src="' . $userPhoto . '" class = "Avatar" width="30" height="30">' . $authorForumAnswer . '</span>';
                ?>
            </td>
            <td><?
                if ($forumAnswer[$j - 1]['f_whom']) {
                    echo '<img src="../img/fWhom.png">';
                    echo '<span class = "answerForWhom"><img src="' . $forWhomPhoto . '" class = "Avatar" width="30" height="30">' . $fWhomForumAnswer . '</span>';
                    echo '<br><br>';
                }
                echo htmlspecialchars(stripslashes($forumAnswer[$j - 1]['answer']));
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <? echo htmlspecialchars(stripslashes($forumAnswer[$j - 1]['answer_date'])); ?>
            </td>
        </tr>
        <tr>
            <td>
                <div class="answerToForumButton" id="<? echo strval($j) ?>">
                    <iframe name="answerTarget" .<? echo strval($j) ?> style="display: none"></iframe>
                    <button class="answerToForumButtonInDiv" id="<? echo strval($j) ?>"
                            name="<? echo $authorForumAnswer; ?>" onclick="ForumLink(this)">Ответить
                    </button>
                </div>
            </td>
        </tr>
    </table>
</div>

