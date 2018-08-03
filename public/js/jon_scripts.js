jQuery(document).ready(function ($) {
    $('div.media div.media-body').each(function (i) {
        $(this).find('span.commentNumber').text('#' + (i+1))
    });

    /* делаем невидимой ветку обсуждения (связ с главным комментом),
    оставляя родительский и ссылку показать ветку и ссылку отмена комментир. */
    $('a.hide-answers').click();
    $('a.cancel-reply-link').hide();


    $('#leave_reply').on('click', '#submit', function (e) {
        e.preventDefault();
        $('.ajax_result').css('color', 'green').
            text('Сохранение комментария...').
            fadeIn(500, function () {
            var data = $('#leave_reply').serializeArray();
            $.ajax({
                url: $('#leave_reply').attr('action'),
                data: data,
                // строка headers: из доки по Ларавелу
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                datatype: 'JSON',
                success: function (html) {
                    if(html.error) {
                        $('.ajax_result').css('color', 'red')
                            .append('<br><strong>Ошибка...</strong>' + html.error.join('<br>'));
                        $('.ajax_result').delay(2000).fadeOut(500);
                    }
                    else if(html.success) {
                        //console.log(html.data, html.comment);
                        $('.ajax_result').append('<br><strong>Сохранено...</strong>')
                            .delay(2000)
                            .fadeOut(500, function () {
                                //в ларе 5.4 этот код работал на = 0 , тут(5.5) или = "0" или == 0 ... :)
                                if(html.data.parent_id == 0) {
                                    //родительский коммент, те parent_id = 0, выводим слева без отступов
                                    $('div#start').before('<div class="media">' + html.comment + '</div>');
                                    $('ul.media-list p.hide-after-comment').hide();
                                } else {
                                    // дочерний элемент, те ответ на уже существующий,
                                    // html.comment формир. в CommentController стр. 82 и возвр. сюда (return Response::json...)
                                    //$('form#leave_reply').parent().after('<div class="children">' + html.comment +'</div>');
                                    $('div#comment-'+html.data.parent_id+' div.media-body p#item-text-'+html.data.parent_id)
                                        .after('<div class="media-body">' + html.comment + '</div>');
                                    $('a.cancel-reply-link').click();
                                }
                            });
                    }
                },
                error: function () {
                    $('.ajax_result').css('color', 'red').append('<br><strong>Ошибка...</strong>');
                    $('.ajax_result').delay(3000).fadeOut(1000, function() {
                        $('a.cancel-reply-link').click();
                    });
                },

            });
            //console.log('OK! Script was here...');
        });
    });


});

/**
 * прячем div с ответами на родит.коммент, и ссылку "скрыть ответы",
 * показываем ссылку "показать ответы" (на родит. комменты с parent_id ==0)
 **/
function hideAnswers(i) {

    $('div#child-' + i + ' div.media').hide();
    $('div.media-body' + ' a#hide-answers-' + i).hide();
    $('div.media-body' + ' a#show-answers-' + i).show();
    return false;
}

/**
 * показыв div с ответом на родит.коммент, и ссылку "скрыть ответы",
 * скрываем ссылку "показать ответы" (на родит. комм. parent_id ==0)
**/
function showAnswers(i) {

    $('div#child-' + i + ' div.media').show();
    $('div.media-body' + ' a#show-answers-' + i).hide();
    $('div.media-body' + ' a#hide-answers-' + i).show();
    return false;
}

/**
 * Перемещаем форму для комментариев под тот коммент, к-рый хотим откомментировать.
 * прячем ссылки reply (тк мы в режиме reply) показываем ссылку a#cancel-reply-'+id
 * и самое главное - назначаем родителя комментария (стр. 101!)
**/
function moveForm(id) {
    ////event.preventDefault();
    ////console.log('div#comment-' + id + '>p.item-text');
    $('form#leave_reply').detach().insertAfter($('div#comment-' + id + ' div.media-body a#reply-' + id));
    $('div#comment-' + id + ' div.media-body a#reply-' + id).hide();
    $('a.reply-link').hide();
    $('div#comment-' + id + ' div.media-body a#cancel-reply-' + id).show();
    $('form#leave_reply input#comment_parent').val(id);

    return false;
}


/**
 * Возвращаем форму на первоначальное место. Прячем ссылку a#cancel-reply-'+id
 * (убрать форму комментир.) показываем ссылки a.reply-link (ответить на коммент)
 * и (!) parent_id (input#comment_parent) делаем = 0 (иначе ajax комменты суются не туда:)
**/
function removeForm(id) {
    //event.preventDefault();
    //console.log('div#comment-' + id + '>p.item-text');
    $('form#leave_reply').detach().insertAfter( $('div#comment-sec>br#start-form-position'));
    $('div#comment-' + id + ' div.media-body a#reply-' + id).show();
    $('a.reply-link').show();
    $('div#comment-' + id + ' div.media-body a#cancel-reply-'+id).hide();
    $('form#leave_reply input#comment_parent').val(0);

    return false;
}