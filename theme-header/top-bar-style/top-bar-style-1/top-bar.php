<?php
Class ThemeTopBarStyle1 {
    static function render() {
        if(Option::get('top_bar_public') == 1) include_once 'top-bar-html.php';
    }
    static function css() {
        include 'top-bar-css.php';
    }
    static function options() {
        include 'top-bar-option.php';
    }
}

if(!Admin::is()) {
    add_action('cle_header_top_bar', 'ThemeTopBarStyle1::render');
    add_action('theme_custom_css_no_tag', 'ThemeTopBarStyle1::css');
}
else {
    add_action('theme_option_setup', 'ThemeTopBarStyle1::options', 22);
}
