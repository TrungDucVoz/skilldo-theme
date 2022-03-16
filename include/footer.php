<div class="clearfix"></div>
<?php Sidebar::render('footer-top'); ?>
<div class="clearfix"></div>
<footer>
    <div class="container"> <?php Sidebar::render('footer-main');?> </div>
</footer>
<div class="footer-bottom">
    <div class="container">
        <p><a href="https://sikido.vn">© <?php echo date("Y"); ?> <?php echo option::get('general_label'); ?> - Thiết kế bởi sikido.vn</a></p>
    </div>
</div>
<?php if(!Device::isGoogleSpeed()) {?>
<div id="fb-root"></div>
<script type='text/javascript' defer>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=879572492127382";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php } ?>
<?php echo do_action('cle_footer');?>
