jQuery(document).ready(function ($) {
    var width = $(window).width();
    if (width > 1170) {
        var position = ( width - 1170 ) / 2;
        $('.question').css('right', position);
    }

    $(document).on('click', '.quest-title', (function () {
            var $questText = $('.quest-text');
            $('.quest-title').find('.fa-times').toggle();
            if ($questText.is(":hidden")) {
                $questText.slideDown();
            } else {
                $questText.slideUp();
            }
        })
    );
    $(document).on('click', '#quest .send', (function () {
            //e.preventDefault();
            var form_data = $('#quest .email').val();
            var sameTerm = $('#quest #message').val();
            console.log(form_data);
            $.ajax({
                type: 'POST',
                url: vars.ajaxurl,
                data: {
                    action: 'send_custom_mail',
                    form: form_data,
                    message: sameTerm
                },
                success: function (data) {
                },
                error: function (errorThrown) {
                }
            });
        })
    );
    $(document).on('click', '#calc .send', (function (e) {
        e.preventDefault();
        var test = $('#left_orientation').prop("checked");
        console.log( test );

        $.ajax({
            type: 'POST',
            url: vars.ajaxurl,
            data: {
                action: 'custom_price',
                form: form_data,
                message: sameTerm
            },
            success: function (data) {
                console.log(data);
            },
            error: function (errorThrown) {
            }
        });
    }));


});