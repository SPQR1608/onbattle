<?php
if (isset($_POST['nameButton'])) {
    $buttonName = $_POST['nameButton'];
    echo $buttonName.'->';
}
if(isset($_POST['photoURLAjax'])){
    echo $_POST['photoURLAjax'];
}
?>