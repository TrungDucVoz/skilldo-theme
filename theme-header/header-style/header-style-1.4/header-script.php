<script type="text/javascript">
    $(function(){
        let nav = $('.navigation');
        if(typeof nav.html() != 'undefined') {
            let nav_p = nav.position();
            let nav_h = nav.height();
            $(window).scroll(function () {
                if ($(this).scrollTop() > nav_p.top) {
                    nav.addClass('fixed');
                    $('body').css('margin-top', nav_h+'px');
                } else {
                    nav.removeClass('fixed');
                    $('body').css('margin-top', '0px');
                }
            });
        }
    });
</script>