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
        font-weight: bold;
    }
    .top-bar a { color: var(--top-bar-txt-color); font-weight: bold; }
</style>