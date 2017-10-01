<? require_once "block/start.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>On Battle</title>
    <? require_once "block/links.php"; ?>
</head>

<body>
<?php require_once "block/top.php" ?>
<div class="news">
    <? if (isset($_GET['id'])) {
        require_once "block/news.php";
    } else {
        ?>
        <div class="previewInNews">
            <?
            require_once "block/news.php";
            ?>
        </div>
    <? } ?>
</div>
<div class="pageParser">
    <?
    if(!isset($_GET['id'])) {
        include "block/page_parser.php";
    }
    ?>
</div>
<div class="footer">
<?require_once "block/footer.php"?>
</div>
</body>

</html>
