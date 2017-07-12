/**
 * Created by Ami07 on 12.07.2017.
 */

$(function () {
    'use strict';

    $('#fileupload').fileupload({
        url: '/site/upload',
        dataType: 'json',
        done: function (e, data) {
            var output = $('#output');
            output.empty();
            $('<img src="' + data.result.src + '"/>').appendTo(output);
            $('input[name="image"]').val(data.result.src);
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('[data-target="#preview"]').click(function () {
        var modal = $('#preview');
        var form = $('#form-task');
        modal.find('span.field-user').text(form.find('input#user').val());
        modal.find('span.field-email').text(form.find('input#email').val());
        modal.find('span.field-title').text(form.find('input#title').val());
        modal.find('span.field-text').text(form.find('textarea#text').val());
    });
});