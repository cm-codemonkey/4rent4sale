'use strict';

$(document).ready(function()
{
    /* new entry
    /* ----------------------------------------------------------------------- */
    var frmNew  = $('form[name="new"]');
    var btnNew  = $('[data-action="new"]');

    btnNew.on('click', function()
    {
        frmNew.submit();
    });

    frmNew.submit(function(e)
    {
        e.preventDefault();
        var data = frmNew.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnNew.parent().remove();
                    window.location.href = response.path;
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit entry
    /* ----------------------------------------------------------------------- */
    var frmEdit = $('form[name="edit"]');
    var btnEdit = $('[data-action="edit"]');

    btnEdit.on('click', function()
    {
        frmEdit.submit();
    });

    frmEdit.submit(function(e)
    {
        e.preventDefault();
        var data = frmEdit.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEdit.parent().remove();
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

    /* delete entries
    /* ----------------------------------------------------------------------- */
    var urlDelete = 'index.php?c=services&m=deleteServices';
    var btnDelete = $('[data-action-modal="delete"]');

    multipleSelect(btnDelete, urlDelete, function(response)
    {
        if(response.status == 'success')
        {
            btnDelete.attr('disabled', '');
            location.reload();
        }
    });
});
