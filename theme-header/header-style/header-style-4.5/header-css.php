<?php
$search_icon_color = (!empty(option::get('search_icon_color'))) ? option::get('search_icon_color') : option::get('theme_color');
?>
<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-color:<?php echo $search_icon_color;?>;
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    header .row-flex-gap {
        gap:10px;justify-content: flex-end;
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .header-content .btn-search {
        font-size: 30px; font-weight: bold; color:var(--header-search-color);
    }
    header .header-content .btn-search span {
        font-size: 15px;
    }

    header .header-content .cart-top { padding-left:10px; }
    header .header-content .cart-top .btn-cart-top { margin-top:0px; }
    header .header-content .cart-top img { width:30px;}
</style>