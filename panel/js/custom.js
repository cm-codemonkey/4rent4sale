'use strict';

$( window ).on('beforeunload ajaxStart', function ()
{
    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
});

$( window ).on('ajaxStop', function ()
{
    $('body').find('[data-loader-ajax]').remove();
});

$(document).ready(function()
{
    /* función para abrir el submenu */
    $('.open-submenu > a').click(function(e) {
        var self = $(this).parent(), submenu = self.find('div.submenu');
        submenu.toggleClass('open');
        e.stopPropagation();
    });

    /* función para abrir el swipemenu */
    $('#open-swipemenu').click(function(e) {
        $('#swipemenu').toggleClass('open');
        e.stopPropagation();
    });

    $('[data-action-modal="cancel"]').on('click', function()
    {
        location.reload();
    });
});

function menu_view( target )
{
    $('[data-target="' + target + '"]').each(function()
    {
        $(this).addClass("view");
    });
}

function submenu_view( target )
{
    $('[data-target="' + target + '"]').each(function()
    {
        $(this).addClass("view");
    });
}

function multipleSelect(button, url, callback)
{
    var selected = [];

    $("[data-check-all]").change(function()
    {
        var self = $(this);
        var check = $("input[data-check]:checkbox");

        if(!check.is(':checked'))
        {
            check.prop('checked', true);
            self.prop('checked', true);

            $("[data-check]").each(function()
            {
                var value = $(this).val();
                if(isNaN(value) == false)
                    selected.push(value);
            });
        }
        else
        {
            check.prop('checked', false);
            self.prop('checked', false);

            $("[data-check]").each(function()
            {
                var removeItem = $(this).val();
                selected = jQuery.grep(selected, function(value)
                {
                    return value != removeItem;
                });
            });
        }
    });

    $('[data-check]').change(function()
    {
        var self = $(this);

        if (!self.is(':checked'))
        {
            $("[data-check-all]").prop('checked', false);

            var removeItem = self.val();
            selected = jQuery.grep(selected, function(value)
            {
                return value != removeItem;
            });
        }
        else
        {
            var value = $(this).val();
            if(isNaN(value) == false)
                selected.push(value);
        }
    });

    button.on('click', function()
    {
        var jsonString = JSON.stringify(selected);

        $.ajax({
            url: url,
            type: "POST",
            data: 'data='+jsonString,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(callback != null)
                    callback(response);
            }
        });
    });
}
