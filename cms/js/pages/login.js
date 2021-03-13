"use strict";

$( document ).ready(function ()
{
    var MyDocument = $(this);

    MyDocument.on('submit', 'form[name="login"]', function ( event )
    {
        event.preventDefault();

        var self = $(this);

        self.addClass('loading');

        var post = new FormData(this);

        post.append('action', 'login');

        $.ajax({
            type: "POST",
            data: post,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function ( response )
            {
                self.removeClass('loading');

                $('label.error').removeClass('error');
                $('label p.error').remove();

                if ( response.status == 'error' )
                {
                    $.each(response.labels, function (i, label)
                    {
                        MyDocument.find('[name="'+ label[0] +'"]').parents('label').addClass('error').append('<p class="error">'+ label[1] +'</p>');
                    });

                    MyDocument.find('label.error [name]')[0].focus();
                }
                else
                    window.location.href = response.redirect;
            }
        });
    });
});
