<?php
Class ThemeTopBarStyle5 {
    static function render() {
        if(Option::get('top_bar_public') == 1) {

            $address    = Option::get('contact_adress');

            $email      = Option::get('contact_mail');

            $phone      = Option::get('contact_phone');

            if(empty($address)) $address = '213/14 Đường Nguyễn Gia Trí, Phường 25, Quận Bình Thạnh, TP Hồ Chí Minh';

            if(empty($email)) $email = 'hotro@sikido.vn';

            if(empty($phone)) $phone = '028 62941556';

            include_once 'top-bar-html.php';
        }
    }
    static function css() {
        $topBarBg   = Option::get('top_bar_bg_image');
        $topBarBg   = (!empty($topBarBg)) ? "url('".Template::imgLink($topBarBg)."')" : Option::get('top_bar_bg_color');
        if(empty($topBarBg)) $topBarBg = '#000';
        $topBarColor   = (!empty(Option::get('top_bar_text_color'))) ? Option::get('top_bar_text_color') : '#fff';
        $topBarFont         = (!empty(Option::get('top_bar_font'))) ? Option::get('top_bar_font') : Option::get('text_font');
        $topBarFontWeight   = (!empty(Option::get('top_bar_font_weight'))) ? Option::get('top_bar_font_weight') : '400';
        $topBarFontSize     = (!empty(Option::get('top_bar_font_size'))) ? Option::get('top_bar_font_size') : '14';
        $topBarHeight       = (!empty(Option::get('top_bar_height'))) ? Option::get('top_bar_height') : '40';

        include 'top-bar-css.php';
    }
    static function options() {
        include 'top-bar-option.php';
    }
}

if(!Admin::is()) {
    add_action('cle_header_top_bar', 'ThemeTopBarStyle5::render');
    add_action('theme_custom_css_no_tag', 'ThemeTopBarStyle5::css');
}
else {
    add_action('theme_option_setup', 'ThemeTopBarStyle5::options', 22);
}
