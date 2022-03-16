<?php
Class ThemeNavigationStyle4_1 {

    public static $path = 'theme-header/navigation-style/navigation-style-4.1/';

    static function render() {
        Template::partial(self::$path.'navigation-html');
    }
    static function css() {
        Template::partial(self::$path.'navigation-css');
    }
    static function options() {
        Template::partial(self::$path.'navigation-option');
    }
}

if(!Admin::is()) {
    add_action('cle_header_navigation', 'ThemeNavigationStyle4_1::render');
    add_action('theme_custom_css_no_tag', 'ThemeNavigationStyle4_1::css');
}
else {
    add_action('theme_option_setup', 'ThemeNavigationStyle4_1::options', 20);
}