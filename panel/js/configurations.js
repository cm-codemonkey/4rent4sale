'use strict';

$( document ).ready(function () {
    var MyDocument = $(this);

    MyDocument.on('click', '[data-action="send-metadata"]', function() {
        var form = document.getElementById("form-metadata");
        var post = new FormData(form);

        $.ajax({
            type: "POST",
            data: post,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function ( response )
            {
                location.reload();
            }
        });
    });
});

$(document).ready(function()
{
    var background = '';
    var background_about = '';
    var background_property_1 = '';
    var background_property_2 = '';
    var background_property_3 = '';
    var background_property_4 = '';
    var background_buy = '';
    var background_blog = '';
    var background_contact = '';

    /* load image home
    /* ----------------------------------------------------------------------- */
    var uplBackground = $('#background');

    uplBackground.change(function()
    {
        var input = document.getElementById('background');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background = reader.result;
                $('#imgBackground').attr('src', background);
            }
        }
    });

    /* load image about
    /* ----------------------------------------------------------------------- */
    var uplBackgroundAbout = $('#background_about');

    uplBackgroundAbout.change(function()
    {
        var input = document.getElementById('background_about');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_about = reader.result;
                $('#imgBackgroundAbout').attr('src', background_about);
            }
        }
    });

    /* load image property
    /* ----------------------------------------------------------------------- */
    var uplBackgroundProperty1 = $('#background_property_1');

    uplBackgroundProperty1.change(function()
    {
        var input = document.getElementById('background_property_1');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_property_1 = reader.result;
                $('#imgBackgroundProperty1').attr('src', background_property_1);
            }
        }
    });

    var uplBackgroundProperty2 = $('#background_property_2');

    uplBackgroundProperty2.change(function()
    {
        var input = document.getElementById('background_property_2');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_property_2 = reader.result;
                $('#imgBackgroundProperty2').attr('src', background_property_2);
            }
        }
    });

    var uplBackgroundProperty3 = $('#background_property_3');

    uplBackgroundProperty3.change(function()
    {
        var input = document.getElementById('background_property_3');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_property_3 = reader.result;
                $('#imgBackgroundProperty3').attr('src', background_property_3);
            }
        }
    });

    var uplBackgroundProperty4 = $('#background_property_4');

    uplBackgroundProperty4.change(function()
    {
        var input = document.getElementById('background_property_4');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_property_4 = reader.result;
                $('#imgBackgroundProperty4').attr('src', background_property_4);
            }
        }
    });

    /* load image buy
    /* ----------------------------------------------------------------------- */
    var uplBackgroundBuy = $('#background_buy');

    uplBackgroundBuy.change(function()
    {
        var input = document.getElementById('background_buy');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_buy = reader.result;
                $('#imgBackgroundBuy').attr('src', background_buy);
            }
        }
    });

    /* load image blog
    /* ----------------------------------------------------------------------- */
    var uplBackgroundBlog = $('#background_blog');

    uplBackgroundBlog.change(function()
    {
        var input = document.getElementById('background_blog');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_blog = reader.result;
                $('#imgBackgroundBlog').attr('src', background_blog);
            }
        }
    });

    /* load image contact
    /* ----------------------------------------------------------------------- */
    var uplBackgroundContact = $('#background_contact');

    uplBackgroundContact.change(function()
    {
        var input = document.getElementById('background_contact');

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                background_contact = reader.result;
                $('#imgBackgroundContact').attr('src', background_contact);
            }
        }
    });

    /* edit
    /* ----------------------------------------------------------------------- */
    var frmEdit = $('form[name="edit"]');
    var btnEdit = $('[data-action="edit"]');

    btnEdit.on('click', function()
    {
        frmEdit.submit();
    });

    frmEdit.submit(function(e)
    {
        e.preventDefault();
        var data = frmEdit.serialize();

        var description = tinymce.get('description');
        var description_en = tinymce.get('description_en');

        $.ajax({
            url: '',
            type: "POST",
            data: data + '&description='+ encodeURIComponent(description.getContent()) + '&description_en='+ encodeURIComponent(description_en.getContent()),
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEdit.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit contact us settings
    /* ------------------------------------------------------------------------ */
    var btn_edit_contact_us = $('[data-action="edit_contact_us"]');
    var frm_edit_contact_us = $('form[name="edit_contact_us"]');

    btn_edit_contact_us.on('click', function()
    {
        frm_edit_contact_us.submit();
    });

    frm_edit_contact_us.on('submit', function(e)
    {
        e.preventDefault();
        var data = frm_edit_contact_us.serialize();

        $.ajax({
            url: 'index.php?c=configurations&m=contact',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btn_edit_contact_us.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit cover home
    /* ----------------------------------------------------------------------- */
    var frmEditCoverHome = $('form[name="editCoverHome"]');
    var btnEditCoverHome = $('[data-action="editCoverHome"]');

    btnEditCoverHome.on('click', function()
    {
        frmEditCoverHome.submit();
    });

    frmEditCoverHome.submit(function(e)
    {
        e.preventDefault();
        var data = frmEditCoverHome.serialize();

        $.ajax({
            url: 'index.php?c=configurations&m=edit_cover_home',
            type: 'POST',
            data: data + '&background=' + background,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEditCoverHome.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit cover about
    /* ----------------------------------------------------------------------- */
    var frmEditCoverAbout = $('form[name="editCoverAbout"]');
    var btnEditCoverAbout = $('[data-action="editCoverAbout"]');

    btnEditCoverAbout.on('click', function()
    {
        frmEditCoverAbout.submit();
    });

    frmEditCoverAbout.submit(function(e)
    {
        e.preventDefault();
        var data = frmEditCoverAbout.serialize();

        $.ajax({
            url: 'index.php?c=configurations&m=edit_cover_about',
            type: 'POST',
            data: data + '&background_about=' + background_about,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEditCoverAbout.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit cover property
    /* ----------------------------------------------------------------------- */
    var frmEditCoverProperty = $('form[name="editCoverProperty"]');
    var btnEditCoverProperty = $('[data-action="editCoverProperty"]');

    btnEditCoverProperty.on('click', function()
    {
        frmEditCoverProperty.submit();
    });

    frmEditCoverProperty.submit(function(e)
    {
        e.preventDefault();
        var data = frmEditCoverProperty.serialize();

        $.ajax({
            url: 'index.php?c=configurations&m=edit_cover_property',
            type: 'POST',
            data: data + '&background_property_1=' + background_property_1 + '&background_property_2=' + background_property_2 + '&background_property_3=' + background_property_3  + '&background_property_4=' + background_property_4,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEditCoverProperty.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit cover buy
    /* ----------------------------------------------------------------------- */
    var frmEditCoverBuy = $('form[name="editCoverBuy"]');
    var btnEditCoverBuy = $('[data-action="editCoverBuy"]');

    btnEditCoverBuy.on('click', function()
    {
        frmEditCoverBuy.submit();
    });

    frmEditCoverBuy.submit(function(e)
    {
        e.preventDefault();
        var data = frmEditCoverBuy.serialize();

        $.ajax({
            url: 'index.php?c=configurations&m=edit_cover_buy',
            type: 'POST',
            data: data + '&background_buy=' + background_buy,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEditCoverBuy.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit cover blog
    /* ----------------------------------------------------------------------- */
    var frmEditCoverBlog = $('form[name="editCoverBlog"]');
    var btnEditCoverBlog = $('[data-action="editCoverBlog"]');

    btnEditCoverBlog.on('click', function()
    {
        frmEditCoverBlog.submit();
    });

    frmEditCoverBlog.submit(function(e)
    {
        e.preventDefault();
        var data = frmEditCoverBlog.serialize();

        $.ajax({
            url: 'index.php?c=configurations&m=edit_cover_blog',
            type: 'POST',
            data: data + '&background_blog=' + background_blog,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEditCoverBlog.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* edit cover contact
    /* ----------------------------------------------------------------------- */
    var frmEditCoverContact = $('form[name="editCoverContact"]');
    var btnEditCoverContact = $('[data-action="editCoverContact"]');

    btnEditCoverContact.on('click', function()
    {
        frmEditCoverContact.submit();
    });

    frmEditCoverContact.submit(function(e)
    {
        e.preventDefault();
        var data = frmEditCoverContact.serialize();

        $.ajax({
            url: 'index.php?c=configurations&m=edit_cover_contact',
            type: 'POST',
            data: data + '&background_contact=' + background_contact,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEditCoverContact.parent().remove();
                    location.reload();
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    var uplAddImage = $('#addImage');
    var btnAddImage = $('[data-action="addImage"]');
    var btnDltImage = $('[data-action="deleteImage"]');

    btnAddImage.on('click', function()
    {
        uplAddImage.click();
    });

    uplAddImage.change(function()
    {
        var image = '';
        var input = document.getElementById('addImage');

        if(window.FileReader)
        {
            var file	= input.files[0];
            var reader	= new FileReader();

            if(file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function()
            {
                image = reader.result;

                $.ajax({
                    url: '',
                    type: 'POST',
                    data: 'image=' + image,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    success: function(response)
                    {
                        if(response.status == 'success')
                        {
                            $('[data-load="addImage"]').html('<img src="images/gif-load.gif" style="width: 25px;"/>');
                            $('[data-load="addImage"]').parent().show();
                            btnAddImage.parent().remove();
		                    location.reload();
                        }

		                if(response.status == 'error')
		                {
		                    $('p.error').html(response.message);
		                    $('p.error').parent().show();
		                }
                    }
                });
            }
        }
    });

    btnDltImage.on('click', function()
    {
        var id = $(this).data('id');

        $.ajax({
            url: 'index.php?c=configurations&m=deleteImage',
            type: 'POST',
            data: 'id=' + id,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success')
                {
                    btnDltImage.parent().remove();
                    location.reload();
                }
            }
        });
    });
});
