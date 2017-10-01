<div class="newsItem" id="<? echo strval($i) ?>">
    <table>
        <tr>
            <td width="200px"><?
                $author_news_answer = htmlspecialchars(stripslashes($answersRow[$i - 1]['answer_author']));
                $author_news_Id = htmlspecialchars(stripslashes($answersRow[$i - 1]['answ_id_in_topic']));
                $answerForWhom = htmlspecialchars(stripslashes($answersRow[$i - 1]['f_whom']));

                $authorPhotoInNewsRow = getUserPhotoInNews($author_news_answer);
                $authorPhotoInNews = $authorPhotoInNewsRow->fetch_assoc();
                $authorPhoto = $authorPhotoInNews['user_photo'];

                $fWhomPhotoInNewsRow = getFWhomPhotoInNews($answerForWhom);
                $fWhomPhotoInNews = $fWhomPhotoInNewsRow->fetch_assoc();
                $fWhomPhoto = $fWhomPhotoInNews['user_photo'];

                    echo '<span class = "answerAuthor"><img src="' . $authorPhoto . '" class = "Avatar" width="30" height="30">' . $author_news_answer . '</span>';
                ?>
            </td>
            <td rowspan="3"><?
                if ($answersRow[$i - 1]['f_whom']) {
                    echo '<img src="../img/fWhom.png">';
                    echo '<span class = "answerForWhom"><img src="' . $fWhomPhoto . '" class = "Avatar" width="30" height="30">' . $answerForWhom . '</span>';
                    echo '<br><br>';
                }
                echo htmlspecialchars(stripslashes($answersRow[$i - 1]['answer']));
                ?>
            </td>
        </tr>
        <tr>
            <td width="200px"><?
                echo htmlspecialchars(stripslashes($answersRow[$i - 1]['answer_date']));
                ?>
            </td>
        </tr>
        <tr>
            <td id="answerButtonTd">
                <?
                include "answertoanswers_button.php";
                ?>
            </td>
        </tr>
    </table>
</div>