'use strict';

/**
* @package valkyrie.cms.js.pages
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(document).ready(function ()
{
    var myDocument = $(this);

    /* Users table
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
            [1,'asc']
        ],
        'searching': true,
        'info': true,
        'paging': true,
        'language': {
            'url': '/cms/languages/es_datatables.json'
        }
    });

    /* Modal to create or edit user
    ------------------------------------------------------------------------------- */
    $('[data-button-modal="users"]').on('click', function()
    {
        $('[data-modal="users"]').find('form')[0].reset();
    });

    $('[data-modal="users"]').modal().onSuccess(function()
    {
        $('form[name="users"]').submit();
    });

    $('[data-modal="users"]').modal().onCancel(function()
    {
        $('input[name="fullname"]').attr('disabled', false);
        $('input[name="email"]').attr('disabled', false);
        $('input[name="username"]').attr('disabled', false);
        $('input[name="password"]').attr('disabled', false);
        $('input[data-action="show"]').attr('disabled', false);
        $('select[name="level"]').attr('disabled', false);
        $('a[data-select]').attr('disabled', false);
        $('input[name="avatar"]').attr('disabled', false);
        $('div[data-preview]').attr('style', 'background-image: url(images/empty.png)');
        $('select[name="status"]').attr('disabled', false);

        $('[data-modal="users"]').find('header > h4').html('Nuevo');
        $('[data-modal="users"]').find('form').attr('data-submit-action', 'new');
        $('[data-modal="users"]').find('form > .input-group > div').removeClass('error');
        $('[data-modal="users"]').find('form > .input-group > label').removeClass('error');
        $('[data-modal="users"]').find('form > .input-group > p.error').remove();
        $('[data-modal="users"]').find('form')[0].reset();
    });

    /* Show or hide password
    ------------------------------------------------------------------------------- */
    $('[data-action="show"]').on('change', function()
    {
        if ($('[data-action="show"]').is(':checked') == true)
            $('input[name="password"]').attr('type', 'text');
        else
            $('input[name="password"]').attr('type', 'password');
    });

    /* Create or edit user
    ------------------------------------------------------------------------------- */
    var idUser;

    $('form[name="users"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var action = self.data('submit-action');
        var data = new FormData(this);

        data.append('action', action);
        data.append('id_user', idUser);

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

    /* Get user to edit
    ------------------------------------------------------------------------------- */
    $('[data-action="get_user_to_edit"]').on('click', function()
    {
        idUser = $(this).data('id');
        var restore = $(this).data('restore');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id_user=' + idUser + '&action=get',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('input[name="fullname"]').val(response.data.fullname);
                    $('input[name="email"]').val(response.data.email);
                    $('input[name="username"]').val(response.data.username);
                    $('select[name="level"]').val(response.data.id_user_level);

                    if (response.data.avatar)
                        $('div[data-preview]').attr('style', 'background-image: url(../images/users/' + response.data.avatar + ')');
                    else
                        $('div[data-preview]').attr('style', 'background-image: url(images/empty.png)');

                    $('select[name="status"]').val(response.data.status);

                    if (restore != null)
                    {
                        $('input[name="password"]').val('');

                        $('input[name="fullname"]').attr('disabled', true);
                        $('input[name="email"]').attr('disabled', true);
                        $('input[name="username"]').attr('disabled', true);
                        $('input[name="password"]').attr('disabled', false);
                        $('input[data-action="show"]').attr('disabled', false);
                        $('select[name="level"]').attr('disabled', true);
                        $('a[data-select]').attr('disabled', true);
                        $('input[name="avatar"]').attr('disabled', true);
                        $('select[name="status"]').attr('disabled', true);

                        $('[data-modal="users"] header > h4').html('Restablecer contraseña');
                        $('[data-modal="users"] form').attr('data-submit-action', 'restore');
                    }
                    else
                    {
                        $('input[name="password"]').val(response.data.password);

                        $('input[name="fullname"]').attr('disabled', false);
                        $('input[name="email"]').attr('disabled', false);
                        $('input[name="username"]').attr('disabled', false);
                        $('input[name="password"]').attr('disabled', true);
                        $('input[data-action="show"]').attr('disabled', true);
                        $('select[name="level"]').attr('disabled', false);
                        $('a[data-select]').attr('disabled', false);
                        $('input[name="avatar"]').attr('disabled', false);
                        $('select[name="status"]').attr('disabled', false);

                        $('[data-modal="users"] header > h4').html('Editar');
                        $('[data-modal="users"] form').attr('data-submit-action', 'edit');
                    }

                    $('[data-modal="users"]').toggleClass('view').animate({scrollTop: 0}, 0);
                }
                else
                    alert(response.message);
            }
        });
    });

    /* Deactivate or activate users selection
    ------------------------------------------------------------------------------- */
    multipleSelect($('[data-action="deactivate"]'), 'index.php?c=users&m=index', function(response)
    {
        if (response.status == 'success')
        {
            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
            location.reload();
        }
        else
            alert(response.message);
    }, ['action', 'deactivate']);

    /* Delete users selection
    ------------------------------------------------------------------------------- */
    multipleSelect($('[data-action="delete_user"]'), 'index.php?c=users&m=index', function(response)
    {
        if (response.status == 'success')
        {
            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
            location.reload();
        }
        else
            alert(response.message);
    }, ['action', 'delete']);
});
