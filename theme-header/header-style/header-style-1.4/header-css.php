<style type="text/css">
    :root {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-item-head-color:<?php echo option::get('header_item_title_color', '#ed860a');?>;
        --header-item-txt-color:<?php echo option::get('header_item_description_color', '#ed860a');?>;
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .header-content .list-item {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-pack: distribute !important;
        justify-content: space-around !important;
        padding:10px 0;
    }
    header .header-content .list-item .item {
        margin: 0px 5px;
        -ms-flex-align: center !important;
        align-items: center !important;
        display: -ms-flexbox !important;
        display: flex !important;
    }
    header .header-content .list-item .item .img {
        margin-right:10px;
    }
    header .header-content .list-item .item .img img {
        max-height:50px;
    }
    header .header-content .list-item .item .title {
        text-align: left !important;
        font-size:15px;
    }
    header .header-content .list-item .item .title .heading {
        margin-top:0;
        margin-bottom:0;
        font-weight: bold;
        font-size: 14px;
        color: var(--header-item-head-color);
    }
    header .header-content .list-item .item .title p.description {
        margin:0;
        color: var(--header-item-txt-color);
    }
</style>