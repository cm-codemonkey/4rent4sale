'use strict';

/**
* @package valkyrie.pages.js
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create properties.js
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(document).ready(function()
{
    var myDocument = $(this);

    /*
    ------------------------------------------------------------------------------- */
    $('select[name="price"]').on('change', function()
    {
        if ($('select[name="price"]').val() == 'all')
        {
            $('input[name="price_from"]').parent().parent().addClass('hidden');
            $('input[name="price_to"]').parent().parent().addClass('hidden');
        }
        else if ($('select[name="price"]').val() == 'rank')
        {
            $('input[name="price_from"]').parent().parent().removeClass('hidden');
            $('input[name="price_to"]').parent().parent().removeClass('hidden');
        }
    });

    /* Filter
    ------------------------------------------------------------------------------- */
    $('[data-action="filter"]').on('click', function()
    {
        $('form[name="filter"]').submit();
    });

    $('form[name="filter"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var data = self.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    $('#filter').html(response.html);
                });
            }
        });
    });

    /* Sending ask email
    ------------------------------------------------------------------------------- */
    $('[data-action="ask"]').on('click', function()
    {
        $('form[name="ask"]').submit();
    });

    $('form[name="ask"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var data = self.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&action=ask',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    alert(response.message);
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                });
            }
        });
    });

    /* Sending datasheet by email
    ------------------------------------------------------------------------------- */
    $('[data-action="send"]').on('click', function()
    {
        $('form[name="send"]').submit();
    });

    $('form[name="send"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var data = self.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&action=send',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    alert(response.message);
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                });
            }
        });
    });
});
