$(document).on('submit','form[data-toggle="confirm"]',function(e){
    smartConfirm(e, this, 'form');
});

$(document).on('click','a[data-toggle="confirm"]',function(e){
    smartConfirm(e, this, 'a');
});

/**
 * Get a modal to ask some confirmation.
 */
function smartConfirm(e, element, type){
    if ($(element).attr('data-confirm-field-id') != undefined && $('#'+$(element).attr('data-confirm-field-id')).attr('checked') == "checked" ) {
        return true;
    }
    e.preventDefault();
    $(element).attr('data-toggle', 'confirm-waiting');
    $.post(
        Routing.generate('alertify_confirm'),
        {
            title: $(element).attr('data-title'),
            body: $(element).attr('data-body'),
            confirm_callback: $(element).attr('data-confirm-callback'),
            cancel_button_class: $(element).attr('data-cancel-button-class'),
            confirm_button_class: $(element).attr('data-confirm-button-class'),
            cancel_button_value: $(element).attr('data-cancel-button-value'),
            confirm_button_value: $(element).attr('data-confirm-button-value'),
            modal_class: $(element).attr('data-confirm-class'),
            id: $(element).attr('id'),
            type: type
        },
        function(data){
            $("body").append(data);
        }
    );
}
