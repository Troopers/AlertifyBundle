$(document).ready(function() {

    $(document).on('click', '[data-alertify]', function(event) {
        event.preventDefault();
        $('#canvasloader-container').fadeIn();
        $("alertify-container").attr("data-update-effect", "show");
        $("alertify-container").attr("data-new-effect", "show");
        var params = getParams(this);
        alertify(params);

        return false;
    });

});

    function alertify(params) {

        $.ajax({
            url:  Routing.generate('alertify_ajax'),
            context: document.body,
            type: "POST",
            data: $.param(params),
            success: function(jsonResponse) {
                ajaxify(jsonResponse, "alertify-container", 'html');
            },
            error: function(jsonResponse) {
                alert("Il semble s'être produit une erreur");
            }
        });
    }

     function getParams(element){
        var type = $(element).attr("data-alertify");
        if(type == "modal"){
            var params = {
                main_type: "modal",
                title: $(element).attr('data-title') ? $(element).attr('data-title'):"",
                body: $(element).attr('data-body') ? $(element).attr('data-body'):$(element).attr('data-body-target') ? $($(element).attr('data-body-target')).html():"",
                button_class: $(element).attr('data-button') ? $(element).attr('data-button'):"",
                width: $(element).attr('data-width') ? $(element).attr('data-button'):"",
                static: $(element).attr('data-static') ? "true":""
            }
        }else if(type == "noty" || type == "toastr"){
            var params = {
                main_type: type,
                body: $(element).attr('data-body') ? $(element).attr('data-body'):"",
                type: $(element).attr('data-type') ? $(element).attr('data-type'):"",
                layout: $(element).attr('data-layout') ? $(element).attr('data-layout'):"",
                timeout: $(element).attr('data-timeout') ? $(element).attr('data-timeout'):""
            }
        }else{
                alert("Il semble s'être produit une erreur");
                $('#canvasloader-container').fadeOut();
        }
        return params;
    }
