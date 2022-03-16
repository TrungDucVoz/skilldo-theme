<?php
Class ThemeHeaderStyle1_5 {

    public static $path = 'theme-header/header-style/header-style-1.5/';

    static function render() {
        $logo       = Option::get('logo_header');
        $listItem   = Option::get('header_item');

        if(empty($listItem)) {
            $listItem = [
                [
                    'image' => 'https://cdn.sikido.vn/images/demo/icon-item.png',
                    'title' => 'Đăng ký nhận báo giá',
                    'url' => ''
                ],
                [
                    'image' => 'https://cdn.sikido.vn/images/demo/icon-item.png',
                    'title' => 'Khuyến mãi',
                    'url' => ''
                ]
            ];
        }

        $headerData = [
            'logo' => (!empty($logo)) ? $logo : 'https://cdn.sikido.vn/images/demo/logo-demo-1.png',
            'listItem' => $listItem
        ];
        ?>
        <header class="">
            <!-- top bar -->
            <?php do_action('cle_header_top_bar'); Template::partial(self::$path.'header-html', $headerData); do_action('cle_header_navigation');?>
        </header>
        <?php
    }

    static function navigation() {
        ThemeMenu::addLocation('main-nav','Menu Chính');
    }

    static function css() {
        $background = Option::get('header_bg');

        if(empty($background)) {
            $background = ['color' => Option::get('header_bg_color'), 'image' => Option::get('header_bg_image')];
        }

        $color = (!empty($background['color'])) ? $background['color'] : '';
        $image = (!empty($background['image'])) ? $background['image'] : '';
        $gradientUse = (empty($background['gradientUse'])) ? 0 : 1;

        //CSS
        $css = '';

        if(!empty($color)) $css .= 'background-color:'.$color.';';

        //background gradient
        if(!empty($gradientUse)) {
            $gradientColor1 = (empty($background['gradientColor1'])) ? '' : $background['gradientColor1'];
            $gradientColor2 = (empty($background['gradientColor2'])) ? '' : $background['gradientColor2'];
            $gradientType = (empty($background['gradientType'])) ? 'linear-gradient' : $background['gradientType'].'-gradient';
            $gradientPositionStart = (empty($background['gradientPositionStart'])) ? 0 : $background['gradientPositionStart'];
            if($gradientType == 'linear-gradient') {
                $gradientRadialDirection = (empty($background['gradientRadialDirection2'])) ? '180deg' : $background['gradientRadialDirection2'].'deg';
            }
            else {
                $gradientRadialDirection = 'circle at '.((empty($background['gradientRadialDirection1'])) ? 'center' : $background['gradientRadialDirection1']);
            }
            $gradientPositionEnd = (empty($background['gradientPositionEnd'])) ? 100 : $background['gradientPositionEnd'];
            $gradient = $gradientType.'('.$gradientRadialDirection.','.$gradientColor1.' '.$gradientPositionStart.'%, '.$gradientColor2.' '.$gradientPositionEnd.'%)';
        }

        //background image
        if(!empty($image)) {
            $imageSize = (!empty($background['imageSize'])) ? $background['imageSize'] : 'cover';
            $imagePosition = (!empty($background['imagePosition'])) ? $background['imagePosition'] : 'center center';
            $imageRepeat = (!empty($background['imageRepeat'])) ? $background['imageRepeat'] : 'no-repeat';
            $css .= 'background-image:url(\''.Template::imgLink($image).'\')'.((!empty($gradient)) ? ','.$gradient.';' : ';');
            $css .= 'background-size:'.$imageSize.';background-repeat: '.$imageRepeat.'; background-position: '.$imagePosition.';background-blend-mode: color-burn;';
        }
        else if(!empty($gradient)) {
            $css .= 'background:'.$gradient.';';
        }
        $logoHeight = (empty(Option::get('logo_height'))) ? '70' : Option::get('logo_height');

        $search = [
            'border'     => (empty(Option::get('search_border_color'))) ? Option::get('theme_color') : Option::get('search_border_color'),
            'background' => Option::get('search_bg_color', '#fff'),
            'btnBg'      => (empty(Option::get('search_btn_bg_color'))) ? Option::get('theme_color') : Option::get('search_btn_bg_color'),
            'btnColor'   => Option::get('search_btn_txt_color', '#fff'),
        ];

        $item = [
            'titleColor' => (empty(Option::get('header_item_title_color'))) ? '#fff' : Option::get('header_item_title_color'),
            'background' => (empty(Option::get('header_item_bg_color'))) ? Option::get('theme_color') : Option::get('header_item_bg_color'),
        ];

        $headerCssData = [
            'logoHeight' => $logoHeight,
            'background' => $css,
            'search' => $search,
            'item' => $item
        ];

        Template::partial(self::$path.'header-css', $headerCssData);
    }

    static function script() { Template::partial(self::$path.'header-script'); }

    static function options() { Template::partial(self::$path.'header-option'); }

    static function inputItem($param, $value = array()) {
        if(!have_posts($value)) $value = [];
        $value_default = array( 'image' => '', 'title' => '', 'url' => '' );
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
                'after' => '<div class="col-md-12"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['image']);
            $Form->add($param->field.'['.$i.'][title]', 'text', [ 'label' => 'Tiêu đề',
                'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['title']);
            if(Language::hasMulti()) {
                foreach (Language::list() as $lang_key => $lang_val) {
                    if($lang_key == Language::default()) continue;
                    $value[$i]['title_'.$lang_key] = (!empty($value[$i]['title_'.$lang_key])) ? $value[$i]['title_'.$lang_key] : '';
                    $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', [ 'label' => 'Tiêu đề ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['title_'.$lang_key]);
                }
            }
            $Form->add($param->field.'['.$i.'][url]', 'text', [ 'label' => 'Liên kết', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>'], $value[$i]['url']);
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}

if(!Admin::is()) {
    add_action('cle_header_desktop', 'ThemeHeaderStyle1_5::render');
    add_action('theme_custom_css_no_tag', 'ThemeHeaderStyle1_5::css');
    add_action('theme_custom_script_no_tag', 'ThemeHeaderStyle1_5::script');
}
else {
    add_action('init', 'ThemeHeaderStyle1_5::navigation');
    add_action('theme_option_setup', 'ThemeHeaderStyle1_5::options', 20);
}