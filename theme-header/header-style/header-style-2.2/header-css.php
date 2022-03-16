<?php $header_slogan_height = (!empty(Option::get('header_slogan_height'))) ? (int)Option::get('header_slogan_height') : 88;?>
<style type="text/css">
    :root {
        --header-logo-height:<?php echo option::get('logo_height');?>px;
        --header-phone-color:<?php echo option::get('header_icon_color', 'red');?>;;
    }
    .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .slogan img { max-height: <?php echo $header_slogan_height;?>px; }
    header .address { font-size:15px; line-height: 25px; font-weight:bold; color:<?php echo Option::get('header_txt_color');?>; }
    header .header-content .hotline {
        overflow:hidden; width:100%;
        display: flex; align-items: center;
        justify-content: right;
    }
    header .header-content .hotline .hotline__icon {
        padding:0px; margin: 0; height: 50px; width: 50px; line-height: 45px; text-align: center;
    }
    header .header-content .hotline .hotline__icon img { width:100%;}
    header .header-content .hotline .hotline__title {
        padding-left:10px;
        font-weight: bold;
        text-align:left;
    }
    header .header-content .hotline .hotline__title p {
        margin:0;
        color:var(--header-phone-color);
        line-height:19px;
        font-size:15px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    header .header-content .hotline .hotline__title .hotline__phone {
        font-size:18px;
    }
</style>