<?php
Class ThemeNavigationStyle4 {

    public static $path = 'theme-header/navigation-style/navigation-style-4/';

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
    add_action('cle_header_navigation', 'ThemeNavigationStyle4::render');
    add_action('theme_custom_css_no_tag', 'ThemeNavigationStyle4::css');
}
else {
    add_action('theme_option_setup', 'ThemeNavigationStyle4::options', 20);
}