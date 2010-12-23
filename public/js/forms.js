$(document).ready(function(){

    // ajax submit for crud forms
    $('form.crud').live('submit',function(e){
        e.preventDefault();
        load();
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
                if (json.success && (json.goTo != undefined && json.goTo != '')) {
                    window.location.href = json.goTo;
                }
            },
            error: ajaxError,
            complete: unload
        });
    });

    //dialog ajax
    $('#dialog a,.actions a.ajax').live('click',function(){
        load();

        $('#dialog').load($(this).attr('href'), function(html, status){
            unload();
        })
        .dialog({
            modal:true,
            width: 600
        })
        .dialog('open');

        return false;
    });

    // ajax links
    $('a.ajax-load, a.order').live('click',function(){
        $('#view').load($(this).attr('href'));
        return false;
    });

    $('#searchForm').live('submit',function(e){
        e.preventDefault();
        var form = $(this);
        load();
        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            cache:false,
            type: 'POST',
            success: function(html){
                $('#view').html(html)
            },
            complete: unload,
            error: ajaxError
        });
    });

    $('#menuTop a').live('click',function(){
        load();
        var a = $(this);
        $('#view').load(a.attr('href'), function(response, status){
            unload();
            if (status !== "error") {
                $('#menuTop li').removeClass('active');
                a.parent('li').addClass('active');
            }
        });
        return false;
    });

    


});

function load(){
//console.log('loading');
}
function unload(){
//console.log('ready');
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