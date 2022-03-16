<style>
    /** HEADING **/
    .header-title { border-bottom: 2px; text-align: center; margin-bottom: 10px; }
    .header, .header-title .header { color:#000; font-weight: bold; font-size: 18px; margin:0; }
    .header-title .header:before { border-bottom: 2px solid red; }
    /** HEADER Mobile **/
    .header-mobile {
        background-color:<?php echo (Option::get('header_mobile_bg_color')) ? Option::get('header_mobile_bg_color'):'#fff';?>;
    }
    /** footer */
    footer {
        padding:50px 0;
        background-blend-mode: color-burn;
        <?php echo (Option::get('footer_bg_color')) ? 'background-color:'.Option::get('footer_bg_color').';':'';?>
        <?php echo (Option::get('footer_bg_image')) ? 'background-image:url(\''.get_img_link(Option::get('footer_bg_image')).'\');background-size:cover;':'';?>
        <?php echo (Option::get('footer_text_color')) ? 'color:'.Option::get('footer_text_color').';':'';?>
    }
    footer a { <?php echo (Option::get('footer_text_color')) ? 'color:'.Option::get('footer_text_color').';' : '';?> }
    footer .header, footer .header-title .header {
        <?php echo (Option::get('footer_header_color')) ? 'color:'.Option::get('footer_header_color').';':'';?>
        margin:0;
    }
    @media (min-width: 768px) {
        .container {
            max-width: 1200px;
            width: 100%;
        }
    }
    @media (min-width: 1200px) {
        .container {
            max-width: 1320px;
            width: 100%;
        }
    }

    <?php do_action('theme_custom_css');?>
</style>