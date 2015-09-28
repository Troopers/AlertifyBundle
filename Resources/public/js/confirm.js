$(document).on('submit','form.confirm, form[data-toggle="confirm"]',function(e){
    smartConfirm(e,this,'form');
});

$(document).on('click','a.confirm, a[data-toggle="confirm"]',function(e){
    smartConfirm(e,this,'a');
});

function smartConfirm(e,referer,type){

    if ($(e.target).hasClass('confirm')) {
        console.warn('DEPRECATION MESSAGE | Alertify - Confirm - Please do not use class="confirm" anymore and replace it by data-toggle="confirm"');
    }
    if($(referer).attr('data-confirm-field-id') != undefined && $('#'+$(referer).attr('data-confirm-field-id')).attr('checked') == "checked" ){
        return true;
    }
    e.preventDefault();
    $(referer).removeClass('confirm');
    $(referer).addClass('confirm-waiting');
    $.post(
        Routing.generate('alertify_confirm'),
        {
            title: $(referer).attr('data-title'),
            body: $(referer).attr('data-body'),
            confirm_callback: $(referer).attr('data-confirm-callback'),
            cancel_button_class: $(referer).attr('data-cancel-button-class'),
            confirm_button_class: $(referer).attr('data-confirm-button-class'),
            cancel_button_value: $(referer).attr('data-cancel-button-value'),
            confirm_button_value: $(referer).attr('data-confirm-button-value'),
            modal_class: $(referer).attr('data-confirm-class'),
            id: $(referer).attr('id'),
            type: type
        },
        function(data){
            $("body").append(data);
        }
    );
}
