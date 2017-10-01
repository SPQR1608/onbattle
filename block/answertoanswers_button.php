<script>
    var myCookie = getCookie("buttonId");
    var Cookie = getCookie("id1");
</script>
    <div class="answerToNewsButton" id="<? echo strval($i) ?>">
        <iframe name="answerTarget".<? echo strval($i) ?> style="display: none"></iframe>
        <button class="answerToNewsButtonInDiv" id="<? echo strval($i) ?>" name = "<?echo $author_news_answer;?>" onclick="Link(this)">Ответить</button>
    </div>
<script>
    delCookie("buttonId");
</script>
