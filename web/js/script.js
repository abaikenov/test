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

    $('#preview').on('show.bs.modal', function (e) {
        var modal = $(this);
        var form = $('#form-task');
        modal.find('span.field-user').text(form.find('input#user').val());
        modal.find('span.field-email').text(form.find('input#email').val());
        modal.find('span.field-title').text(form.find('input#title').val());
        modal.find('span.field-text').text(form.find('textarea#text').val());
        modal.find('img.field-image').attr('src', form.find('input#image').val());
    });
});