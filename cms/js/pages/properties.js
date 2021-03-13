'use strict';

/**
* @package valkyrie.cms.js.pages
*
* @author Julian Alberto Canche Dzib <Developer, jcanche@codemonkey.com.mx>
* @since October 22 / October 30, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Módulo de propiedades
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since October 30 / November 14, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Se integraron las funciones de Modal to create or edit details of multiple property, Select type for property, Create characteristics array for property,
* Delete from characteristics array for property, Create amenities array for property, Delete from amenities array for property, Create pdf file for property, Create or edit details, Delete details selection
* y se actualizaron las funciones Get property to edit y Create or edit property para integrar la funcionalidad de propiedades multiples/sencillas.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(document).ready(function()
{
    var myDocument = $(this);

    /* Properties table
    ------------------------------------------------------------------------------- */
    var order = myDocument.find('table').data('table-order');

    myDocument.find('table').DataTable({
        dom: 'Bfrtip',
        buttons: [

        ],
        'columnDefs': [
            {
                'orderable': true,
                'targets': '_all'
            },
            {
                'className': 'text-left',
                'targets': '_all'
            }
        ],
        'order': [
            [order, 'asc']
        ],
        'searching': true,
        'info': true,
        'paging': true,
        'language': {
            'url': '/cms/languages/es_datatables.json'
        }
    });

    /* Modal to create or edit property
    ------------------------------------------------------------------------------- */
    $('[data-modal="properties"]').modal().onSuccess(function()
    {
        $('form[name="properties"]').submit();
    });

    $('[data-modal="properties"]').modal().onCancel(function()
    {
        $('select[name="type"]').parent().find('span.legend').addClass('hidden');
        $('input[name="price"]').parent().parent().removeClass('hidden');
        $('input[name="dimensions_es"]').parent().parent().removeClass('hidden');
        $('input[name="dimensions_en"]').parent().parent().removeClass('hidden');
        $('input[name="characteristic_es"]').parent().parent().removeClass('hidden');
        $('#characteristics').html('<span>No se han ingresado características a la lista</span>');
        $('input[name="amenity_es"]').parent().parent().removeClass('hidden');
        $('#amenities').html('<span>No se han ingresado amenidades a la lista</span>');
        $('select[name="dtype"]').parent().parent().removeClass('hidden');
        $('select[name="status"]').parent().parent().removeClass('hidden');
        $('div[data-preview]').attr('style', 'background-image: url(images/empty.png)');

        $('[data-modal="properties"]').find('header > h4').html('Nuevo');
        $('[data-modal="properties"]').find('form').attr('data-submit-action', 'new');
        $('[data-modal="properties"]').find('form > .input-group > div').removeClass('error');
        $('[data-modal="properties"]').find('form > .input-group > label').removeClass('error');
        $('[data-modal="properties"]').find('form > .input-group > p.error').remove();
        $('[data-modal="properties"]').find('form')[0].reset();
    });

    /* Modal to create or edit details of multiple property
    ------------------------------------------------------------------------------- */
    $('[data-modal="details"]').modal().onSuccess(function()
    {
        $('form[name="details"]').submit();
    });

    $('[data-modal="details"]').modal().onCancel(function()
    {
        $('#characteristics').html('<span>No se han ingresado características a la lista</span>');
        $('#amenities').html('<span>No se han ingresado amenidades a la lista</span>');
        $('div[data-preview]').attr('style', 'background-image: url(images/empty.png)');

        $('[data-modal="details"]').find('header > h4').html('Nuevo');
        $('[data-modal="details"]').find('form').attr('data-submit-action', 'new');
        $('[data-modal="details"]').find('form > .input-group > div').removeClass('error');
        $('[data-modal="details"]').find('form > .input-group > label').removeClass('error');
        $('[data-modal="details"]').find('form > .input-group > p.error').remove();
        $('[data-modal="details"]').find('form')[0].reset();
    });

    /* Select type for property
    ------------------------------------------------------------------------------- */
    var characteristics = [];
    var amenities = [];

    $('select[name="type"]').on('change', function()
    {
        if (confirm('Si cambia el tipo todos los detalles ya ingresados ser perderan.') == true)
        {
            characteristics = [];
            amenities = [];

            $('input[name="price"]').val('');
            $('input[name="dimensions_es"]').val('');
            $('input[name="dimensions_en"]').val('');
            $('input[name="characteristic_es"]').val('');
            $('input[name="characteristic_en"]').val('');
            $('#characteristics').html('<span>No se han ingresado características a la lista</span>');
            $('input[name="amenity_es"]').val('');
            $('input[name="amenity_en"]').val('');
            $('#amenities').html('<span>No se han ingresado amenidades a la lista</span>');
            $('select[name="dtype"]').val('sale');
            $('select[name="status"]').val('1');

            if ($('select[name="type"]').val() == 'simple')
            {
                $('select[name="type"]').parent().find('span.legend').addClass('hidden');
                $('input[name="price"]').parent().parent().removeClass('hidden');
                $('input[name="dimensions_es"]').parent().parent().removeClass('hidden');
                $('input[name="dimensions_en"]').parent().parent().removeClass('hidden');
                $('input[name="characteristic_es"]').parent().parent().removeClass('hidden');
                $('input[name="amenity_es"]').parent().parent().removeClass('hidden');
                $('select[name="dtype"]').parent().parent().removeClass('hidden');
                $('select[name="status"]').parent().parent().removeClass('hidden');
            }
            else if ($('select[name="type"]').val() == 'multiple')
            {
                $('select[name="type"]').parent().find('span.legend').removeClass('hidden');
                $('input[name="price"]').parent().parent().addClass('hidden');
                $('input[name="dimensions_es"]').parent().parent().addClass('hidden');
                $('input[name="dimensions_en"]').parent().parent().addClass('hidden');
                $('input[name="characteristic_es"]').parent().parent().addClass('hidden');
                $('input[name="amenity_es"]').parent().parent().addClass('hidden');
                $('select[name="dtype"]').parent().parent().addClass('hidden');
                $('select[name="status"]').parent().parent().addClass('hidden');
            }
        }
        else
        {
            if ($('select[name="type"]').val() == 'simple')
                $('select[name="type"]').val('multiple');
            else if ($('select[name="type"]').val() == 'multiple')
                $('select[name="type"]').val('simple');
        }
    });

    /* Create characteristics array for property
    ------------------------------------------------------------------------------- */
    $('[data-action="add_characteristic"]').on('click', function()
    {
        var iptCharacteristicEs = $('input[name="characteristic_es"]');
        var iptCharacteristicEn = $('input[name="characteristic_en"]');

        if (iptCharacteristicEs.val().length <= 0)
        {
            alert('Ingrese la categoría en español');
            iptCharacteristicEs.focus();
        }
        else if (iptCharacteristicEn.val().length <= 0)
        {
            alert('Ingrese la categoría en ingles');
            iptCharacteristicEn.focus();
        }
        else
        {
            var permitted = true;

            for (var i = 0; i < characteristics.length; i++)
            {
                if (characteristics[i]['es'] == iptCharacteristicEs.val() || characteristics[i]['en'] == iptCharacteristicEn.val())
                    permitted = false;
            }

            if (permitted == true)
            {
                characteristics.push({es: iptCharacteristicEs.val(), en: iptCharacteristicEn.val()});

                $('#characteristics').html('');

                for (var i = 0; i < characteristics.length; i++)
                    $('#characteristics').append('<p>Español: ' + characteristics[i].es + '. Ingles: ' + characteristics[i].en + '</p><a data-action="delete_characteristic" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

                iptCharacteristicEs.focus();
                iptCharacteristicEs.val('');
                iptCharacteristicEn.val('');
            }
            else
                alert('Este registro ya está ingresado');
        }
    });

    /* Delete from characteristics array for property
    ------------------------------------------------------------------------------- */
    $('#characteristics').on('click', '[data-action="delete_characteristic"]', function ()
    {
        var id = $(this).data('id');

        characteristics.splice(id, 1);

        $('#characteristics').html('');

        for (var i = 0; i < characteristics.length; i++)
            $('#characteristics').append('<p>Español: ' + characteristics[i].es + '. Ingles: ' + characteristics[i].en + '</p><a data-action="delete_characteristic" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

        if (characteristics.length <= 0)
            $('#characteristics').html('<span>No se han ingresado características a la lista</span>');
    });

    /* Create amenities array for property
    ------------------------------------------------------------------------------- */
    $('[data-action="add_amenity"]').on('click', function()
    {
        var iptAmenityEs = $('input[name="amenity_es"]');
        var iptAmenityEn = $('input[name="amenity_en"]');

        if (iptAmenityEs.val().length <= 0)
        {
            alert('Ingrese la categoría en español');
            iptAmenityEs.focus();
        }
        else if (iptAmenityEn.val().length <= 0)
        {
            alert('Ingrese la categoría en ingles');
            iptAmenityEn.focus();
        }
        else
        {
            var permitted = true;

            for (var i = 0; i < amenities.length; i++)
            {
                if (amenities[i]['es'] == iptAmenityEs.val() || amenities[i]['en'] == iptAmenityEn.val())
                    permitted = false;
            }

            if (permitted == true)
            {
                amenities.push({es: iptAmenityEs.val(), en: iptAmenityEn.val()});

                $('#amenities').html('');

                for (var i = 0; i < amenities.length; i++)
                    $('#amenities').append('<p>Español: ' + amenities[i].es + '. Ingles: ' + amenities[i].en + '</p><a data-action="delete_amenity" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

                iptAmenityEs.focus();
                iptAmenityEs.val('');
                iptAmenityEn.val('');
            }
            else
                alert('Este registro ya está ingresado');
        }
    });

    /* Delete from amenities array for property
    ------------------------------------------------------------------------------- */
    $('#amenities').on('click', '[data-action="delete_amenity"]', function ()
    {
        var id = $(this).data('id');

        amenities.splice(id, 1);

        $('#amenities').html('');

        for (var i = 0; i < amenities.length; i++)
            $('#amenities').append('<p>Español: ' + amenities[i].es + '. Ingles: ' + amenities[i].en + '</p><a data-action="delete_amenity" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

        if (amenities.length <= 0)
            $('#amenities').html('<span>No se han ingresado amenidades a la lista</span>');
    });

    /* Create pdf file for property
    ------------------------------------------------------------------------------- */
    var pdf = '';

    $('#pdf').change(function()
    {
        var input = document.getElementById('pdf');

        if(window.FileReader)
        {
            var file	= input.files[0];
            var reader	= new FileReader();

            if(file && file.type.match('application/pdf'))
                reader.readAsDataURL(file);

            reader.onloadend = function()
            {
                pdf = reader.result;
            }
        }
    });

    /* Get property to edit
    ------------------------------------------------------------------------------- */
    var idProperty;
    var idDetails;

    $('[data-action="get_property_to_edit"]').on('click', function()
    {
        var flag = $(this).data('flag');
        var data;

        if (flag == 'property')
        {
            idProperty = $(this).data('id');
            data = 'id_property=' + idProperty;
        }
        else if (flag == 'details')
        {
            idDetails = $(this).data('id');
            data = 'id_details=' + idDetails;
        }

        $.ajax({
            url: '',
            type: 'POST',
            data: data + '&action=get',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    if (flag == 'property')
                    {
                        var name = eval('(' + response.data.name + ')');
                        $('input[name="name_es"]').val(name.es);
                        $('input[name="name_en"]').val(name.en);

                        var description = eval('(' + response.data.description + ')');

                        tinymce.get('description_es').setContent(description.es);
                        tinymce.get('description_en').setContent(description.en);

                        $('select[name="type"]').val(response.data.type);

                        if (response.data.type == 'simple')
                        {
                            var details = eval('(' + response.data.details + ')');
                            details = details[0];

                            $('input[name="price"]').val(details.price);
                            $('input[name="dimensions_es"]').val(details.dimensions.es);
                            $('input[name="dimensions_en"]').val(details.dimensions.en);

                            characteristics = details.characteristics;

                            $('#characteristics').html('');

                            for (var i = 0; i < characteristics.length; i++)
                                $('#characteristics').append('<p>Español: ' + characteristics[i].es + '. Ingles: ' + characteristics[i].en + '</p><a data-action="delete_characteristic" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

                            amenities = details.amenities;

                            $('#amenities').html('');

                            for (var i = 0; i < amenities.length; i++)
                                $('#amenities').append('<p>Español: ' + amenities[i].es + '. Ingles: ' + amenities[i].en + '</p><a data-action="delete_amenity" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

                            $('select[name="dtype"]').val(details.type);

                            if (details.available == true)
                                $('select[name="status"]').val('1');
                            else
                                $('select[name="status"]').val('0');

                            $('select[name="type"]').parent().find('span.legend').addClass('hidden');
                            $('input[name="price"]').parent().parent().removeClass('hidden');
                            $('input[name="dimensions_es"]').parent().parent().removeClass('hidden');
                            $('input[name="dimensions_en"]').parent().parent().removeClass('hidden');
                            $('input[name="characteristic_es"]').parent().parent().removeClass('hidden');
                            $('input[name="amenity_es"]').parent().parent().removeClass('hidden');
                            $('select[name="dtype"]').parent().parent().removeClass('hidden');
                            $('select[name="status"]').parent().parent().removeClass('hidden');
                        }
                        else if (response.data.type == 'multiple')
                        {
                            $('select[name="type"]').parent().find('span.legend').removeClass('hidden');
                            $('input[name="price"]').parent().parent().addClass('hidden');
                            $('input[name="dimensions_es"]').parent().parent().addClass('hidden');
                            $('input[name="dimensions_en"]').parent().parent().addClass('hidden');
                            $('input[name="characteristic_es"]').parent().parent().addClass('hidden');
                            $('input[name="amenity_es"]').parent().parent().addClass('hidden');
                            $('select[name="dtype"]').parent().parent().addClass('hidden');
                            $('select[name="status"]').parent().parent().addClass('hidden');
                        }

                        var map = eval('(' + response.data.map + ')');

                        $('input[name="lat"]').val(map.lat);
                        $('input[name="lng"]').val(map.lng);

                        $('select[name="category"]').val(response.data.id_property_category);
                        $('select[name="location"]').val(response.data.id_property_location);
                        $('div[data-preview]').attr('style', 'background-image: url(../images/properties/' + response.data.background + ')');
                        // $('#pdf').val('../uploads/' + response.data.pdf);

                        if (response.data.priority > 0)
                            $('input[name="priority"]').val(response.data.priority);
                        else
                            $('input[name="priority"]').val(0);

                        $('[data-modal="properties"] header > h4').html('Editar');
                        $('[data-modal="properties"] form').attr('data-submit-action', 'edit');
                        $('[data-modal="properties"]').toggleClass('view').animate({scrollTop: 0}, 0);
                    }
                    else if (flag == 'details')
                    {
                        var details = response.data;

                        $('input[name="position"]').val(details.position);
                        $('input[name="name_es"]').val(details.name.es);
                        $('input[name="name_en"]').val(details.name.en);
                        $('input[name="price"]').val(details.price);
                        $('input[name="dimensions_es"]').val(details.dimensions.es);
                        $('input[name="dimensions_en"]').val(details.dimensions.en);

                        characteristics = details.characteristics;

                        $('#characteristics').html('');

                        for (var i = 0; i < characteristics.length; i++)
                            $('#characteristics').append('<p>Español: ' + characteristics[i].es + '. Ingles: ' + characteristics[i].en + '</p><a data-action="delete_characteristic" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

                        amenities = details.amenities;

                        $('#amenities').html('');

                        for (var i = 0; i < amenities.length; i++)
                            $('#amenities').append('<p>Español: ' + amenities[i].es + '. Ingles: ' + amenities[i].en + '</p><a data-action="delete_amenity" data-id="' + i + '"><i class="material-icons">delete</i></a><div class="clear"></div>');

                        $('select[name="dtype"]').val(details.type);

                        if (details.available == true)
                            $('select[name="status"]').val('1');
                        else
                            $('select[name="status"]').val('0');

                        $('div[data-preview]').attr('style', 'background-image: url(../images/properties/' + details.background + ')');

                        $('[data-modal="details"] header > h4').html('Editar');
                        $('[data-modal="details"] form').attr('data-submit-action', 'edit');
                        $('[data-modal="details"]').toggleClass('view').animate({scrollTop: 0}, 0);
                    }
                }
                else
                    alert(response.message);
            }
        });
    });

    /* Create or edit property
    ------------------------------------------------------------------------------- */
    $('form[name="properties"]').on('submit', function(e)
    {
        e.preventDefault();

        tinyMCE.triggerSave();

        var self = $(this);
        var action = self.data('submit-action');
        var data = new FormData(this);

        if ($('select[name="type"]').val() == 'simple')
        {
            characteristics = JSON.stringify(characteristics);
            amenities = JSON.stringify(amenities);
        }

        data.append('action', action);
        data.append('id_property', idProperty);

        if ($('select[name="type"]').val() == 'simple')
        {
            data.append('characteristics', characteristics);
            data.append('amenities', amenities);
        }

        data.append('pdf', pdf);

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                });
            }
        });
    });

    /* Create or edit details
    ------------------------------------------------------------------------------- */
    $('form[name="details"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var action = self.data('submit-action');
        var data = new FormData(this);
        characteristics = JSON.stringify(characteristics);
        amenities = JSON.stringify(amenities);

        data.append('action', action);
        data.append('id_details', idDetails);
        data.append('characteristics', characteristics);
        data.append('amenities', amenities);

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                });
            }
        });
    });

    /* Delete properties selection
    ------------------------------------------------------------------------------- */
    multipleSelect($('[data-action="delete_properties"]'), 'index.php?c=properties&m=index', function(response)
    {
        if (response.status == 'success')
        {
            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
            location.reload();
        }
        else
            alert(response.message);
    }, [
        'action', 'delete'
    ]);

    /* Delete details selection
    ------------------------------------------------------------------------------- */
    $('[data-button-modal="delete_details"]').on('click', function()
    {
        idDetails = $(this).data('id');
    });

    $('[data-action="delete_details"]').on('click', function()
    {
        $.ajax({
            url: '',
            type: 'POST',
            data: 'id_details=' + idDetails + '&action=delete',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                }
            }
        });
    });

    /* Modal to create or edit category
    ------------------------------------------------------------------------------- */
    $('[data-modal="categories"]').modal().onSuccess(function()
    {
        $('form[name="categories"]').submit();
    });

    $('[data-modal="categories"]').modal().onCancel(function()
    {
        $('[data-modal="categories"]').find('header > h4').html('Nuevo');
        $('[data-modal="categories"]').find('form').attr('data-submit-action', 'new');
        $('[data-modal="categories"]').find('form > .input-group > div').removeClass('error');
        $('[data-modal="categories"]').find('form > .input-group > label').removeClass('error');
        $('[data-modal="categories"]').find('form > .input-group > p.error').remove();
        $('[data-modal="categories"]').find('form')[0].reset();
    });

    /* Create or edit category
    ------------------------------------------------------------------------------- */
    var idCategory;

    $('form[name="categories"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var action = self.data('submit-action');
        var data = new FormData(this);

        data.append('action', action);
        data.append('id_property_category', idCategory);

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                });
            }
        });
    });

    /* Get category to edit
    ------------------------------------------------------------------------------- */
    $('[data-action="get_category_to_edit"]').on('click', function()
    {
        idCategory = $(this).data('id');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id_property_category=' + idCategory + '&action=get',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    var name = eval('(' + response.data.name + ')');

                    $('input[name="name_es"]').val(name.es);
                    $('input[name="name_en"]').val(name.en);
                    $('input[name="priority"]').val(response.data.priority);

                    $('[data-modal="categories"] header > h4').html('Editar');
                    $('[data-modal="categories"] form').attr('data-submit-action', 'edit');

                    $('div[data-preview]').attr('style', 'background-image: url(../images/properties/categories/' + response.data.background + ')');

                    $('[data-modal="categories"]').toggleClass('view').animate({scrollTop: 0}, 0);
                }
                else
                    alert(response.message);
            }
        });
    });

    /* Delete categories selection
    ------------------------------------------------------------------------------- */
    multipleSelect($('[data-action="delete_categories"]'), 'index.php?c=properties&m=categories', function(response)
    {
        if (response.status == 'success')
        {
            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
            location.reload();
        }
        else
            alert(response.message);
    }, [
        'action', 'delete'
    ]);

    /* Modal to create or edit location
    ------------------------------------------------------------------------------- */
    $('[data-modal="locations"]').modal().onSuccess(function()
    {
        $('form[name="locations"]').submit();
    });

    $('[data-modal="locations"]').modal().onCancel(function()
    {
        $('[data-modal="locations"]').find('header > h4').html('Nuevo');
        $('[data-modal="locations"]').find('form').attr('data-submit-action', 'new');
        $('[data-modal="locations"]').find('form > .input-group > div').removeClass('error');
        $('[data-modal="locations"]').find('form > .input-group > label').removeClass('error');
        $('[data-modal="locations"]').find('form > .input-group > p.error').remove();
        $('[data-modal="locations"]').find('form')[0].reset();
    });

    /* Create or edit location
    ------------------------------------------------------------------------------- */
    var idLocation;

    $('form[name="locations"]').on('submit', function(e)
    {
        e.preventDefault();

        var self = $(this);
        var action = self.data('submit-action');
        var data = new FormData(this);

        data.append('action', action);
        data.append('id_property_location', idLocation);

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkValidateFormAjax(self, response, function()
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                });
            }
        });
    });

    /* Get location to edit
    ------------------------------------------------------------------------------- */
    $('[data-action="get_location_to_edit"]').on('click', function()
    {
        idLocation = $(this).data('id');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id_property_location=' + idLocation + '&action=get',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    var name = eval('(' + response.data.name + ')');

                    $('input[name="name_es"]').val(name.es);
                    $('input[name="name_en"]').val(name.en);

                    $('[data-modal="locations"] header > h4').html('Editar');
                    $('[data-modal="locations"] form').attr('data-submit-action', 'edit');

                    $('[data-modal="locations"]').toggleClass('view').animate({scrollTop: 0}, 0);
                }
                else
                    alert(response.message);
            }
        });
    });

    /* Delete locations selection
    ------------------------------------------------------------------------------- */
    multipleSelect($('[data-action="delete_locations"]'), 'index.php?c=properties&m=locations', function(response)
    {
        if (response.status == 'success')
        {
            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
            location.reload();
        }
        else
            alert(response.message);
    }, [
        'action', 'delete'
    ]);

    /* New gallery image
    ------------------------------------------------------------------------------- */
    $('[data-action="new_gallery_image"]').on('click', function()
    {
        $('#file').click();
    });

    $('#file').change(function()
    {
        var image = '';
        var input = document.getElementById('file');

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
                    data: 'image=' + image + '&action=new',
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    success: function(response)
                    {
                        if (response.status == 'success')
                        {
                            $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                            location.reload();
                        }
                        else
                            alert(response.message);
                    }
                });
            }
        }
    });

    /* Delete gallery image
    ------------------------------------------------------------------------------- */
    var idGalleryImage;

    $('[data-action="delete_gallery_image"]').on('click', function()
    {
        idGalleryImage = $(this).data('id');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id_gallery_image=' + idGalleryImage + '&action=delete',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.status == 'success')
                {
                    $('body').prepend('<div data-loader-ajax><div class="loader-01"></div></div>');
                    location.reload();
                }
                else
                    alert(response.message);
            }
        });
    });
});
