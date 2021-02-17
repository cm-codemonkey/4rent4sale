'use strict';

$(document).ready(function()
{
    var link    = '';

    /* load image
    /* ----------------------------------------------------------------------- */
    var uplLink = $('#link');

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

        var description = tinymce.get('description');
        var description_en = tinymce.get('description_en');

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&description='+ encodeURIComponent(description.getContent()) + '&description_en='+ encodeURIComponent(description_en.getContent()) +'&link=' + link,
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

        var description = tinymce.get('description');
        var description_en = tinymce.get('description_en');

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&description='+ encodeURIComponent(description.getContent()) + '&description_en='+ encodeURIComponent(description_en.getContent()) + '&link=' + link,
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
    var urlDelete = 'index.php?c=blog&m=deleteEntries';
    var btnDelete = $('[data-action-modal="delete"]');

    multipleSelect(btnDelete, urlDelete, function(response)
    {
        if(response.status == 'success')
        {
            btnDelete.attr('disabled', '');
            location.reload();
        }
    });

    /* obtener articulo del blog para editar su popularidad o destacado
    /*----------------------------------------------------------------*/
    var id;
    var btnGetPopularToEdit = $('[data-action="getPopularToEdit"]');

    btnGetPopularToEdit.on('click', function()
    {
        id = $(this).data('id');

        $.ajax({
            url: 'index.php?c=blog&m=getPopularToEdit&p=' + id,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('input[name="popular_blog"]').val(response.data.popular_blog);
                    $('input[name="popular_home"]').val(response.data.popular_home);
                    $('div[data-modal-target-destination="editPopular"]').toggleClass('view');
                }
                else if (response.status == 'error')
                    alert(response.message);
                else
                    location.reload();
            }
        });
    });

    /* editar popularidad o destacado de una propiedad
    /*----------------------------------------------------------------*/
    var btnEditPopular = $('[data-action="editPopular"]');
    var frmEditPopular = $('form[name="editPopular"]');

    btnEditPopular.on('click', function()
    {
        frmEditPopular.submit();
    });

    frmEditPopular.on('submit', function(e)
    {
        e.preventDefault();

        var data = frmEditPopular.serialize();

        $.ajax({
            url: 'index.php?c=blog&m=editPopular&p=' + id,
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
