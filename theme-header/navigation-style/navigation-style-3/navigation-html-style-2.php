<ul class="menu-vertical__category__nav">
    <?php echo ThemeMenu::render(['theme_location' => 'main-vertical', 'walker' => 'store_nav_menu_vertical']);?>
    <li class="nav-item">
        <a href="#" class="nav-link js_navigation_vertical__show"><span><i class="fal fa-plus"></i> Xem thêm</span></a>
    </li>
</ul>
<style>
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item>.dropdown-menu {
        position: absolute;
        top: 0;
        padding: 0px;
        min-width: 230px;
        border-radius: 0;
        box-shadow: 0 0 15px -5px rgba(0,0,0,0.4);
        color: var(--navd-txt-color);
        background-color: var(--navd-bg-color);
        left: calc(100%) !important;
        border: 0;margin-top: 0;
        width: 700px;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .dropdown>.dropdown-menu >.col-menu{
        float: left;width: 33%;margin-bottom: 10px; padding:0 10px;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item>.dropdown-menu h5 {
        margin-bottom: 0;border-bottom: 1px solid #ccc;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item>.dropdown-menu a.nav-link {
        padding: 10px;margin: 0;
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item:hover,
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item:hover>a.nav-link,
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item a.nav-link:hover {
        color: var(--navd-txt-color-hv);
        background-color: var(--navd-bg-color-hv);
    }
    .menu-vertical .menu-vertical__content .menu-vertical__category__nav .nav-item:hover>.dropdown-menu {
        display: block;
        min-width: 200px;
        width: auto;
    }
</style>