<script type="text/javascript">
    $(function(){
        if(typeof $('header').html() != 'undefined') {
            let nav = $('header');
            let nav_p = nav.position();
            $(window).scroll(function () {
                if ($(this).scrollTop() > nav_p.top) {
                    nav.addClass('fixed');
                } else {
                    nav.removeClass('fixed');
                }
            });
        }
    });
</script>