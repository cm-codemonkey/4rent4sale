'use strict';

/**
* @package valkyrie.js
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-framework
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(window).on('beforeunload ajaxStart', function()
{
    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
});

$(window).on('ajaxStop', function()
{
    $('body').find('[data-loader-ajax]').remove();
});

$(document).ready(function()
{
    var myDocument = $(this);

    $('[data-action="open-res-menu"]').on('click', function()
    {
        $('header.sidebar').toggleClass('open');
    });

    $('[data-image-src]').each(function () {

        var a = $(this);
        var b = a.data('image-src');

        if (b)
        {
            a.css('background-image', 'url("'+b+'")');
        }
    });

    $('div.uploader').each(function ()
    {
        var self = $(this);
        var button = self.find('a[data-select]');
        var input = self.find('input[data-preview]');

        button.on('click', function ()
        {
            input.click();
        });

        input.change(function ()
        {
            var id = $(this).attr('id');
            var target = $(this).attr('data-preview');
            var input  = document.getElementById(id);

            if ( window.FileReader )
            {
                var file    = input.files[0];
                var reader  = new FileReader();

                if ( file && file.type.match('image.*') )
                    reader.readAsDataURL( file );

                reader.onloadend = function ()
                {
                    self.find('div.preview[data-preview="'+ target +'"]').attr('style', 'background-image: url('+ reader.result +')');
                }
            }
        });
    });
});

function navScrollDown($target, $class, $height)
{
    var nav = {
        initialize: function()
        {
            $(document).each(function() { nav.scroller() });
            $(document).on("scroll", function() { nav.scroller() });
        },
        scroller: function()
        {
            if ($(document).scrollTop() > $height)
                $($target).addClass($class);
            else
                $($target).removeClass($class);
        }
    }

    nav.initialize();
}

function checkValidateFormAjax(form, response, callback)
{
    var a = form.find('[name]').parents('.input-group');
        a.find('label').removeClass('error');
        a.find('> p.pre-error').removeClass('error').hide();
        a.find('> p.error').remove();

    if (response.status == 'success')
        callback();
    else
    {
        if (response.labels && response.labels.length > 0)
        {
            $.each(response.labels, function (i, label)
            {
                var b = form.find('[name="'+ label[0] +'"]').parents('.input-group');
                    b.append('<p class="error">'+ label[1] +'</p>');
                    b.find('label').addClass('error');
            });

            form.find('input[name="'+ response.labels[0][0] +'"]').focus();
        }
    }
}

function multipleSelect( button, url, callback, parameter )
{
    var selected = [];

    $("[data-check-all]").change(function ()
    {
        var self = $(this);
        var check = $("input[data-check]:checkbox");

        if( !check.is(':checked') )
        {
            check.prop('checked', true);
            self.prop('checked', true);

            $("[data-check]").each(function ()
            {
                var value = $(this).val();
                if( isNaN(value) == false )
                    selected.push(value);
            });
        }
        else
        {
            check.prop('checked', false);
            self.prop('checked', false);

            $("[data-check]").each(function ()
            {
                var removeItem = $(this).val();
                selected = jQuery.grep(selected, function ( value )
                {
                    return value != removeItem;
                });
            });
        }
    });

    $('[data-check]').change(function ()
    {
        var self = $(this);

        if ( !self.is(':checked') )
        {
            $("[data-check-all]").prop('checked', false);

            var removeItem = self.val();
            selected = jQuery.grep(selected, function ( value )
            {
                return value != removeItem;
            });
        }
        else
        {
            var value = $(this).val();
            if( isNaN(value) == false )
                selected.push(value);
        }
    });

    button.on('click', function ()
    {
        var jsonString = JSON.stringify(selected);

        if (parameter)
            parameter = '&' + parameter [0] + '=' + parameter[1];
        else
            parameter = '';

        $.ajax({
            url: url,
            type: 'POST',
            data: 'data=' + jsonString + parameter,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function( response )
            {
                if ( callback != null )
                    callback(response);
            }
        });
    });
}
