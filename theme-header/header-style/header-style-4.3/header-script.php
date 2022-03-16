<script type="text/javascript">
    $(function(){
        if(typeof $('.navigation').html() != 'undefined') {
            let nav = $('.navigation');
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