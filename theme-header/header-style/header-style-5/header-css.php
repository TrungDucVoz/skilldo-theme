<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-br-color:<?php echo $search['border'];?>;
        --header-search-bg-color:<?php echo $search['background'];?>;
        --header-search-btn-width:70px;
        --header-search-btn-bg-color:<?php echo $search['btnBg'];?>;
        --header-search-btn-txt-color:<?php echo $search['btnColor'];?>;
        --header-cart-txt-color:<?php echo option::get('header_icon_color', '#ed860a');?>;

        --nav-header-font:<?php echo $navigation['font'];?>;
        --nav-header-weight:<?php echo $navigation['weight'];?>;
        --nav-header-font-size:<?php echo $navigation['fontSize'];?>px;
        --nav-header-padding:<?php echo $navigation['padding'];?>;
        --nav-header-bg-color:<?php echo $navigation['background'] ;?>;
        --nav-header-bg-color-hv:<?php echo $navigation['hoverBackground'];?>;
        --nav-header-txt-color:<?php echo $navigation['txtColor'];?>;
        --nav-header-txt-color-hv:<?php echo $navigation['hoverTxtColor'];?>;
        ---nav-header-header-sub-bg-color:<?php echo $navigation['subBackground'] ;?>;
        ---nav-header-header-sub-bg-color-hv:<?php echo $navigation['subHoverBackground'];?>;
        ---nav-header-header-sub-txt-color:<?php echo $navigation['subTxtColor'];?>;
        ---nav-header-header-sub-txt-color-hv:<?php echo $navigation['subHoverTxtColor'];?>;
    }
    header {
        <?php echo $background;?>
    }
    header .header-content {
        padding:10px 0;
    }
    .row-flex-center {
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
        height: 49px; background-color: transparent;
    }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
    }


    header .header-content .cart-top {overflow:hidden; }
    header .header-content .cart-top img { width:36px; margin-top:0px; }
    header .header-content .cart-top .cart-top__icon { float:left; margin-right:10px;}
    header .header-content .cart-top .cart-top__title { float:left; }
    header .header-content .cart-top .cart-top__title p {
        margin:0;
        text-align:left;
        color:var(--header-cart-txt-color);
    }

    .navigation-header .navbar {
        background-color: var(--nav-header-bg-color);
        margin-bottom: 0;
    }
    .navigation-header .navbar-collapse { padding:0; }
    .navigation-header .navbar-nav>li,
    .navigation-header .navbar-nav>li>a {
        font-family:var(--nav-header-font);
        font-weight:var(--nav-header-weight);
        font-size:var(--nav-header-font-size);
        color:var(--nav-header-txt-color);
        transition: 0.3s all;
    }
    .navigation-header .navbar-nav>li>a {
        padding:var(--nav-header-padding);
    }
    .navigation-header .navbar-nav>li:hover,
    .navigation-header .navbar-nav>li>a:focus,
    .navigation-header .navbar-nav>li>a:hover,
    .navigation-header .navbar-nav>li.active a {
        background-color: var(--nav-header-bg-color-hv);
        color: var(--nav-header-txt-color-hv);
    }
    .navigation-header .navbar-nav>li>a:after {
        background-color: var(--nav-header-txt-color-hv);
    }
    .navigation-header .navbar-nav>li>a .icon img { height: 30px; }

    .navigation-header .navbar-nav .dropdown-menu>li,
    .navigation-header .navbar-nav .dropdown-menu>li.open,
    .navigation-header .navbar-nav .dropdown-menu>li>a,
    .navigation-header .navbar-nav .dropdown-menu>li.open>a {
        background-color: var(---nav-header-header-sub-bg-color);
        color: var(---nav-header-header-sub-txt-color);
        transition: 0.3s all;
    }
    .navigation-header .navbar-nav .dropdown-menu>li:hover,
    .navigation-header .navbar-nav .dropdown-menu>li.open:hover,
    .navigation-header .navbar-nav .dropdown-menu>li a:hover,
    .navigation-header .navbar-nav .dropdown-menu>.open>a:focus,
    .navigation-header .navbar-nav .dropdown-menu>.open>a:hover {
        background-color: var(---nav-header-header-sub-bg-color-hv);
        color: var(---nav-header-header-sub-txt-color-hv);
    }
</style>