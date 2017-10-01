$(document).ready(function () {
    $(".answerToNewsAnswerSubmit").bind("click", function () {
        location.reload();
        //var ob = getCookie("buttonId");
        /*var button = document.getElementsByTagName('button'),
         ob = this.id;
         $.ajax({
         type: "POST",
         url: "block/ajax_send.php",
         data: ({id: ob}),
         dataType: "html",
         // data:"param="+JSON.stringify(ob),
         success: function (ob) {
         // $('.answerToNewsButton').text(data);
         //$('.answerToNewsButton').html(html);
         //$("<p class='for_content'>" + html['title'] + "</p>").
         /*prependTo(".answerToNewsButton").
         hide().
         fadeIn(500);
         //alert(ob);*/
    });
});