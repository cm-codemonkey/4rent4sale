'use strict';

/**
* @package valkyrie.cms.js
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 03 - 19, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Módulo de revista.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(document).ready(function()
{
    var myDocument = $(this);

    /* Magazine articles table
    ------------------------------------------------------------------------------- */
    myDocument.find('table').DataTable({
        dom: 'Bfrtip',
        buttons: [

        ],
        'columnDefs': [
            {
                'orderable': true,
                'targets': '_all'
            },
            {
                'className': 'text-left',
                'targets': '_all'
            }
        ],
        'order': [
            [5, 'asc']
        ],
        'searching': true,
        'info': true,
        'paging': true,
        'language': {
            'url': '/cms/languages/es_datatables.json'
        }
    });

    /* Modal to create or edit magazine article
    ------------------------------------------------------------------------------- */
    $('[data-modal="magazine_articles"]').modal().onSuccess(function()
    {
        $('form[name="magazine_articles"]').submit();
    });

    $('[data-modal="magazine_articles"]').modal().onCancel(function()
    {
        $('div[data-preview]').attr('style', 'background-image: url(../images/empty.png)');

        $('[data-modal="magazine_articles"]').find('header > h4').html('Nuevo');
        $('[data-modal="magazine_articles"]').find('form').attr('data-submit-action', 'new');
        $('[data-modal="magazine_articles"]').find('form > .input-group > div').removeClass('error');
        $('[data-modal="magazine_articles"]').find('form > .input-group > label').removeClass('error');
        $('[data-modal="magazine_articles"]').find('form > .input-group > p.error').remove();
        $('[data-modal="magazine_articles"]').find('form')[0].reset();
    });

    /* Create or edit magazine article
    ------------------------------------------------------------------------------- */
    var idMagazineArticle;

    $('form[name="magazine_articles"]').on('submit', function(e)
    {
        e.preventDefault();

        tinyMCE.triggerSave();

        var self = $(this);
        var action = self.data('submit-action');
        var data = new FormData(this);
        data.append('action', action);
        data.append('id_magazine_article', idMagazineArticle);

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                });
            }
        });
    });

    /* Get magazine article to edit
    ------------------------------------------------------------------------------- */
    $('[data-action="get_magazine_article_to_edit"]').on('click', function()
    {
        idMagazineArticle = $(this).data('id');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id_magazine_article=' + idMagazineArticle + '&action=get',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    var name = eval('(' + response.data.name + ')');

                    $('input[name="name_es"]').val(name.es);
                    $('input[name="name_en"]').val(name.en);

                    var description = eval('(' + response.data.description + ')');

                    tinymce.get('description_es').setContent(description.es);
					tinymce.get('description_en').setContent(description.en);

                    $('div[data-preview]').attr('style', 'background-image: url(../images/magazine/' + response.data.background + ')');
                    $('input[name="priority"]').val(response.data.priority);

                    $('[data-modal="magazine_articles"] header > h4').html('Editar');
                    $('[data-modal="magazine_articles"] form').attr('data-submit-action', 'edit');
                    $('[data-modal="magazine_articles"]').toggleClass('view').animate({scrollTop: 0}, 0);
                }
                else
                    alert(response.message);
            }
        });
    });

    /* Delete magazine articles selection
    ------------------------------------------------------------------------------- */
    multipleSelect($('[data-action="delete_magazine_articles"]'), 'index.php?c=magazine&m=index', function(response)
    {
        if (response.status == 'success')
        {
            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
            location.reload();
        }
        else
            alert(response.message);
    }, [
        'action',
        'delete'
    ]);

    /* New gallery image
    ------------------------------------------------------------------------------- */
    $('[data-action="new_gallery_image"]').on('click', function()
    {
        $('#file').click();
    });

    $('#file').change(function()
    {
        var image = '';
        var input = document.getElementById('file');

        if(window.FileReader)
        {
            var file	= input.files[0];
            var reader	= new FileReader();

            if(file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function()
            {
                image = reader.result;

                $.ajax({
                    url: '',
                    type: 'POST',
                    data: 'image=' + image + '&action=new',
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    success: function(response)
                    {
                        if (response.status == 'success')
                        {
                            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                            location.reload();
                        }
                        else
                            alert(response.message);
                    }
                });
            }
        }
    });

    /* Delete gallery image
    ------------------------------------------------------------------------------- */
    var idGalleryImage;

    $('[data-action="delete_gallery_image"]').on('click', function()
    {
        idGalleryImage = $(this).data('id');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id_gallery_image=' + idGalleryImage + '&action=delete',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success')
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                }
                else
                    alert(response.message);
            }
        });
    });
});
