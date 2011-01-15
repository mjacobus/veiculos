
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
                showCrudMessages(json.messages,form.find('div.form-elements'));
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

    // prevent submiting
    $('#imagem').click(function(){
        return false;
    }).val('');

    if ($('#imagem').attr('src') == '') {
        $('#imagem').parents('div.label-and-element').hide();;
    }

    // suggest image
    $('#imagem_descricao').inputSuggest({
        url: baseUrl + '/admin/imagem/suggest',
        preAppend: function preAppend(item,suggestion,input,list) {
            item.attr('id', suggestion.id);
            item.attr('src', suggestion.arquivo);
            return item;
        },
        postSelect: function(item){
            $('#imagem_id').val(item.attr('id'));
            $('#imagem').attr('src',item.attr('src'))
                .parents('div.label-and-element').show();
        },
        onClear : function(input, list){
            input.val('');
            $('#imagem').attr('src','').val('');
            $('#imagem').parents('div.label-and-element').hide();
        },
        suggestionField: 'descricao'
    });

    // for removal
    $('#id-all').change(function(){
        $('input.crud_id').attr('checked',$(this).attr('checked'));
    });

    $('a.ajax.delete').click(function(){
        var form = $(this);
        var message = "Tem certeza que deseja excluir este registro?";
        var url = $(this).attr('href');

        if (confirm(message)) {
            $.ajax({
                url: url,
                type: 'POST',
                success: function(json){
                    if (typeof json == 'string')
                        json = eval('(' + json + ')');
                    showCrudMessages(json.messages,$('div.messages-container'));
                    if (json.success && (json.goTo != undefined && json.goTo != '' && json.goTo)) {
                        var parts = json.goTo.split('#');
                        window.location.href = json.goTo;
                    }
                }
            });
        }

        return false;
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

function showCrudMessages(messages,parentContainer)
{
    var container = parentContainer.find('div.messages ul');
    if (container.length == 0) {
        parentContainer.prepend('<div class="messages"><ul></ul></div>');
        container = parentContainer.find('div.messages ul:first');
    }
    container.html('');
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
        var hasMessage = false;
        for(var i in messages) {
            hasMessage = true;
            container.append('<li class="'+ type +'">' + messages[i] + '</li>');
        }
        if (hasMessage) {
            container.show();
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