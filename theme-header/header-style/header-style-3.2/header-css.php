<?php
$search_icon_color = (!empty(option::get('search_icon_color'))) ? option::get('search_icon_color') : option::get('theme_color');
?>
<style type="text/css">
    :root {
        --header-logo-height:<?php echo option::get('logo_height');?>px;
        --header-search-color:<?php echo $search_icon_color;?>;
    }
    header .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .header-content .navigation .container { width:100%!important; padding:0!important;}
    header .header-content .btn-search {
        font-size: 20px; font-weight: bold; color: var(--header-search-color); display: inline-block; margin:0 10px 0 0;
    }
    header .header-content .btn-cart-top {
        margin-top: 0;
    }
    header .btn-cart-top img {
        max-width: 25px;
    }
</style>