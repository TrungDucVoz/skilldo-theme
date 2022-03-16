<?php
$search_icon_color = (!empty(option::get('search_icon_color'))) ? option::get('search_icon_color') : option::get('theme_color');
?>
<style type="text/css">
    :root {
        --header-logo-height:<?php echo option::get('logo_height');?>px;
        --header-search-color:<?php echo $search_icon_color;?>;
        --header-hotline-color-heading:<?php echo (!empty(Option::get('hotline_color_heading'))) ? Option::get('hotline_color_heading') : '#000';?>;
        --header-hotline-color-phone:<?php echo (!empty(Option::get('hotline_color_phone'))) ? Option::get('hotline_color_phone') : '#000';?>;
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
        font-size: 30px; font-weight: bold; color:var(--header-search-color); display: inline-block;
    }

    header .header-content .hotline {
        display: flex;align-items: center;
    }
    header .header-content .hotline .hotline__icon {
        margin:0px 0 0 10px;
        height: 40px;
        width: 40px;
        line-height: 40px;
        text-align: center;
    }
    header .header-content .hotline .hotline__icon img { width:100%;}
    header .header-content .hotline .hotline__title {
        width:calc(100% - 40px);
        padding-left:10px; color:red; font-weight: bold; text-align:left;
    }
    header .header-content .hotline .hotline__title p {
        margin:0; color:var(--header-hotline-color-heading);
        line-height:19px;
        font-size:18px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    header .header-content .hotline .hotline__title .hotline__phone {
        color:var(--header-hotline-color-phone); font-size:18px;
    }

    header .header-content .cart-top { padding-left:10px; }
    header .header-content .cart-top .btn-cart-top { margin-top:0px; }
    header .header-content .cart-top img { width:30px;}
</style>