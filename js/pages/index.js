'use strict';

/**
* @package valkyrie.pages.js
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Julian Alberto Canche Dzib <Developer jcanche@codemonkey.com.mx>
* @since October 25, 2018 <1.0.0> <@update>
* @summary Se integro la funciónalidad de suscribirse.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

function initMap()
{
    var map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: 20.210948, lng: -87.4726915},
        zoom: 15,
        scrollwheel: false
    });

    $.ajax({
        url: '',
        type: 'POST',
        data: 'action=map',
        processData: false,
        cache: false,
        dataType: 'json',
        success: function(response)
        {
            var properties = response.properties;

            for (var i = 0; i < properties.length; i++)
            {
                var name = eval('(' + properties[i].name + ')');
                var maper = eval('(' + properties[i].map + ')');

                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(maper.lat), lng: parseFloat(maper.lng)},
                    title: name.es,
                    animation: google.maps.Animation.DROP,
                    map: map
                });

                var infoWindow = new google.maps.InfoWindow({
                    content: '<div><h4>' + name.es + '</h4></div>'
                });

                infoWindow.open(map, marker);

                marker.addListener("click", function() {
                    infoWindow.open(map, marker);
                });
            }
        }
    });
}

$(document).ready(function()
{
    var myDocument = $(this);

    /* Slideshow
    ------------------------------------------------------------------------------- */
    myDocument.find('#slideshow').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 4000,
        dots: false,
        nav: false
    });

    /* Filter
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
            data: data + '&action=filter',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('#map').html('');

                    var map = new google.maps.Map(document.getElementById("map"), {
                        center: {lat: 20.210948, lng: -87.4726915},
                        zoom: 15,
                        scrollwheel: false
                    });

                    var properties = response.properties;

                    for (var i = 0; i < properties.length; i++)
                    {
                        var name = eval('(' + properties[i].name + ')');
                        var maper = eval('(' + properties[i].map + ')');

                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(maper.lat), lng: parseFloat(maper.lng)},
                            title: name.es,
                            animation: google.maps.Animation.DROP,
                            map: map
                        });

                        var infoWindow = new google.maps.InfoWindow({
                            content: '<div><h4>' + name.es + '</h4></div>'
                        });

                        infoWindow.open(map, marker);

                        marker.addListener("click", function() {
                            infoWindow.open(map, marker);
                        });
                    }
                }
            }
        });
    });

    /* Subscription
	------------------------------------------------------------------------------- */
    $('[data-action="subscription"]').on('click', function()
    {
        $('form[name="subscription"]').submit();
    });

    $('form[name="subscription"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var data = self.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&action=subscription',
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
