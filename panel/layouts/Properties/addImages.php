<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}properties-images.min.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("properties");
                submenu_view("all");
            });
        </script>'
    ]
]);
?>
<header class="topbar">
    %{topbar}%
</header>
<section class="sidebar">
    %{sidebar}%
</section>
<section class="main-content">
    <div class="property-images">
        <div class="add">
            <input id="addImage" type="file" class="hidden" />
            {$btnAddImage}
        </div>
        <div class="add" style="display:none">
			<p class="error" data-load="addImage"></p>
		</div>
        {$imagesList}
        <div class="clear"></div>
    </div>
</section>
