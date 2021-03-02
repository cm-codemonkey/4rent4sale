<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}blog.min.js'
    ]
]);
?>
<header class="main-header">
    %{header}%
</header>
<section class="tulum-style-background" data-image-src="{$background_blog}">
    <div class="content">
        <h1>{$title}</h1>
    </div>
</section>
<section class="blog">
    <div class="container">
        {$entries}
    </div>
</section>
