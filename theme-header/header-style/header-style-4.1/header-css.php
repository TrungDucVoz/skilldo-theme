<style type="text/css">
    :root {
        --header-logo-height:<?php echo option::get('logo_height');?>px;
        --header-search-br-color:<?php echo option::get('search_border_color', 'red');?>;
        --header-search-bg-color:<?php echo option::get('search_bg_color', '#fff');?>;
        --header-search-btn-width:70px;
        --header-search-btn-bg-color:<?php echo option::get('search_btn_bg_color', '#000');?>;
        --header-search-btn-txt-color:<?php echo option::get('search_btn_txt_color', '#fff');?>;
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
    header .search { padding-top:0; }
    header .search .form-search {
        border-color:var(--header-search-br-color);
        background-color:var(--header-search-bg-color);
        border-radius: 5px;
    }
    header .search .form-search .form-group {
        width: calc(100% - var(--header-search-btn-width));
    }
    header .search .form-search .form-group .form-control {
        background-color:var(--header-search-bg-color);
        height: 49px;  }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
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
    header .header-content .cart-top .btn-cart-top { margin-top: 0;}
    header .header-content .cart-top img { width:30px;}
</style>