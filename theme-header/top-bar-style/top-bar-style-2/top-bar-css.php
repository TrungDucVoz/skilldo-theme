<?php
    $top_bar_bg_image   = option::get('top_bar_bg_image');
?>
<style type="text/css">
    :root {
        <?php if(empty($top_bar_bg_image)) {?>
        --top-bar-bg:<?php echo option::get('top_bar_bg_color');?>;
        <?php } else { ?>
        --top-bar-bg:url('<?php echo Template::imgLink($top_bar_bg_image);?>');
        <?php } ?>
        --top-bar-txt-color:<?php echo option::get('top_bar_text_color');?>;
    }
    .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center;
    }
    #top-bar {
        background-color:var(--top-bar-bg);
        color: var(--top-bar-txt-color);
    }
    .top-bar a { color: var(--top-bar-txt-color); }

    #top-bar .group-account {
        overflow:hidden;
        line-height: 50px;
        padding-right: 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    #top-bar .group-account i {
        width:40px; margin-right: 10px;
    }
    #top-bar .group-account span {
        font-size: 15px;
        color: var(--header-hotline-color-phone);
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    #top-bar .group-account .account-popup {
        display: none;
        position: absolute;
        top: 40px;
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
    #top-bar .group-account .account-popup:before {
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
    #top-bar .group-account .account-popup:after {
        top: -20px;
        right: 0;
        content: " ";
        height: 20px;
        width: 100%;
        position: absolute;
    }
    #top-bar .group-account .account-popup a {
        display: block;
        font-size: 15px;
        text-align: center;
        margin-bottom: 10px;
    }
    #top-bar .group-account .account-popup a:hover { background: #fff; color: var(--theme-color);; border: solid 1px var(--theme-color);; }
    #top-bar .group-account .account-popup a:last-child { margin-bottom:0; }
    #top-bar .group-account:hover .account-popup {
        display: block;
    }
</style>