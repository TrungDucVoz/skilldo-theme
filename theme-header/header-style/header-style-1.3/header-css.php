<?php $header_img = option::get('header_bg_image');?>
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
        --header-cart-txt-color:<?php echo option::get('header_icon_color', '#ed860a');?>;
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
        height: 45px; background-color: transparent;
    }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
        line-height: 41px;
    }

    header .header-content .list-item {
        display: -ms-flexbox !important;
        display: flex !important; gap 5px;
        -ms-flex-pack: distribute !important;
        justify-content: space-around !important;
    }
    header .header-content .list-item .item {
        -ms-flex-align: center !important;
        align-items: center !important;
        display: -ms-flexbox !important;
        display: flex !important;
        flex: 0 0 calc(100%/3 - 5px);
    }
    header .header-content .list-item .item .img {
        margin-right:10px; width: 50px;flex: 0 0 50px;
    }
    header .header-content .list-item .item .img img {
        max-height:50px;
    }
    header .header-content .list-item .item .title {
        text-align: left !important;
        font-size:11px;
    }
    header .header-content .list-item .item .title .heading {
        margin-top:0;
        margin-bottom:0;
        font-weight: bold;
        font-size: 12px;
        color: var(--header-item-head-color);
    }
    header .header-content .list-item .item .title p.description {
        margin:0; font-size: 11px; line-height: 20px;
        color: var(--header-item-txt-color);
    }

    header .header-content .cart-top {overflow:hidden; }
    header .header-content .cart-top img { width:36px; margin-top:7px; }
    header .header-content .cart-top .cart-top__icon { float:left; margin-right:10px;}
    header .header-content .cart-top .cart-top__title { float:left; }
    header .header-content .cart-top .cart-top__title p {
        margin:0;
        text-align:left;
        color:var(--header-cart-txt-color);
    }
</style>