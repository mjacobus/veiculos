$(document).ready(function(){
    $('#menuTop').tabs({
        select: function(event, ui) {
            var url = $.data(ui.tab, 'load.tabs');
            if( url ) {
                location.href = url;
                return false;
            }
            return true;
        }
    }).find('.ui-state-active').removeClass('ui-state-active ui-tabs-selected');

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
            error: function() {
                alert('oops');
            },
            complete: unload
        });
    });


    $('a.ajax').live('click',function(){
        load();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success: function(html){

                html = $('<div>' + html + '</div>').find('form').attr('action',url);

                $('#dialog').html(html).dialog({
                    modal:true,
                    width: 600
                }).dialog('open');

            },
            error: function(){

            },
            complete: unload
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
    var container = form.find('div.messages');
    if (container.length == 0) {
        form.prepend('<div class="messages"></div>');
        container = form.find('div.messages');
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
    if (container.length > 0) {
        var list = $('<ul class="messages"></ul>');
        var hasMessage = false;
        for(var i in messages) {
            hasMessage = true;
            list.append('<li class="'+ type +'">' + messages[i] + '</li>');
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
        form.find('ul.error-list').remove();
        form.find('input, select, textarea').removeClass('error');
    }
    var list;
    for (var element in formErrors) {
        $('#' + element).addClass('error').parent('div').append('<ul id="error-' + element + '" class="error-list">');
        list = $('#error-' + element);

        for (var error in formErrors[element]) {
            list.append('<li>' + formErrors[element][error] + '</li>');
        }
    }
}