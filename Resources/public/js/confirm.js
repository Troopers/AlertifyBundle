$('form.confirm').live('submit',function(e){
  smartConfirm(e,this,'form');
});

$('a.confirm').live('click',function(e){
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
      id:$(referer).attr('id'),
      type:type
    },
    function(data){
      $("body").append(data);
    }
  );

}