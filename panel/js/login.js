var login = {
    initialize: function()
    {
        $('#login--cpanel').submit(function(event)
        {
            var $this = $(this),
                data = $this.serialize();

            $.ajax({
                url: '',
                type: "POST",
                data: data,
                processData: false,
                cache: false,
                dataType: 'json',
                success: function(response)
                {
                    if(response.status === 'error')
                    {
                        $this.find('input').parent().removeClass('error');
                        $this.find('input[name="'+ response.field +'"]').parent().addClass('error');
                        $('div.message').show().html('<p>'+ response.message + '</p>');

                        setTimeout(function()
                        {
                            $('div.message').hide().text('');
                        }, 4000);
                    }

                    if(response.status === 'successful')
                    {
                        $this.find('input').parent().removeClass('error');
                        $('div.message').hide().text('');
                        $('section.login > form').addClass('quit');
                        $('section.login > h1').addClass('show');

                        setTimeout(function()
                        {
                            location.reload();
                        }, 2000);
                    }
                }
            });

            event.preventDefault();
        });
    }
}
