"use strict";

$( document ).ready(function ()
{
    /*
    /* ----------------------------------------------------------------------- */
    var item            = $('[data-order="item"]');
    var btnOrderList    = $('[data-order="list"]');
    var btnOrderModule  = $('[data-order="module"]');

    btnOrderList.on('click', function()
    {
        item.addClass('list');
        btnOrderList.addClass('view');
        btnOrderModule.removeClass('view');
    });

    btnOrderModule.on('click', function()
    {
        item.removeClass('list');
        btnOrderList.removeClass('view');
        btnOrderModule.addClass('view');
    });

    /*
    /* ----------------------------------------------------------------------- */

    var mdlSendEmail = $('[data-modal-target-destination="sendEmail"]');
    var btnSendEmail = mdlSendEmail.find('[data-action-modal="sendEmail"]');
    var frmSendEmail = mdlSendEmail.find('form[name="sendEmail"]');

    btnSendEmail.on('click', function()
    {
        frmSendEmail.submit();
    });

    frmSendEmail.submit(function(e)
    {
        e.preventDefault();
        var data = frmSendEmail.serialize();


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
                    $('.error > p').html('<img src="images/gif-load.gif" style="width: 25px;"/>');
                    $('.error').addClass('view');
                    btnSendEmail.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('.error > p').html(response.message);
                    $('.error').addClass('view');
                }
            }
        });
    });
});
