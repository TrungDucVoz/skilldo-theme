<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-br-color:<?php echo $search['border'];?>;
        --header-search-bg-color:<?php echo $search['background'];?>;
        --header-search-btn-bg-color:<?php echo $search['btnBg'];?>;
        --header-search-btn-txt-color:<?php echo $search['btnColor'];?>;
        --header-search-btn-width:70px;
        --header-item-head-color:<?php echo $item['titleColor'];?>;
        --header-item-bg-color:<?php echo $item['background'];?>;
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
        display: flex !important;
        justify-content: right;
        gap:10px;
    }
    header .header-content .list-item .item {
        -ms-flex-align: center !important;
        align-items: center !important;
        display: -ms-flexbox !important;
        display: flex !important;
        justify-content: right;
    }
    header .header-content .list-item .item .img {
        margin-right:10px; width: 50px;flex: 0 0 50px;
        border-radius: 50%; border: 2px solid var(--header-item-bg-color);
        overflow: hidden;
        z-index: 2;
        background-color: #000;
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
        margin-left: -17px;
        font-weight: bold;
        font-size: 12px;
        color: var(--header-item-head-color);
        background-color:var(--header-item-bg-color);
        padding: 5px 20px 5px 10px;
        border-radius: 0 30px 30px 0;
        position: relative;
        z-index: 1;
    }
    header .header-content .list-item .item .title .heading a {
        color: var(--header-item-head-color);
    }
</style>