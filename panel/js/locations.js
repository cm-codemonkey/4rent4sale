'use strict';

$(document).ready(function()
{
    var frmNew  = $('form[name="new"]');
    var frmEdit = $('form[name="edit"]');
    
    var btnNew      = $('[data-action-modal="new"]');
    var btnEdit     = $('[data-action="edit"]');
    var btnDelete   = $('[data-action-modal="delete"]');

    var urlDelete = 'index.php?c=properties&m=deleteLocations';

    btnNew.on('click', function()
    {
        frmNew.submit();
    });

    btnEdit.on('click', function()
    {
        frmEdit.submit();
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

    multipleSelect(btnDelete, urlDelete, function(response)
    {
        if(response.status == 'success')
        {
            btnDelete.attr('disabled', '');
            location.reload();
        }
    });
});
