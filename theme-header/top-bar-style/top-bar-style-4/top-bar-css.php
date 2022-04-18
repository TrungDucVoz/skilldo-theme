<style type="text/css">
    :root {
        --top-bar-bg:<?php echo $topBarBg;?>;
        --top-bar-txt-color:<?php echo $topBarColor;?>;
        --top-bar-font:<?php echo $topBarFont;?>;
        --top-bar-weight:<?php echo $topBarFontWeight;?>;
        --top-bar-font-size:<?php echo $topBarFontSize;?>px;
        --top-bar-height:<?php echo $topBarHeight;?>px;
    }
    .top-bar {
        background:var(--top-bar-bg);
        color: var(--top-bar-txt-color);
        line-height: var(--top-bar-height); min-height: var(--top-bar-height);
    }
    .top-bar .row-flex-center {
        display: flex; flex-wrap: wrap; align-items: center; gap:15px;
        width: 100%;
    }
    .top-bar .row-flex-center .top-bar-item:nth-of-type(3){
        margin-left: auto;
    }
    .top-bar, .top-bar a, .top-bar span, .top-bar p {
        color: var(--top-bar-txt-color);
        font-family:var(--top-bar-font);
        font-weight:var(--top-bar-weight);
        font-size:var(--top-bar-font-size);
    }
    .top-bar i { color: yellow; }
</style>