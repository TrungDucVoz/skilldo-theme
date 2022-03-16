<?php
Class ThemeTopBarStyle3 {
    static function render() {
        if(Option::get('top_bar_public') == 1) include_once 'top-bar-html.php';
    }
    static function css() {
        include 'top-bar-css.php';
    }
    static function options() {
        include 'top-bar-option.php';
    }
    static function navigation() {
        ThemeMenu::addLocation('top-bar', 'Menu top bar');
    }
}

if(!Admin::is()) {
    add_action('cle_header_top_bar', 'ThemeTopBarStyle3::render');
    add_action('theme_custom_css_no_tag', 'ThemeTopBarStyle3::css');
}
else {
    add_action('theme_option_setup', 'ThemeTopBarStyle3::options', 22);
    add_action('init', 'ThemeTopBarStyle3::navigation');
}
