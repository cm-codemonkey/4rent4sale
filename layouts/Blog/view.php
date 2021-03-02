<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}blog.js'
	],
    'other' => [

    ]
]);
?>
<header class="main-header">
    %{header}%
</header>
<section class="item-blog-background">
    <figure>
        <img src="{$cover}" alt="" />
    </figure>
    <div class="container">
        <div class="content">
            <h1>{$title}</h1>
        </div>
    </div>
</section>
<section class="item-blog">
    <div class="container">
        <div class="button-action-blog">
            <div class="item">
                <span>{$lang.share_by_email}</span>
                <a class="btn md--btn-circle" data-modal="sendEmail" data-ripple><i class="material-icons">email</i></a>
            </div>
            <div class="item whatsapp">
                <span>{$lang.share_by_whatsapp}</span>
                <a href="whatsapp://send?text=4Rent 4Sale Riviera Maya Realty - {$share}" class="btn md--btn-circle" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="description">
            {$description}
        </div>
    </div>
</section>
<div class="modal" data-modal-target-destination="sendEmail">
    <section class="content">
        <header class="modal-header">
            <h3><i class="material-icons">send</i> {$lang.share_send_information_article}</h3>
        </header>
        <main class="modal-main">
            <form name="sendEmail" class="row">
                <div class="span12">
                    <div class="md--group-form">
                        <input type="email" name="shareEmail" placeholder="{$lang.share_email}" value="">
                        <span class="bar-bottom"></span>
                        <label>{$lang.share_destination_email}</label>
                        <a>Error</a>
                    </div>
                </div>
                <div class="span12">
                    <div class="md--group-form">
                        <input type="text" name="shareName" placeholder="{$lang.share_name}" value="">
                        <span class="bar-bottom"></span>
                        <label>{$lang.share_who_name}</label>
                        <a>Error</a>
                    </div>
                </div>
                <div class="span12">
                    <div class="md--group-form">
                        <textarea name="shareMessage" placeholder="{$lang.share_write_description}"></textarea>
                        <span class="bar-bottom"></span>
                        <label>{$lang.share_description}</label>
                        <a>Error</a>
                    </div>
                </div>
            </form>
            <div class="error">
                <p></p>
            </div>
        </main>
        <footer class="modal-footer">
            <a class="btn md--button-flat" data-action-modal="cancel" data-ripple>{$lang.btn_email_cancel}</a>
            <a class="btn md--button-flat md--btn-colored" data-action-modal="sendEmail" data-ripple>{$lang.btn_email_send}</a>
        </footer>
    </section>
</div>
