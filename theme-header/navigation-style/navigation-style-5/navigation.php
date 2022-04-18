<?php
Class ThemeNavigationStyle5 {

    public static $path = 'theme-header/navigation-style/navigation-style-5/';

    static function render() {
        Template::partial(self::$path.'navigation-html');
    }
    static function css() {
        Template::partial(self::$path.'navigation-css');
    }
    static function options() {
        Template::partial(self::$path.'navigation-option');
    }
    static function script() {
        Template::partial(self::$path.'navigation-script');
    }
    static function location() {
        ThemeMenu::addLocation(['main-vertical'	=> 'Menu danh mục trái']);
    }
    static function sidebar() {
        Sidebar::add('home-slider', 'Slider Top');
    }
}

if(!class_exists('store_nav_menu_vertical')) {
    class store_nav_menu_vertical extends walker_nav_menu {

        function start_el(&$output, $item, $depth = 0, $args = array(), $number = 0) {

            if(!empty($item->data['target'])) {
                $item->target = $item->data['target'];
            }

            $class          = have_posts($item->child) ?'dropdown ':'';
            $class          .= isset($item->class) ?$item->class:'';
            if($number >= 8 && $depth == 0) {
                $class  .= ' nav-hidden';
            }
            $output         .= '<li class="nav-item '.$class.'">';
            $atts           = array();
            $atts['title']  = isset( $item->attr )   ? $item->attr       : '';
            $atts['target'] = isset( $item->target ) ? $item->target     : '';
            $atts['rel']    = isset( $item->xfn )    ? $item->xfn        : '';
            $atts['href']   = isset( $item->slug )   ? get_url($item->slug)       : '';
            $atts['class']  = 'nav-link';
            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if (!empty($value)) {
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            $icon = '';
            if(!empty($item->data['icon'])) {
                $icon = '<div class="icon">'.Template::img($item->data['icon'], $item->name, ['return' => true]).'</div>';
            }
            $output .= '<a '.$attributes.'>'.$icon.'<span>'.$item->name.'</span></a>' ;
            if( have_posts($item->child) ) $output .= '<i class="fal fa-angle-right"></i>';
        }

        function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            $output .= '</li>';
        }
    }
}

if(!Admin::is()) {
    add_action('cle_header_navigation', 'ThemeNavigationStyle5::render');
    add_action('theme_custom_css_no_tag', 'ThemeNavigationStyle5::css');
    add_action('theme_custom_script_no_tag', 'ThemeNavigationStyle5::script');
}
else {
    add_action('theme_option_setup', 'ThemeNavigationStyle5::options', 20);
    add_action('init', 'ThemeNavigationStyle5::location');
    add_action('init', 'ThemeNavigationStyle5::sidebar');
}
