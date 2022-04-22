<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-br-color:<?php echo $search['border'];?>;
        --header-search-bg-color:<?php echo $search['background'];?>;
        --header-search-btn-bg-color:<?php echo $search['btnBg'];?>;
        --header-search-btn-txt-color:<?php echo $search['btnColor'];?>;
        --header-search-btn-width:70px;
        --header-item-head-color:<?php echo option::get('header_item_title_color', '#ed860a');?>;
        --header-item-txt-color:<?php echo option::get('header_item_description_color', '#ed860a');?>;
        --header-hotline-color-heading:<?php echo (!empty(Option::get('hotline_color_heading'))) ? Option::get('hotline_color_heading') : '#000';?>;
        --header-hotline-color-phone:<?php echo (!empty(Option::get('hotline_color_phone'))) ? Option::get('hotline_color_phone') : 'red';?>;
        --search-input-width:calc(100% - var(--header-search-btn-width));
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .search { padding-top:0; }
    header .search .form-search {
        border-color:var(--header-search-br-color);
        background-color:var(--header-search-bg-color);
        border-radius: 5px;
    }
    header .search .form-search .form-group {
        width: var(--search-input-width);
    }
    header .search .form-search .form-group .form-control {
        background-color:transparent;
        height: 49px;
    }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
    }

    header .header-content .row-flex-gap {
        gap:5px; justify-content: space-around !important; -ms-flex-pack: distribute !important;
    }

    header .header-content .hotline {
        display: flex;
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
        margin:0; color:var(--header-hotline-color-heading); line-height:20px;
    }
    header .header-content .hotline .hotline__title p.hotline__phone {
        color:var(--header-hotline-color-phone); font-size:18px;
    }

    header .header-content .cart-top { overflow:hidden;display: flex; align-items: center }
    header .header-content .cart-top img { width:36px; }
    header .header-content .cart-top .cart-top__icon { float:left; margin-right:10px;}
    header .header-content .cart-top .cart-top__title { float:left; }
    header .header-content .cart-top .cart-top__title p {
        margin:0; line-height: 19px;
        text-align:left;
        color:var(--header-hotline-color-heading);
    }


    header .header-content .item {
        -ms-flex-align: center !important;
        align-items: center !important;
        display: -ms-flexbox !important;
        display: flex !important;
        flex: 0 0 calc(100%/3 - 5px);
    }
    header .header-content .item .img {
        margin-right:10px; width: 50px;flex: 0 0 50px;
    }
    header .header-content .item .img img {
        max-height:50px;
    }
    header .header-content .item .title {
        text-align: left !important;
        font-size:11px;
    }
    header .header-content .item .title .heading {
        margin-top:0;
        margin-bottom:0;
        font-weight: bold;
        font-size: 12px;
        color: var(--header-item-head-color);
    }
    header .header-content .item .title .heading a {
        color: var(--header-item-head-color);
    }
    header .header-content .item .title p.description {
        margin:0; font-size: 11px; line-height: 20px;
        color: var(--header-item-txt-color);
    }
</style>