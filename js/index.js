"use strict";

$( document ).ready(function ()
{
    /*
    /* ----------------------------------------------------------------------- */
    var btnSubscribe = $('[data-action="subscribe"]');
    var frmSubscribe = $('form[name="subscribe"]');

    btnSubscribe.on('click', function()
    {
        frmSubscribe.submit();
    });

    frmSubscribe.submit(function(e)
    {
        e.preventDefault();
        var data = frmSubscribe.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success')
                {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
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
