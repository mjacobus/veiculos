$(document).ready(function(){
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
                showCrudMessages(json.messages);
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
                $('#dialog').html(html).dialog({
                    modal:true,
                    width: 600
                });;

            }, error: function(){

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

function showCrudMessages(messages)
{
    if ($('#topMessages div.messages').length == 0) {
        $('#topMessages').prepend('<div class="messages"></div>');
    }
    var hasMessage = false;
    for (var type in messages) {
        if (messages[type].length > 0) {
            hasMessage = true;
        }
        showMessages(messages[type], $('#topMessages div.messages'), type);
    }
    if (!hasMessage) {
        $('#topMessages, #topMessages div.messages').hide();
    } else {
        $('#topMessages, #topMessages div.messages').show();
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
        $('#' + element).addClass('error').parent('dd').append('<ul id="error-' + element + '" class="error-list">');
        list = $('#error-' + element);

        for (var error in formErrors[element]) {
            list.append('<li>' + formErrors[element][error] + '</li>');
        }
    }
}