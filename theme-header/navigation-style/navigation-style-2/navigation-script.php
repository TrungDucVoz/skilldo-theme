<script type="text/javascript">
    $('.menu-vertical .menu-vertical__header').click(function() {
        $(this).closest('.menu-vertical').find('.menu-vertical__content').toggleClass('active');
        $(this).closest('.menu-vertical').find('.bg-vertical').toggleClass('active');
    });
    $('.menu-vertical .bg-vertical').click(function() {
        $(this).closest('.menu-vertical').find('.menu-vertical__content').toggleClass('active');
        $(this).closest('.menu-vertical').find('.bg-vertical').toggleClass('active');
        return false;
    });
    $('.menu-vertical__category__nav .js_navigation_vertical__show').click(function() {
        $(this).closest('.menu-vertical__category__nav').find('.nav-hidden').toggle();
        return false;
    });
</script>