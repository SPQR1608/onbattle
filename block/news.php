<?php
if (isset($_GET['id'])) {
    $oneItem = getOneNews($_GET['id']);
    $rowItem = $oneItem->fetch_assoc();
    ?>
    <div class='oneOfNews'>
        <table>
            <tr>
                <td id="oneNewsTopic">
                    <? echo htmlspecialchars(stripslashes($rowItem['topic'])); ?>
                </td>
            </tr>
            <tr>
                <td id="oneNewsPost">
                    <? echo htmlspecialchars(stripslashes($rowItem['onePost'])); ?>
                </td>
            </tr>
            <tr>
                <td id="oneNewsDate">
                    <? echo htmlspecialchars(stripslashes($rowItem['datePost'])); ?>
                </td>
            </tr>
        </table>
    </div>
    <hr size="1px" color="black">
    <h2 id="answerToNews">Ответы</h2>
    <hr size="1px" color="black">
    <?
    //вывод по странично
    $on_page = 50;
    $recordsRow = getCountAnswersNumInTopic($rowItem['topic']);
    $records = $recordsRow->fetch_assoc();
    $count_records = (int)$records;
    $num_pages = ceil($count_records / $on_page);
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    } elseif ($current_page > $num_pages) {
        $current_page = $num_pages;
    }
    $start_from = ($current_page - 1) * $on_page;

    $answersRow = getAnswersToNews(htmlspecialchars(stripslashes($rowItem['topic'])), $start_from, $on_page);

    for ($i = 1; $i <= count($answersRow); $i++) {
        include "answer_news.php";
    }
    if (isset($_POST['answerToNewsSubmit']) && (!empty($_POST['answerToNews']))) {
        $answerToNews = trim($_POST['answerToNews']);
        $nTopic = $rowItem['topic'];
        if (!get_magic_quotes_gpc()) {
            $answerToNews = addslashes($answerToNews);
        }
        $answersCount = getCountAnswersNumInTopic($nTopic);
        $countInAnsw = $answersCount->fetch_assoc();
        $idAnswerInTopic = 0;
        if ((int)$countInAnsw['COUNT(answ_id_in_topic)'] == 0) {
            $idAnswerInTopic = 1;
        } else {
            $lastAnswersNumInTopic = getLastAnswersNumInTopic($nTopic);
            $lastAnswersNumInTopicRow = $lastAnswersNumInTopic->fetch_assoc();
            $idAnswerInTopic = ((int)$lastAnswersNumInTopicRow['answ_id_in_topic']) + 1;
        }
        addAnswerToNews($rowItem['topic'], $answerToNews, $idAnswerInTopic);
        ?>
        <script>
            ReloadPage();
        </script>
        <?
    }

    include "block/ajax_send.php";
    if (isset($_POST['answerToNewsAnswerSubmit']) && (!empty($_POST['answerToAnswer']))) {
        $answerToAnswer = trim($_POST['answerToAnswer']);
        if (!get_magic_quotes_gpc()) {
            $answerToAnswer = addslashes($answerToAnswer);
        }
        $idAnswerInTopic = 0;
        if ((int)$countInAnsw['COUNT(answ_id_in_topic)'] == 0) {
            $idAnswerInTopic = 1;
        } else {
            $lastAnswersNumInTopic = getLastAnswersNumInTopic($nTopic);
            $lastAnswersNumInTopicRow = $lastAnswersNumInTopic->fetch_assoc();
            $idAnswerInTopic = ((int)$lastAnswersNumInTopicRow['answ_id_in_topic']) + 1;
        }
        addAnswerToNewsAnswers($rowItem['topic'], $answerToAnswer, $idAnswerInTopic);
        ?>
        <script>
            ReloadPage();
        </script>
        <?
    }
    ?>
    <div class="answerToNews">
        <iframe name="newsTarget" style="display: none"></iframe>
        <form method="POST">
            <p><textarea name="answerToNews" rows="5" cols="30" maxlength="500"></textarea></p>
            <p><input type="image" name="answerToNewsSubmit" value="Ответить"></p>
        </form>
    </div>
    <?
} else {
    //вывод по странично
    $on_page = 2;
    $records = getCountNews();
    $count_records = count($records);
    $num_pages = ceil($count_records / $on_page);
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    } elseif ($current_page > $num_pages) {
        $current_page = $num_pages;
    }
    $start_from = ($current_page - 1) * $on_page;

    $news = getAllNews($start_from, $on_page);
    for ($i = 1; $i<=count($news); $i++) {
        $countAnswersInNewsRow = getCountAnswInTopicForPreview($news[$i - 1]['topic']);
        $countAnswersInNews = count($countAnswersInNewsRow);
        //$countAnswersInNews['answer']=1;
        ?>
        <div class='allOfNews'>
            <div class="wrapper">
                <img src="<?echo $news[$i - 1]['preview_photo'];?>" class = "imgPreviev">
            </div>
            <div class="newsPreview">
                <table align="left" id="newsPreviewTable" width="370">
                    <tr>
                        <td id="topic" colspan="2">
                            <? echo htmlspecialchars(stripslashes($news[$i - 1]['topic'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <td id = "shortPost" colspan="2">
                            <? echo htmlspecialchars(stripslashes($news[$i - 1]['shortPost'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <td height="190" width="220" rowspan="2"><a href='index.php?id=<? echo /*$start_from+$i*/$news[$i-1]['newsId']; ?>' id="newsLink">Читать далее...</a></td>
                        <td id="dataTopic"><?echo htmlspecialchars(stripslashes($news[$i - 1]['datePost'])); ?></td>
                    </tr>
                    <tr>
                        <td id="countAnsw"><img src="../img/answers.png"><p><?echo $countAnswersInNews?></p></td>
                    </tr>
                </table>

            </div>
        </div>
        <?
    }
}
?>