<?php
$bd = false;

function connectBD()
{
    global $bd;
    $bd = new mysqli('localhost', 'user', '', 'onbattle');
    $ms = mysqli_connect_error();
}

function closeBD()
{
    global $bd;
    $bd->close();
}


//User
function addUser($login, $password, $email, $date_rojd, $userPhoto)
{
    global $bd;
    connectBD();
    $query = "insert into users(user_login,user_password,email,date_rojd, user_photo, reg_date) values('" . $login . "','" . $password . "','" . $email . "', '" . $date_rojd . "', '" . $userPhoto . "', CURDATE())";
    $bd->query($query);
    closeBD();
}

function checkUser($login)
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM users WHERE user_login='" . $login . "'";
    $result = $bd->query($query);
    closeBD();
    if ($result->fetch_assoc()) return true;
    else return false;
}

function getUser()
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM users WHERE user_login='" . $_SESSION['user_login'] . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function addPhoto($userPhoto)
{
    global $bd;
    connectBD();
    $query = "UPDATE users SET user_photo = '" . $userPhoto . "' WHERE user_login='" . $_SESSION['user_login'] . "'";
    $bd->query($query);
    closeBD();
}

function insertImage($image)
{
    global $bd;
    connectBD();
    $query = "insert into image(image) values('" . $image . "')";
    $bd->query($query);
    closeBD();
}

/*function getUserPhoto(){
    global $bd;
    connectBD();
    $query = "SELECT user_photo FROM users WHERE user_login='" . $_SESSION['user_login'] . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}*/


//AccountChange
function changeUserPhoto($userPhoto)
{
    global $bd;
    connectBD();
    $query = "UPDATE users SET user_photo = '" . $userPhoto . "' WHERE user_login='" . $_SESSION['user_login'] . "'";
    $bd->query($query);
    closeBD();
}

function changeUserEmail($userEmail)
{
    global $bd;
    connectBD();
    $query = "UPDATE users SET email = '" . $userEmail . "' WHERE user_login='" . $_SESSION['user_login'] . "'";
    $bd->query($query);
    closeBD();
}

function changeUserNick($userNick)
{
    global $bd;
    connectBD();
    $query = "UPDATE users SET user_login = '" . $userNick . "' WHERE user_login='" . $_SESSION['user_login'] . "'";
    $bd->query($query);
    closeBD();
}

function changeUserDate($userDate)
{
    global $bd;
    connectBD();
    $query = "UPDATE users SET user_login = '" . $userDate . "' WHERE user_login='" . $_SESSION['user_login'] . "'";
    $bd->query($query);
    closeBD();
}


//******
//Форум
//******
function addTheme($forum_theme)
{
    global $bd;
    connectBD();
    $query = "insert into forum_theme(theme, theme_author, create_date) values('" . $forum_theme . "','" . $_SESSION['user_login'] . "',CURDATE())";
    $bd->query($query);
    closeBD();
}

function getAllTheme()
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM forum_theme";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}

function getOneForumTheme($idTheme)
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM forum_theme WHERE id_theme = '" . $idTheme . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getLastAnswer($idTheme)
{
    global $bd;
    connectBD();
    $query = "SELECT answer_author FROM answers WHERE id_theme='".$idTheme."' ORDER BY answer_author DESC LIMIT 1";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getCountAnswer($idTheme)
{
    global $bd;
    connectBD();
    $query = "SELECT answer FROM answers WHERE id_theme='".$idTheme."'";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}

function resultSetToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }
    return $array;
}

function getAnswers($idTheme)
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM answers, forum_theme WHERE answers.id_theme='" . $idTheme . "' and forum_theme.id_theme = '" . $idTheme . "'";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}

function addForumAnswer($idTheme, $answer)
{
    global $bd;
    connectBD();
    $query = "insert into answers(id_theme, answer_author, answer, answer_date) values('" . $idTheme . "','" . $_SESSION['user_login'] . "','" . $answer . "', CURDATE())";
    $bd->query($query);
    closeBD();
}

function addAnswersToForumAnswer($idTheme, $answer)
{
    global $bd;
    connectBD();
    $pointer = '->';
    $position = stripos($answer, $pointer);
    $fWhom = substr($answer, 0, $position);
    $positionAnsw = $position + 2;
    $answerPart = substr($answer, $positionAnsw);
    $query = "insert into answers(id_theme, answer_author, answer, answer_date, f_whom) values('" . $idTheme . "','" . $_SESSION['user_login'] . "','" . $answerPart . "', CURDATE(), '" . $fWhom . "')";
    $bd->query($query);
    closeBD();
}

function getUserPhotoInForum($author)
{
    global $bd;
    connectBD();
    $query = "SELECT user_photo FROM users WHERE user_login = '" . $author . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getFWhomPhotoInForum($fWhom)
{
    global $bd;
    connectBD();
    $query = "SELECT user_photo FROM users WHERE user_login = '" . $fWhom . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

//*******


//*******
//Новости
//*******
function addNews($topic, $onePost, $shortPost, $previewPhoto)
{
    global $bd;
    connectBD();
    $query = "INSERT INTO news(topic, onePost, shortPost, datePost, preview_photo) values('" . $topic . "','" . $onePost . "','" . $shortPost . "', CURDATE(), '".$previewPhoto."')";
    $bd->query($query);
    closeBD();
}

function addAnswerToNews($nTopic, $answer, $idAnswerInTopic)
{
    global $bd;
    connectBD();
    $query = "INSERT INTO news_answer(answer_author, news_topic, answer, answer_date, answ_id_in_topic) values('" . $_SESSION['user_login'] . "','" . $nTopic . "','" . $answer . "', CURDATE(), '" . $idAnswerInTopic . "')";
    $bd->query($query);
    closeBD();
}

function addAnswerToNewsAnswers($nTopic, $answer, $idAnswerInTopic)
{
    global $bd;
    connectBD();
    $pointer = '->';

    $position = stripos($answer, $pointer);
    $fWhom = substr($answer, 0, $position);
    $positionAnsw = $position + 2;
    $answerPart = substr($answer, $positionAnsw);
    $query = "INSERT INTO news_answer(answer_author, news_topic, answer, answer_date, answ_id_in_topic, f_whom) values('" . $_SESSION['user_login'] . "','" . $nTopic . "','" . $answerPart . "', CURDATE(), '" . $idAnswerInTopic . "', '" . $fWhom . "')";
    $bd->query($query);
    closeBD();
}

function getAnswersToNews($topic, $start_from, $on_page)
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM news_answer WHERE news_topic = '" . $topic . "' LIMIT $start_from, $on_page";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}

function getAllNews($start_from, $on_page)
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM news ORDER BY newsId DESC LIMIT $start_from, $on_page";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}

function getCountNews(){
    global $bd;
    connectBD();
    $query = "SELECT * FROM news";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}

function getOneNews($newsId)
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM news WHERE newsId = '" . $newsId . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getAnswerToNewsAnswers($newsID)
{
    global $bd;
    connectBD();
    $query = "SELECT * FROM news_answer_to_answers, news WHERE answ_id_in_answ = '" . $newsID . "' and newsId = '" . $newsID . "'";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}

function getLastAnswersNumInTopic($topic)
{
    global $bd;
    connectBD();
    $query = "SELECT answ_id_in_topic FROM news_answer WHERE news_topic = '" . $topic . "' ORDER BY answ_id_in_topic DESC LIMIT 1";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getLastAnswToAnswNumInTopic($answerAuthor)
{
    global $bd;
    connectBD();
    $query = "SELECT answ_id_in_answ FROM news_answer_to_answers WHERE answer_author = '" . $answerAuthor . "' ORDER BY answ_id_in_topic DESC LIMIT 1";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getCountAnswersNumInTopic($topic)
{
    global $bd;
    connectBD();
    $query = "SELECT COUNT(answ_id_in_topic) FROM news_answer WHERE news_topic = '" . $topic . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getAllAnswersNumInTopic($topic)
{
    global $bd;
    connectBD();
    $query = "SELECT answ_id_in_topic FROM news_answer WHERE news_topic = '" . $topic . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getCountAnswToAnswNumInTopic($answerAuthor)
{
    global $bd;
    connectBD();
    $query = "SELECT COUNT(answ_id_in_answ) FROM news_answer_to_answers WHERE answer_author = '" . $answerAuthor . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getUserByIdNews($id, $topic)
{
    global $bd;
    connectBD();
    $query = "SELECT answer_author FROM news_answer WHERE answ_id_in_topic = '" . $id . "' and news_topic = '" . $topic . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getUserPhotoInNews($author)
{
    global $bd;
    connectBD();
    $query = "SELECT user_photo FROM users WHERE user_login = '" . $author . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function getFWhomPhotoInNews($fWhom)
{
    global $bd;
    connectBD();
    $query = "SELECT user_photo FROM users WHERE user_login = '" . $fWhom . "'";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function bufferPhoto($previewPhoto){
    global $bd;
    connectBD();
    $query = "INSERT INTO image(image) VALUES ('".$previewPhoto."')";
     $bd->query($query);
    closeBD();
}

function getOnePhotoURL(){
    global $bd;
    connectBD();
    $query = "SELECT image FROM image";
    $result = $bd->query($query);
    closeBD();
    return $result;
}

function TruncateTable(){
    global $bd;
    connectBD();
    $query = "TRUNCATE TABLE image";
    $bd->query($query);
    closeBD();
}

function getCountAnswInTopicForPreview($topic){
    global $bd;
    connectBD();
    $query = "SELECT answer FROM news_answer WHERE news_topic = '" . $topic . "'";
    $result = $bd->query($query);
    closeBD();
    return resultSetToArray($result);
}
//*******
function Alert($alert)
{
    echo '<script>alert("' . $alert . '")</script>';
}

?>