<?php
$header_hotline_color_heading = (!empty(option::get('header_hotline_color_heading'))) ? option::get('header_hotline_color_heading') : option::get('theme_color');
$header_hotline_color_phone = (!empty(option::get('header_hotline_color_phone'))) ? option::get('header_hotline_color_phone') : option::get('theme_color');
?>
<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-hotline-color-heading:<?php echo $header_hotline_color_heading;?>;
        --header-hotline-color-phone:<?php echo $header_hotline_color_phone;?>;
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
    header .header-content .hotline { overflow:hidden; }
    header .header-content .hotline .hotline__icon {
        float:left; padding:0px; margin: 0; height: 40px; width: 40px; line-height: 30px; text-align: center;
    }
    header .header-content .hotline .hotline__icon img { width:100%;}
    header .header-content .hotline .hotline__title {
        float: left;
        padding-left:10px;
        color:red;
        font-weight: bold;
        text-align:left;
    }
    header .header-content .hotline .hotline__title p {
        margin:0;
        color:var(--header-hotline-color-heading);
        line-height:19px;
    }
    header .header-content .hotline .hotline__title p.hotline__phone {
        color:var(--header-hotline-color-phone);
        font-size:18px;
    }
</style>