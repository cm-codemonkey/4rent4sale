"use strict";

$( document ).ready(function ()
{
    $('[name="search"]').on('change', function()
    {
        var data = $(this).val();
        var target = $(this).parents('div.container').find('section.list > article');

        $.each(target, function(key, value)
        {
            if (data.length > 0)
            {
                var string_1 = data.toLowerCase();
                var string_2 = value.innerHTML.toLowerCase();
                var result = string_2.indexOf(string_1);

                if (result > 0)
                    value.className = 'span6';
                else if (result <= 0)
                    value.className = 'span6 hidden';
            }
            else
                value.className = 'span6';
        });
    });

    var filter = '';
    var rooms_number = '';
    var locations = '';
    var price = '';
    var price_from = '';
    var price_to = '';
    var type = '';
    var categories = '';

    $('input[name="filter"]').change(function ()
    {
        var self = $(this);
        var val = self.val();

        if( self.is(':checked') )
            filter = val;
    });

    $('[name="rooms_number"]').change(function ()
    {
        var self = $(this);

        rooms_number = self.val();
    });

    $('input[name="location"]').change(function ()
    {
        var self = $(this);
        var val = self.val();

        if( self.is(':checked') )
            locations = val + ',' + locations;
        else
            locations = locations.replace(val + ',', '');
    });

    $('input[name="price_from"]').change(function ()
    {
        var self = $(this);

        price_from = self.val();
    });

    $('input[name="price_to"]').change(function ()
    {
        var self = $(this);

        price_to = self.val();
    });

    $('input[name="type"]').change(function ()
    {
        var self = $(this);

        type = self.val();
    });

    $('input[name="category"]').change(function ()
    {
        var self = $(this);
        var val = self.val();

        if( self.is(':checked') )
            categories = val + ',' + categories;
        else
            categories = categories.replace(val + ',', '');
    });

    $('form[name="form-filters"]').submit(function ( event )
    {
        event.preventDefault();

        var self = $(this);

        if (filter)
            filter = 'filter='+ filter;
        else
            filter = '';

        if (rooms_number)
            rooms_number = '&rooms_number='+ rooms_number;
        else
            rooms_number = '';

        if (locations)
        {
            locations = '&locations='+ locations;
            locations = locations.substring(0,locations.length - 1);
        }
        else
            locations = '';

        if (price_to || price_from)
            price = '&price='+ price_from +'-'+ price_to;
        else
            price = '';

        if (categories)
        {
            categories = '&categories='+ categories;
            categories = categories.substring(0,categories.length - 1);
        }
        else
            categories = '';

        if (type)
            type = '&type='+ type;
        else
            type = '';

        var data = filter + rooms_number + locations + price + categories + type;

        document.location = '/properties?' + data;
    });

    /*
    /* ----------------------------------------------------------------------- */
    var item            = $('[data-order="item"]');
    var btnOrderList    = $('[data-order="list"]');
    var btnOrderModule  = $('[data-order="module"]');

    btnOrderList.on('click', function()
    {
        item.addClass('list');
        btnOrderList.addClass('view');
        btnOrderModule.removeClass('view');
    });

    btnOrderModule.on('click', function()
    {
        item.removeClass('list');
        btnOrderList.removeClass('view');
        btnOrderModule.addClass('view');
    });

    /*
    /* ----------------------------------------------------------------------- */
    var main            = $('div.main');
    var ask             = $('div.ask');
    var btnOpenAsk      = $('[data-action="openAsk"]');
    var btnCloseAsk     = $('[data-action="closeAsk"]');

    btnOpenAsk.on('click', function()
    {
        main.toggleClass('close');
        ask.toggleClass('view');
    });

    btnCloseAsk.on('click', function()
    {
        main.toggleClass('close');
        ask.toggleClass('view');
    });

    /*
    /* ----------------------------------------------------------------------- */

    var mdlSendEmail = $('[data-modal-target-destination="sendEmail"]');
    var btnSendEmail = mdlSendEmail.find('[data-action-modal="sendEmail"]');
    var frmSendEmail = mdlSendEmail.find('form[name="sendEmail"]');

    btnSendEmail.on('click', function()
    {
        frmSendEmail.submit();
    });

    frmSendEmail.submit(function(e)
    {
        e.preventDefault();
        var data = frmSendEmail.serialize();


        $.ajax({
            url: '',
            type: "POST",
            data: data + '&action=sendInformationProperty',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success')
                {
                    $('.error > p').html('<img src="images/gif-load.gif" style="width: 25px;"/>');
                    $('.error').addClass('view');
                    btnSendEmail.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('.error > p').html(response.message);
                    $('.error').addClass('view');
                }
            }
        });
    });

    /*
    /* ----------------------------------------------------------------------- */
    var btnAsk = $('[data-action="ask"]');
    var frmAsk = $('form[name="ask"]');

    btnAsk.on('click', function()
    {
        frmAsk.submit();
    });

    frmAsk.submit(function(e)
    {
        e.preventDefault();
        var data = frmAsk.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&action=interestedProperty',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    if (response.path == 'reload')
                    {
                        $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                        $('p.error').html(response.message);
                        $('p.error').parent().show();
                        btnAsk.parent().remove();
                    }
                    else
                        window.location.href = response.path;
                }

                if (response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });
});
