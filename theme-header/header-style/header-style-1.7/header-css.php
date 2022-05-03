<style type="text/css">
    header {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-br-color:<?php echo $search['border'];?>;
        --header-search-br-radius:<?php echo $search['radius'];?>px;
        --header-search-bg-color:<?php echo $search['background'];?>;
        --header-search-btn-bg-color:<?php echo $search['btnBg'];?>;
        --header-search-btn-txt-color:<?php echo $search['btnColor'];?>;
        --header-search-btn-width:70px;

        --header-hotline-color-heading:<?php echo (!empty(Option::get('hotline_color_heading'))) ? Option::get('hotline_color_heading') : '#000';?>;
        --header-hotline-color-phone:<?php echo (!empty(Option::get('hotline_color_phone'))) ? Option::get('hotline_color_phone') : 'red';?>;
        --search-input-width:calc(100% - var(--header-search-btn-width));
        --cart-color:<?php echo $cartColor;?>;
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
        border-radius: var(--header-search-br-radius);
    }
    header .search .form-search .form-group {
        width: var(--search-input-width);
    }
    header .search .form-search .form-group .form-control {
        background-color:transparent;
        height: 45px;
    }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
        line-height: 41px;
    }

    header .header-content .row-flex-gap { gap:10px; justify-content: right;}

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

    header .header-content .cart-top { display: flex; align-items: center }
    header .header-content .cart-top img { width:36px; }
    header .header-content .cart-top .cart-top__icon {
        float:left; margin-right:10px; position: relative;
    }
    header .header-content .cart-top .js-cart-total-number {
        position: absolute; top:-15px; right: -15px; width: 30px; height: 30px; line-height: 30px;
        background-color: var(--theme-color); color: #fff; border-radius: 50%;
    }
    header .header-content .cart-top .cart-top__title { float:left; }
    header .header-content .cart-top .cart-top__title p {
        margin:0; line-height: 19px;
        text-align:left;
        color:var(--cart-color);
    }
</style>