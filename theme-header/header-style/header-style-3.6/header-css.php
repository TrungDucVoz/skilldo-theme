<style type="text/css">
    header {
        --header-logo-height:<?php echo $logoHeight;?>px;
        --header-search-bg:<?php echo $searchBg;?>;
        --header-search-color:<?php echo $searchColor;?>;
        --header-hotline-bg:<?php echo $hotlineBg;?>;
        --header-hotline-color:<?php echo $hotlineColor;?>;
        --header-txt-color:<?php echo $txtColor;?>;
    }
    header .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    header .header-content {
        padding:10px 0;
        <?php echo $background;?>
    }
    header .logo img { max-height: var(--header-logo-height); }
    header .header-content .navigation .container { width:100%!important; padding:0!important;}
    header .header-content .btn-search {
        font-size: 20px; font-weight: bold;
        padding:5px 10px; border-radius: 4px;
        background-color: var(--header-search-bg);
        color: var(--header-search-color);
        display: inline-block;
    }

    header .hotline {
        display: inline-block;
        background-color: var(--header-hotline-bg);
        color: var(--header-hotline-color);
        border-radius: 4px;
        padding:5px 15px;
        font-weight: bold;
    }
    header .header-right-text {
        width: 100%; text-align: left; margin-top: 5px;
    }
    header .header-right-text a {
        color: var(--header-txt-color); font-weight: bold;
    }
</style>