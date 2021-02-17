'use strict';

$(document).ready(function()
{
    var btn = $('[id="send"]');
    var frm = $('form[name="contact"]');

    btn.on('click', function()
    {
        frm.submit();
    });

    frm.submit(function(e)
    {
        e.preventDefault();
        var data = frm.serialize();

        $.ajax({
            url: '',
            type: "POST",
            data: data,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success')
                {
                    $('p.error').html('<img src="images/gif-load-black.gif" style="width: 25px;"/>' );
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });
});
