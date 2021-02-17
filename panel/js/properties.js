'use strict';

$(document).ready(function()
{
    var id;

    var link    = '';
    var pdf     = '';

    var chtcArray = [];
    var amtgArray = [];

    var arrayEdit1;
    var arrayEdit2;

    /* hidden-targets
    /* ----------------------------------------------------------------------- */
    var cbxHidden = $('[data-action="hidden"]');
    var tgtHidden = $('[data-hidden]');

    var iptRooms    = $('input[name="rooms"]');
    var iptRooms_en = $('input[name="rooms_en"]');
    var iptM2       = $('input[name="m2"]');
    var iptM2_en    = $('input[name="m2_en"]');

    cbxHidden.change(function()
    {
        tgtHidden.toggleClass('hidden');
        iptRooms[0].value       = '';
        iptRooms_en[0].value    = '';
        iptM2[0].value          = '';
        iptM2_en[0].value       = '';
        chtcArray               = [];
    });

    /* uploadLink
    /* ----------------------------------------------------------------------- */
    var uplLink = $('#link');

    uplLink.change(function()
    {
        var input = document.getElementById('link');;

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('image.*'))
                reader.readAsDataURL(file);

            reader.onloadend = function ()
            {
                link = reader.result;
                $('#imgLink').attr('src', link);
            }
        }
    });

    /* uploadPDF
    /* ----------------------------------------------------------------------- */
    var uplPdf = $('#pdf');

    uplPdf.change(function()
    {
        var input = document.getElementById('pdf');;

        if(window.FileReader)
        {
            var file    = input.files[0];
            var reader  = new FileReader();

            if (file && file.type.match('application/pdf'))
                reader.readAsDataURL(file);

            if (!file.type.match('application/pdf'))
                alert('this not a pdf');

            reader.onloadend = function ()
            {
                pdf = reader.result;
            }
        }
    });

    /* loadArrays
    /* ----------------------------------------------------------------------- */
    var arrays = $('[data-action="sendArrays"]');

    $(window).load(function()
    {
        arrayEdit1 = arrays.data('array1');
        arrayEdit2 = arrays.data('array2');

        if(arrayEdit1 != null)
        {
            chtcArray = arrayEdit1.split(',').map(Number);

            if(chtcArray == 0)
            {
                chtcArray = [];
            }
        }

        if(arrayEdit2 != null)
        {
            amtgArray = arrayEdit2.split(',').map(Number);

            if(amtgArray == 0)
            {
                amtgArray = [];
            }
        }
    });

    /* createArrays
    /* ----------------------------------------------------------------------- */
    var btnSendChtc = $('[data-action="sendChtc"]');
    var btnSendAmtg = $('[data-action="sendAmtg"]');

    btnSendChtc.change(function()
    {
        id = $(this).data('id');

        var option = true;

        for (var i = 0; i < chtcArray.length; i++)
        {
            if (chtcArray[i] == id)
            {
                chtcArray.splice(i, 1);
                option = false;
            }
        }

        if(option == true)
        {
            chtcArray.push(id);
        }
    });

    btnSendAmtg.change(function()
    {
        id = $(this).data('id');

        var option = true;

        for (var i = 0; i < amtgArray.length; i++)
        {
            if (amtgArray[i] == id)
            {
                amtgArray.splice(i, 1);
                option = false;
            }
        }

        if(option == true)
        {
            amtgArray.push(id);
        }
    });

    /* newProperty
    /* ----------------------------------------------------------------------- */
    var frmNew = $('form[name="new"]');
    var btnNew = $('[data-action="new"]');

    btnNew.on('click', function()
    {
        frmNew.submit();
    });

    frmNew.submit(function(e)
    {
        e.preventDefault();
        var data = frmNew.serialize();

        var description = tinymce.get('description');
        var description_en = tinymce.get('description_en');

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&description='+ encodeURIComponent(description.getContent()) + '&description_en='+ encodeURIComponent(description_en.getContent()) + '&link=' + link + '&chtc=' + chtcArray + '&amtg=' + amtgArray + '&pdf=' + pdf,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnNew.parent().remove();
                    window.location.href = response.path;
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* editProperty
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
            type: 'POST',
            data: data + '&description='+ encodeURIComponent(description.getContent()) + '&description_en='+ encodeURIComponent(description_en.getContent()) + '&link=' + link + '&chtc=' + chtcArray + '&amtg=' + amtgArray + '&pdf=' + pdf,
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

    /* deleteProperties
    /* ----------------------------------------------------------------------- */
    var urlDelete = 'index.php?c=properties&m=deleteProperties';
    var btnDelete = $('[data-action-modal="delete"]');

    multipleSelect(btnDelete, urlDelete, function(response)
    {
        if(response.status == 'success')
        {
            btnDelete.attr('disabled', '');
            location.reload();
        }
    });

    /* newSubproperty
    /* ----------------------------------------------------------------------- */
    var frmNewSubproperty = $('form[name="newSubproperty"]');
    var btnNewSubproperty = $('[data-action="newSubproperty"]');

    btnNewSubproperty.on('click', function()
    {
        frmNewSubproperty.submit();
    });

    frmNewSubproperty.submit(function(e)
    {
        e.preventDefault();
        var data = frmNewSubproperty.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&link=' + link + '&chtc=' + chtcArray,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnNewSubproperty.parent().remove();
                    window.location.href = response.path;
                }

                if(response.status == 'error')
                {
                    $('p.error').html(response.message);
                    $('p.error').parent().show();
                }
            }
        });
    });

    /* editSubproperty
    /* ----------------------------------------------------------------------- */
    var frmEditSubproperty = $('form[name="editSubproperty"]');
    var btnEditSubproperty = $('[data-action="editSubproperty"]');

    btnEditSubproperty.on('click', function()
    {
        frmEditSubproperty.submit();
    });

    frmEditSubproperty.submit(function(e)
    {
        e.preventDefault();
        var data = frmEditSubproperty.serialize();

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&link=' + link + '&chtc=' + chtcArray,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success') {
                    $('p.error').html('<img src="images/gif-load.gif" style="width: 25px;"/>' );
                    $('p.error').css('background-color','#388e3c');
                    $('p.error').parent().show();
                    btnEditSubproperty.parent().remove();
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

    /* obtener propiedad para editar su popularidad o destacado
    /*----------------------------------------------------------------*/
    var btnGetPopularToEdit = $('[data-action="getPopularToEdit"]');

    btnGetPopularToEdit.on('click', function()
    {
        id = $(this).data('id');

        $.ajax({
            url: 'index.php?c=properties&m=getPopularToEdit&p=' + id,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('input[name="popular"]').val(response.data.popular);
                    $('div[data-modal-target-destination="editPopular"]').toggleClass('view');
                }
                else if (response.status == 'error')
                    alert(response.message);
                else
                    location.reload();
            }
        });
    });

    /* editar popularidad o destacado de una propiedad
    /*----------------------------------------------------------------*/
    var btnEditPopular = $('[data-action="editPopular"]');
    var frmEditPopular = $('form[name="editPopular"]');

    btnEditPopular.on('click', function()
    {
        frmEditPopular.submit();
    });

    frmEditPopular.on('submit', function(e)
    {
        e.preventDefault();

        var data = frmEditPopular.serialize();

        $.ajax({
            url: 'index.php?c=properties&m=editPopular&p=' + id,
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
});
