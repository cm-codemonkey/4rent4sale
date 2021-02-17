<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}configurations.js'
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

    <div class="toggles">
        <!-- <div class="toggle">
            <h3>Imagen de portada inicio<i class="material-icons icon">add</i></h3>
            <div class="box">
                <form name ="editCoverHome" class="row">
                    <figure class="file">
                        <img id="imgBackground" src="{$background}" alt="" />
                        <div class="upload">
                            <input id="background" type="file" name="background" accept="image/*">
                        </div>
                    </figure>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_es" type="text" required value="{$title_es}" />
                            <span class="bar-bottom"></span>
                            <label>Título (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_en" type="text" required value="{$title_en}" />
                            <span class="bar-bottom"></span>
                            <label>Título (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_es" type="text" required value="{$subtitle_es}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_en" type="text" required value="{$subtitle_en}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                </form>
                <div class="text-center" style="display: none;">
                    <p class="error"></p>
                </div>
                <div class="text-right">
                    <a class="btn md--button-flat md--btn-colored" data-action="editCoverHome" data-ripple>Guardar</a>
                </div>
            </div>
        </div> -->

        <div class="toggle">
            <h3>Imagen de portada acerca de nosotros<i class="material-icons icon">add</i></h3>
            <div class="box">
                <form name ="editCoverAbout" class="row">
                    <figure class="file">
                        <img id="imgBackgroundAbout" src="{$background_about}" alt="" />
                        <div class="upload">
                            <input id="background_about" type="file" name="background_about" accept="image/*">
                        </div>
                    </figure>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_about_es" type="text" required value="{$title_about_es}" />
                            <span class="bar-bottom"></span>
                            <label>Título (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_about_en" type="text" required value="{$title_about_en}" />
                            <span class="bar-bottom"></span>
                            <label>Título (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_about_es" type="text" required value="{$subtitle_about_es}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_about_en" type="text" required value="{$subtitle_about_en}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                </form>
                <div class="text-center" style="display: none;">
                    <p class="error"></p>
                </div>
                <div class="text-right">
                    <a class="btn md--button-flat md--btn-colored" data-action="editCoverAbout" data-ripple>Guardar</a>
                </div>
            </div>
        </div>

        <!-- <div class="toggle">
            <h3>Imagen de portada propiedades<i class="material-icons icon">add</i></h3>
            <div class="box">
                <form name ="editCoverProperty" class="row">
                    <figure class="file">
                        <img id="imgBackgroundProperty1" src="{$background_property_1}" alt="" />
                        <div class="upload">
                            <input id="background_property_1" type="file" name="background_property_1" accept="image/*">
                        </div>
                    </figure>
                    <figure class="file">
                        <img id="imgBackgroundProperty2" src="{$background_property_2}" alt="" />
                        <div class="upload">
                            <input id="background_property_2" type="file" name="background_property_2" accept="image/*">
                        </div>
                    </figure>
                    <figure class="file">
                        <img id="imgBackgroundProperty3" src="{$background_property_3}" alt="" />
                        <div class="upload">
                            <input id="background_property_3" type="file" name="background_property_3" accept="image/*">
                        </div>
                    </figure>
                    <figure class="file">
                        <img id="imgBackgroundProperty4" src="{$background_property_4}" alt="" />
                        <div class="upload">
                            <input id="background_property_4" type="file" name="background_property_4" accept="image/*">
                        </div>
                    </figure>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_property_es" type="text" required value="{$title_property_es}" />
                            <span class="bar-bottom"></span>
                            <label>Título (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_property_en" type="text" required value="{$title_property_en}" />
                            <span class="bar-bottom"></span>
                            <label>Título (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_property_es" type="text" required value="{$subtitle_property_es}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_property_en" type="text" required value="{$subtitle_property_en}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                </form>
                <div class="text-center" style="display: none;">
                    <p class="error"></p>
                </div>
                <div class="text-right">
                    <a class="btn md--button-flat md--btn-colored" data-action="editCoverProperty" data-ripple>Guardar</a>
                </div>
            </div>
        </div> -->

        <div class="toggle">
            <h3>Imagen de portada proceso de compra<i class="material-icons icon">add</i></h3>
            <div class="box">
                <form name ="editCoverBuy" class="row">
                    <figure class="file">
                        <img id="imgBackgroundBuy" src="{$background_buy}" alt="" />
                        <div class="upload">
                            <input id="background_buy" type="file" name="background_buy" accept="image/*">
                        </div>
                    </figure>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_buy_es" type="text" required value="{$title_buy_es}" />
                            <span class="bar-bottom"></span>
                            <label>Título (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_buy_en" type="text" required value="{$title_buy_en}" />
                            <span class="bar-bottom"></span>
                            <label>Título (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_buy_es" type="text" required value="{$subtitle_buy_es}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_buy_en" type="text" required value="{$subtitle_buy_en}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                </form>
                <div class="text-center" style="display: none;">
                    <p class="error"></p>
                </div>
                <div class="text-right">
                    <a class="btn md--button-flat md--btn-colored" data-action="editCoverBuy" data-ripple>Guardar</a>
                </div>
            </div>
        </div>

        <div class="toggle">
            <h3>Imagen de portada blog<i class="material-icons icon">add</i></h3>
            <div class="box">
                <form name ="editCoverBlog" class="row">
                    <figure class="file">
                        <img id="imgBackgroundBlog" src="{$background_blog}" alt="" />
                        <div class="upload">
                            <input id="background_blog" type="file" name="background_blog" accept="image/*">
                        </div>
                    </figure>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_blog_es" type="text" required value="{$title_blog_es}" />
                            <span class="bar-bottom"></span>
                            <label>Título (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_blog_en" type="text" required value="{$title_blog_en}" />
                            <span class="bar-bottom"></span>
                            <label>Título (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_blog_es" type="text" required value="{$subtitle_blog_es}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_blog_en" type="text" required value="{$subtitle_blog_en}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                </form>
                <div class="text-center" style="display: none;">
                    <p class="error"></p>
                </div>
                <div class="text-right">
                    <a class="btn md--button-flat md--btn-colored" data-action="editCoverBlog" data-ripple>Guardar</a>
                </div>
            </div>
        </div>

        <div class="toggle">
            <h3>Imagen de portada contacto<i class="material-icons icon">add</i></h3>
            <div class="box">
                <form name ="editCoverContact" class="row">
                    <figure class="file">
                        <img id="imgBackgroundContact" src="{$background_contact}" alt="" />
                        <div class="upload">
                            <input id="background_contact" type="file" name="background_contact" accept="image/*">
                        </div>
                    </figure>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_contact_es" type="text" required value="{$title_contact_es}" />
                            <span class="bar-bottom"></span>
                            <label>Título (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="title_contact_en" type="text" required value="{$title_contact_en}" />
                            <span class="bar-bottom"></span>
                            <label>Título (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_contact_es" type="text" required value="{$subtitle_contact_es}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (ES)</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="subtitle_contact_en" type="text" required value="{$subtitle_contact_en}" />
                            <span class="bar-bottom"></span>
                            <label>Subtítulo (EN)</label>
                            <a>Error</a>
                        </div>
                    </div>
                </form>
                <div class="text-center" style="display: none;">
                    <p class="error"></p>
                </div>
                <div class="text-right">
                    <a class="btn md--button-flat md--btn-colored" data-action="editCoverContact" data-ripple>Guardar</a>
                </div>
            </div>
        </div>
    </div>
</section>
