<br>
<h1>Добавление новости</h1>
<hr>
<p>
<form name='newsAddForm' method="post">
    Название новости:<br>
    <input type="text" name="newsTopic" size="100" maxlength="250">
    <br>
    <br>
    Краткое описание новости:<br>
    <textarea name="shortPost" cols="70" rows="5"></textarea>
    <br>
    <br>
    Полное описание новости:<br>
    <textarea name="onePost" cols="70" rows="20"></textarea>
    <br>
    <br>
    <h2>Перед добалением новости, загрузите фото для превью.</h2>
    <br>
    <input type="submit" name="newNewsSubmit" value="Добавить новость">
    <input type="reset" name="newsLblReset" value="Сброс текста">
    <br>
    <br>
</form> </p>
<iframe name="photoFrame" style="display: none"></iframe>
<form method="post" enctype="multipart/form-data" target="photoFrame">
    <h3>Фото для превью:</h3>
    <p><input name="previewPhoto" type="file"><br></p>
    <p><input type="submit" name="photoPreviewSubmit" value="Загрузить"></p>
</form>
<br>
<?
if (isset($_POST['photoPreviewSubmit'])) {
    if (isset($_FILES['previewPhoto']['name'])) {

        if ($_FILES['previewPhoto']['error'] == 0) {

            if (substr($_FILES['previewPhoto']['type'], 0, 5) == 'image') {

                $uploadDir = './img/Preview/';
                $uploadFile = $uploadDir . basename($_FILES['previewPhoto']['name']);
// Копируем файл из каталога для временного хранения файлов:
                if (copy($_FILES['previewPhoto']['tmp_name'], $uploadFile)) {
                    bufferPhoto($uploadFile);

                }

            }
        }
    }
}

if (isset($_POST['newNewsSubmit']) && (!empty($_POST['newsTopic'])) && (!empty($_POST['shortPost'])) && (!empty($_POST['onePost']))) {
    $newsTopic = trim($_POST['newsTopic']);
    $shortPost = trim($_POST['shortPost']);
    $onePost = trim($_POST['onePost']);

    if (!get_magic_quotes_gpc()) {
        $newsTopic = addslashes($newsTopic);
        $shortPost = addslashes($shortPost);
        $onePost = addslashes($onePost);
    }
    $previewPhotoRow = getOnePhotoURL();
    $previewPhoto = $previewPhotoRow->fetch_assoc();
    addNews($newsTopic, $onePost, $shortPost, $previewPhoto['image']);
    TruncateTable();
}
?>
