<?php
$header_slogan_height = (!empty(Option::get('header_slogan_height'))) ? (int)Option::get('header_slogan_height') : 88;?>
<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .slogan img { max-height: <?php echo $header_slogan_height;?>px; }
    header .address { font-size:15px; line-height: 25px; font-weight:bold; color:<?php echo Option::get('header_txt_color');?>; }
    header .box-social { margin-top:10px; }
    header .box-social a img { margin-right:5px; }
    header .box-social a:last-child img { margin-right:0px; }
</style>