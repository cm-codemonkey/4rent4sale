<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'css' => [
		'{$path.plugins}owl-carousel/owl.carousel.min.css',
		'{$path.plugins}owl-carousel/owl.theme.default.min.css'
	],
    'js' => [
        '{$path.js}index.js',
		'{$path.plugins}owl-carousel/owl.carousel.min.js',
	],
    'other' => [
		'<script defer type="text/javascript">
			$(document).ready(function()
            {
                $("#properties-carousel").owlCarousel(
                {
                    items:1,
                    autoplay:false,
                    autoplayTimeout:6000,
                    loop:true
                });

				$("#comments-carousel").owlCarousel(
                {
                    items:1,
                    autoplay:true,
                    autoplayTimeout:15000,
                    loop:true
				});

                var owl = $(".owl-carousel");
                    owl.owlCarousel();

                $("#left").on("click", function()
                {
                    owl.trigger("prev.owl.carousel");
                });

                $("#right").on("click", function()
                {
                    owl.trigger("next.owl.carousel");
                });

                $("#carousel-button-left,#comments-carousel-button-left").on("click", function()
                {
                    owl.trigger("prev.owl.carousel");
                });

                $("#carousel-button-right,#comments-carousel-button-right").on("click", function()
                {
                    owl.trigger("next.owl.carousel");
                });
			});
		</script>'
	]
]);
?>
<header class="main-header">
    %{header}%
</header>

{$imagesList}

<section class="discover_all">
    <h4>{$lang.index_like_properties}</h4>
    <a href="/properties" class="btn">{$lang.btn_discover_all}</a>
</section>

<section id="choose_us">
    <div class="container">
        <h4>{$lang.index_why_choose_us}</h4>
        <div class="span2">
            <figure>
              <img src="{$path.images}icon-1.png" alt="" />
              <p>{$lang.index_why_choose_us_1}</p>
            </figure>
        </div>
        <div class="span2">
            <figure>
              <img src="{$path.images}icon-2.png" alt="" />
              <p>{$lang.index_why_choose_us_2}</p>
            </figure>
        </div>
        <div class="span2">
          <figure>
              <img src="{$path.images}icon-3.png" alt="" />
              <p>{$lang.index_why_choose_us_3}</p>
          </figure>
        </div>
        <div class="span2">
          <figure>
              <img src="{$path.images}icon-4.png" alt="" />
              <p>{$lang.index_why_choose_us_4}</p>
          </figure>
        </div>
        <div class="span2">
          <figure>
              <img src="{$path.images}icon-5.png" alt="" />
              <p>{$lang.index_why_choose_us_5}</p>
          </figure>
        </div>
        <div class="clear"></div>
    </div>
</section>

<section id="discovery" data-image-src="{$discovery_background}"> </section>

<section id="blog-home" class="blog">
    <div class="container">
        <div class="row">
          {$entriesList}
        </div>
    </div>
</section>

<!-- <section class="comments-carousel">
    <div class="container">
        <div id="comments-carousel" class="owl-carousel">
            {$commentsList}
        </div>
    </div>
	<a href="" id="carousel-button-left"><i class="material-icons">keyboard_arrow_left</i></a>
	<a href="" id="carousel-button-right"><i class="material-icons">keyboard_arrow_right</i></a>
</section> -->

<section class="subscribe">
    <form name="subscribe">
        <p>{$lang.subscribe}</p>
        <input type="text" name="name" placeholder="{$lang.subscribe_name_placeholder}">
        <input type="email" name="email" placeholder="{$lang.subscribe_placeholder}">
        <a href="" data-action="subscribe">{$lang.subscribe}</a>
    </form>
    <div class="error">
        <p class="error"></p>
    </div>
</section>
