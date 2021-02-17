$( document ).ready(function()
{
    navScrollDown('header.main-header', 'down',  0);

    var nav = $('nav.menu');

    $(document).on("scroll", function ()
    {
      if ($(document).scrollTop() > 200)
        nav.addClass('down');
      else
        nav.removeClass('down');
    });

    BackToTop('#back-to-top');

    $( document ).ajaxStart(function()
    {
      $('body').prepend('<div data-loader-ajax style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.7); z-index: 9999;"><img style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; width: 100px;" src="images/gif-load.gif"/></div>');
    });

    $( document ).ajaxStop(function()
    {
      $('body').find('[data-loader-ajax]').remove();
    });
});

$(document).ready(function()
{
  $('header.main-header nav.main-menu > .trigger-main-menu').on(clickEventType, function(e)
    {
      e.stopPropagation();

      var self = $(this);
      var menu_responsive = self.parent().find('> ul');

      menu_responsive.toggleClass('open');
    });
});

$( document ).ready(function()
{
  var nav = $('nav.menu');

  $(document).on("scroll", function ()
    {
      if ($(document).scrollTop() > 200)
        nav.addClass('down');
      else
        nav.removeClass('down');
    });
});

function navScrollDown($target, $class, $height)
{
    var nav = {
        initialize: function ()
        {
            $( document ).each(function () { nav.scroller() });
            $( document ).on("scroll", function () { nav.scroller() });
        },
        scroller: function ()
        {
            if ($(document).scrollTop() > $height)
                $($target).addClass($class);
            else
                $($target).removeClass($class);
        }
    }

    nav.initialize();
}
