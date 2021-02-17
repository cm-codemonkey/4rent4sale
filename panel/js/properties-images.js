'use strict';

$(document).ready(function()
{
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
            url: 'index.php?c=properties&m=deleteImage',
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
