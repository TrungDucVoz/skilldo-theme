<style type="text/css">
    :root {
        --header-logo-height:<?php echo option::get('logo_height');?>px;
        --header-search-br-color:<?php echo option::get('search_border_color', 'red');?>;
        --header-search-bg-color:<?php echo option::get('search_bg_color', '#fff');?>;
        --header-search-btn-width:70px;
        --header-search-btn-bg-color:<?php echo option::get('search_btn_bg_color', '#000');?>;
        --header-search-btn-txt-color:<?php echo option::get('search_btn_txt_color', '#fff');?>;
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
        background-color:transparent;
        height: 45px;  }
    header .search .form-search .btn-search {
        width:var(--header-search-btn-width);
        background-color:var(--header-search-btn-bg-color);
        color:var(--header-search-btn-txt-color);
        border:2px solid var(--header-search-btn-bg-color);
    }
    header .header-content .cart-top .btn-cart-top { margin-top:0px; }
    header .header-content .cart-top img { width:30px;}
</style>