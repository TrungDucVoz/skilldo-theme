<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-br-color:<?php echo $search['border'];?>;
        --header-search-bg-color:<?php echo $search['background'];?>;
        --header-search-btn-bg-color:<?php echo $search['btnBg'];?>;
        --header-search-btn-txt-color:<?php echo $search['btnColor'];?>;
        --header-search-btn-width:70px;
        --header-hotline-color-phone:<?php echo (!empty(Option::get('header_icon_txt_color'))) ? Option::get('header_icon_txt_color') : '#000';?>;
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
        width: calc(100% - var(--header-search-btn-width));
    }
    header .search .form-search .form-group .form-control {
        background-color:var(--header-search-bg-color);
        height: 45px;
    }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
        line-height: 41px;
    }
    header .header-content .group-account {
        overflow:hidden;
        line-height: 50px;
        padding-right: 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    header .header-content .group-account img {
        width:40px; margin-right: 10px;
    }
    header .header-content .group-account span {
        font-size: 15px;
        color: var(--header-hotline-color-phone);
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        max-width: 150px;
    }
    header .header-content .group-account .account-popup {
        display: none;
        position: absolute;
        top: 60px;
        right: -15px;
        border: none;
        margin: 0;
        padding: 20px;
        z-index: 999;
        min-width: 278px;
        background-color: #f8f8f8;
        box-shadow: 0px 17px 10px 0px rgba(81,81,81,0.23);
        border-radius: 5px;
    }
    header .header-content .group-account .account-popup:before {
        border: 12px solid transparent;
        border-bottom: 12px solid #f8f8f8;
        bottom: 100%;
        right: 135px;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }
    header .header-content .group-account .account-popup:after {
        top: -20px;
        right: 0;
        content: " ";
        height: 20px;
        width: 100%;
        position: absolute;
    }
    header .header-content .group-account .account-popup a {
        display: block;
        font-size: 15px;
        text-align: center;
        margin-bottom: 10px;
    }
    header .header-content .group-account .account-popup a:hover { background: #fff; color: var(--theme-color);; border: solid 1px var(--theme-color);; }
    header .header-content .group-account .account-popup a:last-child { margin-bottom:0; }
    header .header-content .group-account:hover .account-popup {
        display: block;
    }
    header .header-content .cart-top {
        color: var(--header-hotline-color-phone);
        padding-right: 10px;
    }
    header .header-content .cart-top .btn-cart-top { margin-top:0px; }
    header .header-content .cart-top img { width:35px; }
    header .header-content .cart-top span {
        margin-left: 10px;
        color: var(--header-hotline-color-phone);
    }
</style>