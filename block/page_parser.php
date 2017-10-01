<?
// Вывод списка страниц
echo '<p id="pageParserId">';
for ($page = 1; $page <= $num_pages; $page++) {
    if ($page == $current_page) {
        echo '<strong>' . $page . '</strong> &nbsp;';
    } else {
        echo '<a href="index.php?page=' . $page . '">' . $page . '</a> &nbsp;';
    }
}
echo '</p>';

?>