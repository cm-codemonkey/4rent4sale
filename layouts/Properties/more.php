<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts.more
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create layout properties/more
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '{$path.plugins}fancybox/source/jquery.fancybox.css']);
$this->dependencies->add(['js', '{$path.js}pages/properties.min.js']);
$this->dependencies->add(['js', '{$path.plugins}fancybox/source/jquery.fancybox.js']);
$this->dependencies->add(['js', '{$path.plugins}fancybox/source/jquery.fancybox.pack.js']);
$this->dependencies->add(['other', '
    <script type="text/javascript">
        $(".fancybox-thumb").fancybox({
            prevEffect	: "none",
            nextEffect	: "none",
            padding : 0,
            helpers	:
            {
                thumbs	:
                {
                    width	: 50,
                    height	: 50
                }
            }
       });

        $(".fancybox-media").fancybox({
            openEffect  : "elastic",
            closeEffect : "none",
            helpers :
            {
                media : {}
            }
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCea8Q6BtcTHwY3YFCiB0EoHE5KnsMUE&callback=initMap"></script>
    <script type="text/javascript">

        var myLatLng = {lat: {$lat}, lng: {$lng}};

        function initMap() {

            var map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 14,
                scrollwheel: false
            });

            var contentString = "<div>"+
                "<h4>{$name}</h4>"+
                "</div>";

            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                title: "{$location}",
                animation: google.maps.Animation.DROP,
                map: map
            });

            marker.addListener("click", function() {
                infowindow.open(map, marker);
            });

            infowindow.open(map, marker);
        }
    </script>
']);

?>

%{header}%
<section class="home white">
    <figure>
        <img src="{$path.images}properties/{$background}" alt="Property cover">
    </figure>
    <aside>
        <h1>{$name}</h1>
    </aside>
</section>
<section class="datasheet">
    <div class="container">
        <aside>
            <div class="item">
                <span><i class="material-icons">location_on</i>{$location}</span>
                <span><i class="material-icons">category</i>{$category}</span>
                {$featured}
                <div class="clear"></div>
            </div>
            <div class="item">
                <p>{$description}</p>
            </div>
            {$lst_details}
            {$lst_gallery_images}
            <div id="map"></div>
        </aside>
        <form name="ask">
            <h4>{$lang.ask-information}</h4>
            <fieldset class="input-group">
                <p class="required-fields"><span class="required-field">*</span> {$lang.required_fields}</p>
            </fieldset>
            <fieldset class="input-group">
                <label>
                    <span><span class="required-field">*</span>{$lang.fullname}</span>
                    <input type="text" name="fullname">
                </label>
            </fieldset>
            <fieldset class="input-group">
                <label>
                    <span><span class="required-field">*</span>{$lang.email}</span>
                    <input type="text" name="email">
                </label>
            </fieldset>
            <fieldset class="input-group">
                <label>
                    <span>{$lang.phone} ({$lang.optional})</span>
                    <input type="text" name="phone">
                </label>
            </fieldset>
            <fieldset class="input-group">
                <label>
                    <span>{$lang.message} ({$lang.optional})</span>
                    <textarea name="message"></textarea>
                </label>
            </fieldset>
            <a href="" class="btn btn-colored" data-action="ask">{$lang.ask}</a>
        </form>
        <form name="send">
            <h4>{$lang.send-datasheet-information}</h4>
            <fieldset class="input-group">
                <p class="required-fields"><span class="required-field">*</span> {$lang.required_fields}</p>
            </fieldset>
            <fieldset class="input-group">
                <label>
                    <span><span class="required-field">*</span>{$lang.email}</span>
                    <input type="text" name="email">
                </label>
            </fieldset>
            <a href="" class="btn btn-colored" data-action="send">{$lang.send}</a>
        </form>
        <div class="clear"></div>
    </div>
</section>
