<style>
    :root {
        --nav-font:<?php echo (option::get('nav_font')) ? option::get('nav_font') : option::get('text_font');?>;
        --nav-weight:<?php echo option::get('nav_font_weight');?>;
        --nav-font-size:<?php echo option::get('nav_font_size');?>px;
        --nav-padding:<?php echo option::get('nav_padding');?>;
        --nav-bg-color:<?php echo empty(option::get('nav_bg_color')) ? option::get('theme_color') : option::get('nav_bg_color') ;?>;
        --nav-bg-color-hv:<?php echo option::get('nav_bg_color_hover');?>;
        --nav-txt-color:<?php echo option::get('nav_text_color');?>;
        --nav-txt-color-hv:<?php echo option::get('nav_text_color_hover');?>;
        --navs-bg-color:<?php echo empty(option::get('navsub_bg_color')) ? option::get('theme_color') : option::get('navsub_bg_color') ;?>;
        --navs-bg-color-hv:<?php echo option::get('navsub_bg_color_hover');?>;
        --navs-txt-color:<?php echo option::get('navsub_text_color');?>;
        --navs-txt-color-hv:<?php echo option::get('navsub_text_color_hover');?>;
    }
    .navigation .navbar {
        background-color: var(--nav-bg-color);
    }
    .navigation .navbar-collapse { padding:0; }
    .navigation .navbar-nav>li,
    .navigation .navbar-nav>li>a {
        font-family:var(--nav-font);
        font-weight:var(--nav-weight);
        font-size:var(--nav-font-size);
        color:var(--nav-txt-color);
        transition: 0.3s all;
    }
    .navigation .navbar-nav>li>a {
        padding:var(--nav-padding);
    }
    .navigation .navbar-nav>li:hover,
    .navigation .navbar-nav>li>a:focus,
    .navigation .navbar-nav>li>a:hover,
    .navigation .navbar-nav>li.active a {
        background-color: var(--nav-bg-color-hv);
        color: var(--nav-txt-color-hv);
    }
    .navigation .navbar-nav>li>a:after {
        background-color: var(--nav-txt-color-hv);
    }
    .navigation .navbar-nav>li>a .icon img { height: 30px; }

    .navigation .navbar-nav .dropdown-menu>li,
    .navigation .navbar-nav .dropdown-menu>li.open,
    .navigation .navbar-nav .dropdown-menu>li>a,
    .navigation .navbar-nav .dropdown-menu>li.open>a {
        background-color: var(--navs-bg-color);
        color: var(--navs-txt-color);
        transition: 0.3s all;
    }
    .navigation .navbar-nav .dropdown-menu>li:hover,
    .navigation .navbar-nav .dropdown-menu>li.open:hover,
    .navigation .navbar-nav .dropdown-menu>li a:hover,
    .navigation .navbar-nav .dropdown-menu>.open>a:focus,
    .navigation .navbar-nav .dropdown-menu>.open>a:hover {
        background-color: var(--navs-bg-color-hv);
        color: var(--navs-txt-color-hv);
    }
</style>