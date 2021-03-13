'use strict';

/**
* @package valkyrie.cms.js.pages
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 09, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(document).ready(function()
{
    var myDocument = $(this);

    /* New slideshow image
    ------------------------------------------------------------------------------- */
    $('[data-action="new"]').on('click', function()
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

    /* Delete slideshow image
    ------------------------------------------------------------------------------- */
    var cicle;

    $('[data-action="delete"]').on('click', function()
    {
        cicle = $(this).data('cicle');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'cicle=' + cicle + '&action=delete',
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

    /* Modal to edit Titles
    ------------------------------------------------------------------------------- */
    $('[data-modal="titles"]').modal().onSuccess(function()
    {
        $('form[name="titles"]').submit();
    });

    /* Edit Titles
    ------------------------------------------------------------------------------- */
    $('form[name="titles"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var data = self.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&action=titles',
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

    /* Edit background properties
    ------------------------------------------------------------------------------- */
    $('[data-action="new_background_1"]').on('click', function()
    {
        $('#file_background_1').click();
    });

    $('#file_background_1').change(function()
    {
        var image = '';
        var input = document.getElementById('file_background_1');

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
                    data: 'background=properties' + '&image=' + image + '&action=edit',
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

    /* Edit background tipi magazine
    ------------------------------------------------------------------------------- */
    $('[data-action="new_background_2"]').on('click', function()
    {
        $('#file_background_2').click();
    });

    $('#file_background_2').change(function()
    {
        var image = '';
        var input = document.getElementById('file_background_2');

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
                    data: 'background=magazine' + '&image=' + image + '&action=edit',
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

    /* Edit background contact us
    ------------------------------------------------------------------------------- */
    $('[data-action="new_background_3"]').on('click', function()
    {
        $('#file_background_3').click();
    });

    $('#file_background_3').change(function()
    {
        var image = '';
        var input = document.getElementById('file_background_3');

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
                    data: 'background=contact_us' + '&image=' + image + '&action=edit',
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

    /* Edit background subscribe
    ------------------------------------------------------------------------------- */
    $('[data-action="new_background_4"]').on('click', function()
    {
        $('#file_background_4').click();
    });

    $('#file_background_4').change(function()
    {
        var image = '';
        var input = document.getElementById('file_background_4');

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
                    data: 'background=subscribe' + '&image=' + image + '&action=edit',
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
});
