'use strict';

$(document).ready(function()
{
    // modals
    var mdlNew = $('[data-modal-target-destination="new"]');

    // buttons
    // var editor  = CKEDITOR.replace('description');
    var btnNew      = mdlNew.find('[data-action-modal="new"]');
    var btnEdit     = $('[data-action="edit"]');
    var btnPwd      = $('[data-action="pwd"]');
    var btnDelete   = $('[data-modal-target-destination="delete"]').find('[data-action-modal="delete"]');

    // forms
    var frmNew  = mdlNew.find('form[name="new"]');
    var frmEdit = $('form[name="edit"]');
    var frmPwd  = $('form[name="pwd"]');

    // urls
    var urlDelete = 'index.php?c=users&m=delete';

    // onclick actions
    btnNew.on('click', function()
    {
        frmNew.submit();
    });

    btnEdit.on('click', function()
    {
        frmEdit.submit();
    });

    btnPwd.on('click', function()
    {
        frmPwd.submit();
    });

    // new method
    frmNew.submit(function(e)
    {
        e.preventDefault();
        var data = frmNew.serialize();

        $.ajax({
            url: 'index.php?c=users&m=add',
            type: "POST",
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

    // edit method
    frmEdit.submit(function(e)
    {
        e.preventDefault();
        var data = frmEdit.serialize();

        $.ajax({
            url: '',
            type: "POST",
            data: data + '&description=' + editor.getData(),
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

    // reset password method
    frmPwd.submit(function(e)
    {
        e.preventDefault();
        var data = frmPwd.serialize();

        $.ajax({
            url: 'index.php?c=users&m=editPassword',
            type: "POST",
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
                    btnPwd.parent().remove();
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

    // delete method
    multipleSelect(btnDelete, urlDelete, function(response)
    {
        if(response.status == 'success')
        {
            btnDelete.attr('disabled', '');
            location.reload();
        }
    });
});
