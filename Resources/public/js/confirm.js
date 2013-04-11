$(document).on('submit','form.confirm',function(e){
  smartConfirm(e,this,'form');
});

$(document).on('click','a.confirm',function(e){
  smartConfirm(e,this,'a');
});

function smartConfirm(e,referer,type){
  if($(referer).attr('data-confirm-field-id') != undefined && $('#'+$(referer).attr('data-confirm-field-id')).attr('checked') == "checked" ){
    return true;
  }
  e.preventDefault();
  $(referer).removeClass('confirm');
  $(referer).addClass('confirm-waiting');
  $.post(confirmUrl,
    {
      title:$(referer).attr('data-title'),
      body:$(referer).attr('data-body'),
      cancel_button_class:$(referer).attr('data-cancel-button-class'),
      confirm_button_class:$(referer).attr('data-confirm-button-class'),
      id:$(referer).attr('id'),
      type:type
    },
    function(data){
      $("body").append(data);
    }
  );

}
