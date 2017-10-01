function AjaxFormRequest(result_id,formMain,url) {
    jQuery.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        data: jQuery("#"+formMain).serialize(),
        success: function(response) {
            document.getElementById(result_id).innerHTML = response;
        },
        error: function(response) {
            document.getElementById(result_id).innerHTML = "Возникла ошибка при отправке формы. Попробуйте еще раз";
        }
    });
}