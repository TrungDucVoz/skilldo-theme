<style>
    body, .wrapper {
        <?php
        $background = Option::get('bodyBg');
        if(empty($background)) {
            $bgColor    = Option::get('body_color');
            $bgImg      = Option::get('body_img');
            $background = ['color' => $bgColor, 'image' => $bgImg];
            if(!empty($bgColor) || !empty($bgImg)) {
                Option::update('bodyBg', $background);
            }
        }
        echo Template::cssBg($background);
        ?>
    }
    /** footer */
    footer {
        <?php
        $background = Option::get('footer_bg');
        if(empty($background)) {
            $bgColor    = Option::get('footer_bg_color');
            $bgImg      = Option::get('footer_bg_image');
            $background = ['color' => $bgColor, 'image' => Option::get('footer_bg_image')];
            if(!empty($bgColor) || !empty($bgImg)) {
                Option::update('footer_bg', $background);
            }
        }
        echo Template::cssBg($background);
        ?>
    }
    <?php do_action('theme_custom_css');?>
</style>