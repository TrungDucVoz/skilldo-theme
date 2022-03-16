<style>
    :root {
        --nav-font:<?php echo (option::get('nav_font')) ? option::get('nav_font') : option::get('text_font');?>;
        --nav-weight:<?php echo option::get('nav_font_weight');?>;
        --nav-font-size:<?php echo option::get('nav_font_size');?>px;
        --nav-bg-color:<?php echo empty(option::get('nav_bg_color')) ? option::get('theme_color') : option::get('nav_bg_color') ;?>;
        --nav-txt-color:<?php echo option::get('nav_text_color');?>;

        --nav-item-heading-color:<?php echo empty(option::get('navigation_item_heading_color')) ? '#000' : option::get('navigation_item_heading_color') ;?>;
        --nav-item-des-color:<?php echo empty(option::get('navigation_item_des_color')) ? '#000' : option::get('navigation_item_des_color') ;?>;

        --navd-head-txt:<?php echo option::get('nav_vh_text_color');?>;
        --navd-head-bg:<?php echo option::get('nav_vh_bg');?>;
        --navd-bg-color:<?php echo option::get('nav_v_bg');?>;
        --navd-bg-color-hv:<?php echo option::get('nav_v_bg_hover');?>;
        --navd-txt-color:<?php echo option::get('nav_v_text_color');?>;
        --navd-txt-color-hv:<?php echo option::get('nav_v_text_color_hover');?>;
    }
    .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    .navigation, .navigation .navbar {
        background-color: var(--nav-bg-color);
    }
    .navigation .navbar-collapse { padding:0; }
    .navigation .navbar-nav>li>a .icon img { height: 30px; }
    .navigation>.container>div { position: relative;}

    .vertical-menu { padding-right: 0;}
    .menu-vertical { position: relative; z-index: 52; display: block !important; }
    .menu-vertical .menu-vertical__header {
        cursor: pointer;
        margin: 0;
        padding: 0 15px;
        height:56px; line-height:56px;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 600;
        color: var(--navd-head-txt);
        background-color: var(--navd-head-bg);
    }
    .menu-vertical .menu-vertical__header i {
        content: "";
        display: block;
        height: 2px;
        position: absolute;
        -webkit-transform: rotate(0);
        transform: rotate(0);
        width: 15px;top: 22px;
    }
    .menu-vertical .menu-vertical__header span {
        padding-left: 25px;
    }

    .menu-vertical .menu-vertical__content {
        position: absolute;
        left: 0;
        background: #fff;
        width: 100%;
        z-index:52;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category {
        border: 1px solid #dadada;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav {
        color: var(--navd-txt-color);
        background-color: var(--navd-bg-color);
        list-style: none; margin:0;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item {
        float: none;
        border-top: 1px solid rgba(0,0,0,0.15);
        position: initial;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item:first-child {
        border-top: 0px solid rgba(0,0,0,0.15);
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item .icon {
        position: absolute;
        top: 0;
        left: 0;
        width: 40px;
        height: 40px;
        line-height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item .icon img {
        width: 20px;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item.nav-hidden { display: none; }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item>a.nav-link {
        position: relative;
        display: block;
        overflow: hidden;
        white-space: nowrap;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        padding: 10px 30px 10px 40px;
        border: none;
        color: var(--navd-txt-color);
        background-color: var(--navd-bg-color);
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item>a.nav-link:hover {
        color: var(--navd-txt-color-hv);
        background-color: var(--navd-bg-color-hv);
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item i {
        position: absolute;
        top: 0;
        right: 0;
        width: 43px;
        line-height: 43px;
        text-align: center;
    }


    .menu-vertical .menu-vertical__content .sub-menu-dropdown {
        position: absolute;
        z-index: 380;
        margin: 0 0 0;padding: 30px 35px 0 35px;
        background-color: #FFF;
        background-position: bottom right;
        background-clip: border-box;
        background-repeat: no-repeat;
        box-shadow: 0 0 3px rgb(0 0 0 / 15%);
        text-align: left;
        visibility: hidden;
        opacity: 0;
        transition: opacity .2s ease,visibility .2s ease,transform .2s ease,-webkit-transform .2s ease;
        -webkit-transform: translateY(15px) translateZ(0);
        transform: translateY(15px) translateZ(0);
        pointer-events: none;
        top: 0;
        left: 100%;
        width: 825px;
        min-height:100%;
    }
    .menu-vertical .menu-vertical__content .sub-menu-dropdown .sub-menu-dropdown-container {
        box-sizing: border-box;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .menu-vertical .menu-vertical__content .sub-menu-dropdown .col-inner {
        -webkit-box-align: start;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
        width: 25%;
        float: left;
    }
    .menu-vertical .menu-vertical__content .sub-menu-dropdown ul {
        list-style: none;
    }
    .menu-vertical .menu-vertical__content .sub-menu-dropdown ul li a {
        color: var(--navd-txt-color);
        background-color: var(--navd-bg-color);
        padding-bottom:10px; display: block;
    }
    .menu-vertical .menu-vertical__content .sub-menu-dropdown ul li:hover {
        color: var(--navd-txt-color-hv);
    }
    .menu-vertical .menu-vertical__content .sub-menu-dropdown ul.mega-menu-list>li>a {
        font-weight: bold;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item:hover .sub-menu-dropdown {
        visibility: visible;
        opacity: 1;
        -webkit-transform: none;
        transform: none;
        pointer-events: visible;
        pointer-events: unset;
    }

    .fixed .menu-vertical .menu-vertical__content, .menu-vertical.no-home .menu-vertical__content {
        display: none;
    }
    .fixed .menu-vertical .menu-vertical__content.active,
    .fixed .menu-vertical.no-home:hover .menu-vertical__content,
    .menu-vertical.no-home:hover .menu-vertical__content {
        display: block;
    }

    .menu-vertical .bg-vertical.active {
        display: block;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 51;
    }
    .section-vertical { overflow:hidden}
    .section-vertical .vertical-slider .container { width: 100%!important; padding:0; }
    .vertical-slider { padding: 10px; }
    @media(max-width: 768px) {
        .vertical-slider { padding:0; }
    }


    .header-list-item {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-pack: distribute !important;
        justify-content: center !important;
        padding:0 0;
    }
    .header-list-item .item {
        -ms-flex-align: center !important;
        align-items: center !important;
        display: -ms-flexbox !important;
        display: flex !important;
        padding: 0 10px;
        border-right: 1px dashed #ccc;
    }
    .header-list-item .item:last-child {
        border-right: 0px dashed #ccc;
    }
    .header-list-item .item .img {
        margin-right:10px;
    }
    .header-list-item .item .img img {
        max-height:50px;
    }
    .header-list-item .item .title {
        text-align: left !important;
        font-size:15px;
    }
    .header-list-item .item .title .heading {
        margin-top:0;
        margin-bottom:0;
        font-weight: bold;
        font-size: 14px;
        text-transform: uppercase;
        color: var(--nav-item-heading-color);
    }
    .header-list-item .item .title p.description {
        margin:0; font-size: 12px;
        color: var(--nav-item-des-color);
    }
</style>