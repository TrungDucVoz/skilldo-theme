<?php $header_img = option::get('header_bg_image');?>
<style type="text/css">
    header {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-br-color:<?php echo $search['border'];?>;
        --header-search-br-radius:<?php echo $search['radius'];?>px;
        --header-search-bg-color:<?php echo $search['background'];?>;
        --header-search-btn-bg-color:<?php echo $search['btnBg'];?>;
        --header-search-btn-txt-color:<?php echo $search['btnColor'];?>;
        --header-search-btn-width:50px;
        --header-search-height:40px;
        --header-trending-color:<?php echo $trending['color'];?>;
        --header-trending-tag-color:<?php echo $trending['tag'];?>;
        --header-item-head-color:<?php echo Option::get('header_item_title_color', '#ed860a');?>;
        --header-item-txt-color:<?php echo Option::get('header_item_description_color', '#ed860a');?>;
        --header-cart-txt-color:<?php echo Option::get('header_icon_color', '#ed860a');?>;
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
        border-radius: var(--header-search-br-radius);
    }
    header .search .form-search .form-group {
        width: var(--search-input-width);
    }
    header .search .form-search .form-group .form-control {
        height: var(--header-search-height); background-color: transparent;
    }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
        line-height: calc(var(--header-search-height) - 4px);
    }

    header .tag-trending {
        display: flex;
        color: var(--header-trending-color);
    }
    header .tag-trending .title {
        font-weight: bold;
    }
    header .tag-trending ul {
        list-style: none;
        padding-left: 5px;
    }
    header .tag-trending ul li {
        display: inline-block; padding-right: 2px;
    }
    header .tag-trending ul li a {
        color: var(--header-trending-tag-color); font-size: 13px;
    }
    header .tag-trending ul li a:hover {
        color: var(--theme-color);
    }
    header .tag-trending ul li:after {
        content: ',';
    }
    header .tag-trending ul li:last-child:after {
        content: '';
    }

    header .header-content .list-item {
        display: -ms-flexbox !important;
        display: flex !important; gap:5px;
        -ms-flex-pack: distribute !important;
        justify-content: space-around !important;
    }
    header .header-content .list-item .item {
        -ms-flex-align: center !important;
        align-items: center !important;
        display: -ms-flexbox !important;
        display: flex !important;
        flex: 0 0 auto;
        width: calc(100%/3 - 5px);
        justify-content: flex-end;
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
    header .header-content .list-item .item .title .heading a {
        color: var(--header-item-head-color);
    }
    header .header-content .list-item .item .title p.description {
        margin:0; font-size: 11px; line-height: 20px;
        color: var(--header-item-txt-color);
    }

    header .header-content .cart-top {
        display: flex; align-items: center;
    }
    header .header-content .cart-top img { width:36px; margin-top:7px; }
    header .header-content .cart-top .cart-top__icon {margin-right:10px; position: relative}
    header .header-content .cart-top .js-cart-total-number {
        position: absolute; top:-15px; right: -15px; width: 30px; height: 30px; line-height: 30px;
        background-color: var(--theme-color); color: #fff; border-radius: 50%;
        text-align: center;
    }
    header .header-content .cart-top .cart-top__title {}
    header .header-content .cart-top .cart-top__title p {
        margin:0;
        text-align:left;
        color:var(--header-cart-txt-color);
    }
    header .header-content .cart-top .cart-top__title a {
        color:var(--header-cart-txt-color);
    }
</style>