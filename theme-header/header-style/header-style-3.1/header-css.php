<style type="text/css">
    :root {
        --header-logo-height:<?php echo option::get('logo_height');?>px;
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .header-content .navigation .container { width:100%!important; padding:0!important;}
    header .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    header .header-content .btn-cart-top {
        margin-top: 0;
    }
    header .btn-cart-top img {
        max-width: 40px;
    }
</style>