<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '/panel/{$path.js}test.js'
    ]
]);
?>

<form id="galleryForm" enctype="multipart/form-data">
    <input type="file" name="gallery[]" accept="image/*" multiple/>
    <button type="submit">Enviar</button>
</form>
