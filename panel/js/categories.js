'use strict';

$(document).ready(function()
{
    var link = '';

    var frmNew  = $('form[name="new"]');
    var frmEdit = $('form[name="edit"]');

    var btnNew      = $('[data-action-modal="new"]');
    var btnEdit     = $('[data-action="edit"]');
    var btnDelete   = $('[data-action-modal="delete"]');

    var uplLink = $('#link');

    var urlDelete = 'index.php?c=properties&m=deleteCategories';

    btnNew.on('click', function()
    {
        frmNew.submit();
    });

    btnEdit.on('click', function()
    {
        frmEdit.submit();
    });

    uplLink.change(function()
    {
        var input = document.getElementById('link');;

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                link = reader.result;
                $('#imgLink').attr('src', link);
            }
        }
    });

    frmNew.submit(function(e)
    {
        e.preventDefault();
        var data = frmNew.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&link=' + link,
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
            data: data + '&link=' + link,
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
