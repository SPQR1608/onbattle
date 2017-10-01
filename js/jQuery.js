$(document).ready(function(){
    // Фикмированная шапка при скролле
    $(window).scroll(function(){
        if ($(this).scrollTop() > 20) {
            $(".default").fadeIn('fast').show();
            //$(this).children().show();
        } else {
            $(".default").fadeIn('fast').hide();
        };
    });
});

$(function(){
    $('.newsPreview').hover(function(){
        $(this).children("#newsPreviewTable").stop().animate({marginTop: '1%'},600);
    },function(){
        $(this).children("#newsPreviewTable").stop().animate({marginTop: '15%'},600);
    });

})();