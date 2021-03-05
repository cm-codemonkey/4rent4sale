$(document).ready(function ()
{
    $('#galleryForm').on('submit', function ( e )
    {
        e.preventDefault();
        e.stopPropagation();

        var data = new FormData( this );

        $.ajax({
            data: data,
            type: 'post',
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function ( response, status, xhr )
            {
                console.log('ok');
            }
        })
    })
});
