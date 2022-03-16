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
        background:var(--top-bar-bg);
        color: var(--top-bar-txt-color);
    }
    .top-bar a { color: var(--top-bar-txt-color); }
    .navigation-top-bar {
        text-align: left; padding: 0; box-shadow: none;
    }
    .navigation-top-bar .navbar {
        background-color: transparent; border: 0; min-height: 0; margin-bottom: 0;
    }
    .navigation-top-bar .navbar-collapse { padding:0; }
    .navigation-top-bar .navbar-nav>li>a {
        color: var(--top-bar-txt-color);
        text-transform: uppercase;
        padding:5px 10px; font-size: 13px;
    }
    .navigation-top-bar .navbar-nav>li>a .icon {
        text-align: center;
    }
    .navigation-top-bar .navbar-nav>li>a .icon img {
        height: 20px; display: inline-block;
    }
</style>