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
                showMessagesAllMessages(json.messages);
                showFormErrors(json.formErrors, form);
                if (json.success && (json.goTo != undefined && json.goTo != '')) {
                    window.location.href = json.goTo;
                }
            },
            error: handleError,
            complete: unload
        });
    });
});

function load(){
//console.log('loading');
}
function unload(){
//console.log('ready');
}

function showMessagesAllMessages(messages)
{
    for (var type in messages) {
        showMessages(messages[type], $('div.' + type + '-messages'));
    }
}

function showMessages(messages,container)
{
    if (container.length > 0) {
        var list = $('<ul class="messages"></ul>');
        var hasMessage = false;
        for(var i in messages) {
            hasMessage = true;
            list.append('<li>' + messages[i] + '</li>');
        }
        if (hasMessage) {
            container.html(list).show();
        }
    } else {
        alertMessages(messages);
    }
}

function alertMessages(messages)
{
    if(messages.length > 0) {
        var text = '';
        for(var i in messages) {
            text += "- " + messages[i] + "\n";
        }
        alert(text);
    }
}

function showFormErrors(formErrors, form)
{
    if (form !== undefined) {
        form.find('ul.error-list').remove();
    }
    var list;
    for (var element in formErrors) {
        hasError = true;
        $('#' + element).parent('dd').append('<ul id="error-' + element + '" class="error-list">');
        list = $('#error-' + element);

        for (var error in formErrors[element]) {
            list.append('<li>' + formErrors[element][error] + '</li>');
        }
    }
}

function handleError()
{
    
}