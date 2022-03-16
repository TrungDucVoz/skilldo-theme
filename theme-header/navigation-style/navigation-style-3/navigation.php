<?php
Class ThemeNavigationStyle3 {

    public static $path = 'theme-header/navigation-style/navigation-style-3/';

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

    static function inputItem($param, $value = array()) {
        if(!have_posts($value)) $value = [];
        $value_default = array( 'image' => '', 'title' => '', 'description' => '' );
        //Số Lượng item
        $number = (isset($param->number)) ? (int)$param->number : 1;
        $output = '';
        $Form = new FormBuilder();
        for ( $i = 0; $i <= $number; $i++ ) {
            if(!isset($value[$i]) || !is_array($value[$i])) $value[$i] = array();
            $value[$i] = array_merge($value_default, $value[$i]);
            $output .= '<label for="name" class="control-label">Item '.($i+1).'</label>';
            $output .= '<div class="stote_wg_item">';
            $Form->add($param->field.'['.$i.'][image]', 'image', [ 'label' => 'Hình ảnh',
                'after' => '<div class="builder-col-12 col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['image']);
            $Form->add($param->field.'['.$i.'][title]', 'text', [ 'label' => 'Tiêu đề',
                'after' => '<div class="builder-col-6 col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['title']);
            $Form->add($param->field.'['.$i.'][description]', 'text', [ 'label' => 'Mô tả',
                'after' => '<div class="builder-col-5 col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['description']);
            if(Language::hasMulti()) {
                foreach (Language::list() as $lang_key => $lang_val) {
                    if($lang_key == Language::default()) continue;
                    $value[$i]['title_'.$lang_key] = (!empty($value[$i]['title_'.$lang_key])) ? $value[$i]['title_'.$lang_key] : '';
                    $value[$i]['description_'.$lang_key] = (!empty($value[$i]['description_'.$lang_key])) ? $value[$i]['description_'.$lang_key] : '';
                    $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', [ 'label' => 'Tiêu đề ('.$lang_val['label'].')',
                        'after' => '<div class="builder-col-6 col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['title_'.$lang_key]);
                    $Form->add($param->field.'['.$i.'][description_'.$lang_key.']', 'text', [ 'label' => 'Mô tả ('.$lang_val['label'].')',
                        'after' => '<div class="builder-col-6 col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['description_'.$lang_key]);
                }
            }
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}
if(!class_exists('store_nav_menu_vertical')) {
    class store_nav_menu_vertical extends walker_nav_menu
    {

        function start_el(&$output, $item, $depth = 0, $args = array(), $number = 0)
        {

            if (!empty($item->data['target'])) {
                $item->target = $item->data['target'];
            }

            $class = have_posts($item->child) ? 'dropdown ' : '';
            $class .= isset($item->class) ? $item->class : '';
            if ($number >= 8 && $depth == 0) {
                $class .= ' nav-hidden';
            }
            $output .= '<li class="nav-item ' . $class . '">';
            $atts = array();
            $atts['title'] = isset($item->attr) ? $item->attr : '';
            $atts['target'] = isset($item->target) ? $item->target : '';
            $atts['rel'] = isset($item->xfn) ? $item->xfn : '';
            $atts['href'] = isset($item->slug) ? get_url($item->slug) : '';
            $atts['class'] = 'nav-link';
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            $icon = '';
            if (!empty($item->data['icon'])) {
                $icon = '<div class="icon">' . Template::img($item->data['icon'], $item->name, ['return' => true]) . '</div>';
            }
            $output .= '<a ' . $attributes . '>' . $icon . '<span>' . $item->name . '</span></a>';
            if (have_posts($item->child)) $output .= '<i class="fal fa-angle-right"></i>';
        }

        function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $output .= '</li>';
        }
    }
}

if(!Admin::is()) {
    add_action('cle_header_navigation', 'ThemeNavigationStyle3::render');
    add_action('theme_custom_css_no_tag', 'ThemeNavigationStyle3::css');
    add_action('theme_custom_script_no_tag', 'ThemeNavigationStyle3::script');
}
else {
    add_action('theme_option_setup', 'ThemeNavigationStyle3::options', 20);
    add_action('init', 'ThemeNavigationStyle3::location');
    add_action('init', 'ThemeNavigationStyle3::sidebar');
}
