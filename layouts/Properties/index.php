<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'css' => [
        '{$path.plugins}chosen-select/chosen.css" type="text/css'
    ],
    'js' => [
        '{$path.js}properties.js',
        '{$path.plugins}chosen-select/chosen.jquery.js'
    ],
    'other' => [
        '<script>$(function() { $(".chosen-select").chosen(); });</script>'
    ]
]);
?>
<header class="main-header">
    %{header}%
</header>
<section class="properties-background" data-image-src="{$background_property}">
    <div class="content">
        <h1>{$title}</h1>
        <h2>{$subtitle}</h2>
    </div>
</section>

<section id="properties">
    <div class="container">
        <div class="buttons-order">
            <a href="/properties">{$lang.btn_view_all}</a>
            <a href="" data-order="list"><i class="material-icons">view_list</i></a>
            <a href="" class="view" data-order="module"><i class="material-icons">view_module</i></a>
        </div>
    </div>
    <div class="container">
        <aside class="filter">
            <div class="group">
                <h6>{$lang.search}</h6>
                <select name="search" class="chosen-select">
                    <option value="">{$lang.all}</option>
                    {$optProyects}
                </select>
            </div>
            <form name="form-filters">
                <div class="group">
                    <h6>{$lang.properties_filter_by}:</h6>
                    <div class="hidden">
                        <h6>{$lang.properties_filter_by_price_low_height}</h6>
                        <label><input type="radio" name="filter" value="low_price"/> {$lang.properties_filter_by_price_low}</label>
                        <label><input type="radio" name="filter" value="high_price"/> {$lang.properties_filter_by_price_height}</label>
                    </div>
                </div>
                <!-- <div class="group">
                    <h6>{$lang.rooms_number}</h6>
                    <input type="number" name="rooms_number" class="rooms_number">
                </div> -->
                <div class="group">
                    <h6>{$lang.properties_filter_location}</h6>
                    {$filter_locations}
                </div>
                <div class="group">
                    <h6>{$lang.properties_filter_by_price}</h6>
                    <input type="number" name="price_from" placeholder="$" />
                    <h6 class="text-center">{$lang.properties_filter_by_price_to}</h6>
                    <input type="number" name="price_to" placeholder="$" />
                    <!--<label><input type="radio" name="price" value="1000-2000"/> $ 1,000.00 - $ 2,000.00</label>
                    <label><input type="radio" name="price" value="2000-3000"/> $ 2,000.00 - $ 3,000.00</label>
                    <label><input type="radio" name="price" value="3000-4000"/> $ 3,000.00 - $ 4,000.00</label>
                    <label><input type="radio" name="price" value="4000-6000"/> $ 4,000.00 - $ 6,000.00</label>
                    <label><input type="radio" name="price" value="6000-+"/> $ 6,000.00 - Ininity</label>-->
                </div>
                <!-- <div class="group">
                    <h6>{$lang.properties_filter_category}</h6>
                    {$filter_categories}
                </div> -->
                <!-- <div class="group">
                    <h6>{$lang.properties_filter_category}</h6>
                    <label><input type="radio" name="subcategory" value="presale"/> {$lang.presale}</label>
                    <label><input type="radio" name="subcategory" value="resale"/> {$lang.resale}</label>
                    <label><input type="radio" name="subcategory" value="lots"/> {$lang.lots}</label>
                </div> -->
                <div class="group">
                    <h6>{$lang.properties_filter_type}</h6>
                    <label><input type="radio" name="type" value="rent"/> {$lang.properties_filter_by_type_rent}</label>
                    <label><input type="radio" name="type" value="sell"/> {$lang.properties_filter_by_type_sell}</label>
                </div>
                <button class="btn md--btn-flat md--btn-raised md--btn-block" type="submit" data-ripple>{$lang.properties_btn_filter}</button>
            </form>
        </aside>
        <section class="list">
            {$items}
        </section>
        <div class="clear"></div>
    </div>
</section>
