function getCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return (setStr);
}

function delCookie(name) {
    document.cookie = name + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT";
}

function myOnclick(obj) {
    var id = obj.id;
    document.cookie = "id = " + id;
}
function myclick(obj) {
    var id = obj.name;
    document.cookie = "id1 = " + id;
}

function Link(obj) {
    var input = document.createElement("div"),
        button = document.getElementsByTagName('button');

    input.innerHTML = '<div class = "answerToNewsField">\
        <form method="POST">\
        <p><textarea name = "answerToAnswer" id="answerToAnswerTextArea" rows = "5" cols = "30" maxlength="500"></textarea></p>\
        <p><input type="submit" name="answerToNewsAnswerSubmit" class = "answerToNewsAnswerSubmit" value="Ответить">\
        </form>';

    for (var i = 0, len = button.length; i < len; i++) {
        if (obj.id === button[i].id) {
            var id = obj.id,
                name = button[i].name;
            button[i].parentNode.replaceChild(input, button[i]);
            document.cookie = "buttonId = " + id;
            document.cookie = "buttonName = " + name;
            $.ajax({
                type: "POST",
                url: "block/ajax_send.php",
                data: {nameButton: name},
                response:'text',
                success: function (data) {
                    document.getElementById('answerToAnswerTextArea').innerHTML = data;
                }
            });
            break;
        }
    }
}
function ForumLink(obj) {
    var input = document.createElement("div"),
        button = document.getElementsByTagName('button');

    input.innerHTML = '<div class = "answerToForumField">\
        <form method="POST">\
        <p><textarea name = "forumAnswerToAnswer" id="forumAnswerToAnswerTextArea" rows = "5" cols = "30" maxlength="500"></textarea></p>\
        <p><input type="submit" name="answerToForumAnswerSubmit" class = "answerToForumAnswerSubmit" value="Ответить">\
        </form>';

    for (var i = 0, len = button.length; i < len; i++) {
        if (obj.id === button[i].id) {
            var id = obj.id,
                name = button[i].name;
            button[i].parentNode.replaceChild(input, button[i]);
            document.cookie = "buttonId = " + id;
            document.cookie = "buttonName = " + name;
            document.getElementById('forumAnswerToAnswerTextArea').innerHTML = name+'->';
           /* $.ajax({
                type: "POST",
                url: "block/ajax_send.php",
                data: {nameButton: name},
                response:'text',
                success: function (data) {
                    document.getElementById('forumAnswerToAnswerTextArea').innerHTML = data;
                }
            });*/
            break;
        }
    }
}

function ReloadPage(){
    var pageHref=location,
        pHref =pageHref.toString();

    document.location.href = pHref;
}

function IndexPage(){
    var pageHref='http://onbattle.ru/index.php';
        //pHref =pageHref.toString();
    document.location.href = pageHref;
}
function photoCorrect(){
    var input = document.createElement("p"),
        button = document.getElementById('photoButtonCorrect');

    input.innerHTML='<p class = "photoChange">\
        <form enctype="multipart/form-data" method="POST">\
        <p><input name = "photoChange" type="file"></p>\
        <p><input type="submit" name="photoButtonChange" value="Изменить автарку">\
        </form>';
    button.parentNode.replaceChild(input, button);
}

function nickCorrect(){
    var input = document.createElement("p"),
        button = document.getElementById('nickButtonCorrect');

    input.innerHTML='<p class = "nickChange">\
        <form method="POST">\
        <p><input name = "nickChange" type="text"></p>\
        <p><input type="submit" name="nickButtonChange" value="Изменить">\
        </form>';
    button.parentNode.replaceChild(input, button);
}

function emailCorrect(){
    var input = document.createElement("p"),
        button = document.getElementById('emailButtonCorrect');

    input.innerHTML='<p class = "emailChange">\
        <form method="POST">\
        <p><input name = "emailChange" type="text"></p>\
        <p><input type="submit" name="emailButtonChange" value="Изменить">\
        </form>';
    button.parentNode.replaceChild(input, button);
}

function dateCorrect(){
    var input = document.createElement("p"),
        button = document.getElementById('dateButtonCorrect');

    input.innerHTML='<p class = "dateChange">\
        <form method="POST">\
        <p>День</p>\
        <p><input name="changeDay" type="text" size="3" maxlength="2"></p>\
        <p>Месяц</p>\
        <p><input name="changeMoth" type="text" size="3" maxlength="2"></p>\
        <p>Год</p>\
        <p><input name="changeYear" type="text" size="5" maxlength="4"></p>\
        <p><input type="submit" name="dateButtonChange" value="Изменить">\
        </form>';
    button.parentNode.replaceChild(input, button);
}

function AddForumThemeButton(){
    var input = document.createElement("p"),
        button = document.getElementById('AddThemeButton');

    input.innerHTML='<p class = "addTheme">\
        <form method="POST">\
        <p><textarea name = "forum_theme" rows = "5" cols = "30" maxlength="500"></textarea></p>\
        <p><input type="submit" name="themeSubmit" value="Добавить тему">\
        </form>';
    button.parentNode.replaceChild(input, button);
}

//SCROLL
window.onload = function() { // после загрузки страницы

    var scrollUp = document.getElementById('scrollup'); // найти элемент

    scrollUp.onmouseover = function() { // добавить прозрачность
        scrollUp.style.opacity=0.3;
        scrollUp.style.filter  = 'alpha(opacity=30)';
        scrollUp.style.background = '#2fc5ff';
    };

    scrollUp.onmouseout = function() { //убрать прозрачность
        scrollUp.style.opacity = 0.6;
        scrollUp.style.filter  = 'alpha(opacity=50)';
        scrollUp.style.background = '#aaa';
    };

    scrollUp.onclick = function() { //обработка клика
        window.scrollTo(0,0);
    };

// show button
    window.onscroll = function () { // при скролле показывать и прятать блок
        if ( window.pageYOffset > 0 ) {
            scrollUp.style.display = 'block';
        } else {
            scrollUp.style.display = 'none';
        }
    };
};

function PhotoURLInNews(photoURL){
    //document.getElementById('photoURL').innerHTML = photoURL;
    document.getElementById('photoURL').value = photoURL;
}

