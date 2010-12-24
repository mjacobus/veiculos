
$(document).ready(function(){

    // ajax submit for crud forms
    $('form.crud').live('submit',function(e){
        load();
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: 'POST',
            data: form.serialize(),
            async: false,
            url: form.attr('action') !== '' ? form.attr('action') : window.location.href,
            success: function(json) {
                if (typeof json == 'string')
                    json = eval('(' + json + ')');
                showCrudMessages(json.messages,form);
                showFormErrors(json.formErrors, form);
                if (json.success && (json.goTo != undefined && json.goTo != '' && json.goTo !== window.location.href)) {
                var parts = json.goTo.split('#');
                    window.location.href = json.goTo;
                }
            },
            error: ajaxError,
            complete: unload
        });
    });


});



function load()
{
    $('input[type="submit"]').attr('disabled',true);

    if ($('#ajax-loader').length == 0) {
        var div = '<div id="ajax-loader" style="display:none; overflow:hidden;">'
        + '<img src="'+baseUrl+'/img/ajax-loader.gif" alt="carregando">'
        + '</div>';

        $('body').prepend(div);
    }

    $('#ajax-loader').openDOMWindow({
        modal:1,
        windowSourceID:"#ajax-loader",
        windowBGColor:'none',
        borderSize :0,
        height:100,
        width:150,
        overlayColor:'#000',
        overlayOpacity:'50'
    });
}

function unload()
{
    $('input[type="submit"]').attr('disabled',false);
    $('#ajax-loader').closeDOMWindow();
}

function showCrudMessages(messages,form)
{
    var container = form.find('div.ui-widget');
    if (container.length == 0) {
        form.find('div.form-elements').prepend('<div class="ui-widget"></div>');
        container = form.find('div.ui-widget');
    }
    var hasMessage = false;
    for (var type in messages) {
        if (messages[type].length > 0) {
            hasMessage = true;
        }
        showMessages(messages[type], container, type);
    }
    if (!hasMessage) {
        container.hide();
    } else {
        container.show();
    }
}

function showMessages(messages,container, type){

    var messageClass = 'ui-state-error';
    var iconClass = 'ui-icon-alert';
    if (type == 'info') {
        messageClass = 'ui-state-highlight';
        iconClass = 'ui-icon-info';
    }

    if (container.length > 0) {
        var list = $('<div class="' + messageClass + ' ui-corner-all" style="padding: 0pt 0.7em;"></div>');
        var hasMessage = false;
        for(var i in messages) {
            hasMessage = true;
            list.append('<span class="ui-icon ' + iconClass + '" style="float: left; margin-right: 0.3em;"/>');
            list.append('<p class="'+ type +'">' + messages[i] + '</p>');
        }
        if (hasMessage) {
            container.html(list).show();
        }
    } else {
        alertMessages(messages);
    }
}

function alertMessages(messages) {
    if(messages.length > 0) {
        var text = '';
        for(var i in messages) {
            text += "- " + messages[i] + "\n";
        }
        alert(text);
    }
}

function showFormErrors(formErrors, form){
    if (form !== undefined) {
        form.find('ul.errors').remove();
        form.find('input, select, textarea').removeClass('error');
    }
    var list;
    for (var element in formErrors) {
        $('#' + element).addClass('error').parent('div').append('<ul id="error-' + element + '" class="errors">');
        list = $('#error-' + element);

        for (var error in formErrors[element]) {
            list.append('<li>' + formErrors[element][error] + '</li>');
        }
    }
}

function ajaxError()
{
    alert('Oops! Um erro ocorreu.');
}