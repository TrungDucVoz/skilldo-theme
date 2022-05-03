<?php
Class ThemeHeaderStyle1_7 {

    public static $path = 'theme-header/header-style/header-style-1.7/';

    static function render() {
        $logo       = Option::get('logo_header');
        $iconCart   = Option::get('header_icon_cart');
        $iconPhone   = Option::get('header_icon_hotline');
        $headerData = [
            'logo' => (!empty($logo)) ? $logo : 'https://cdn.sikido.vn/images/demo/logo-demo-1.png',
            'iconCart' => (!empty($iconCart)) ? $iconCart : 'https://cdn.sikido.vn/images/demo/cart-1.png',
            'iconPhone' => (!empty($iconPhone)) ? $iconPhone : 'https://cdn.sikido.vn/images/demo/phone-1.png',
            'phone' => (!empty(Option::get('contact_phone'))) ? Option::get('contact_phone') : '0909 999 999',
            'phone2' => Option::get('contact_phone2')
        ];
        ?>
        <header class="">
            <!-- top bar -->
            <?php
            do_action('cle_header_top_bar'); Template::partial(self::$path.'header-html', $headerData); do_action('cle_header_navigation');
            ?>
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

        $radius = Option::get('search_border_radius');

        $search = [
            'border'     => (empty(Option::get('search_border_color'))) ? Option::get('theme_color') : Option::get('search_border_color'),
            'radius'     => ($radius != '') ? $radius : 5,
            'background' => Option::get('search_bg_color', '#fff'),
            'btnBg'      => (empty(Option::get('search_btn_bg_color'))) ? Option::get('theme_color') : Option::get('search_btn_bg_color'),
            'btnColor'   => Option::get('search_btn_txt_color', '#fff'),
        ];

        $headerCssData = [
            'logoHeight' => $logoHeight,
            'background' => $css,
            'search' => $search,
            'cartColor' => (!empty(Option::get('cart_color'))) ? Option::get('cart_color') : '#000',
        ];

        Template::partial(self::$path.'header-css', $headerCssData);
    }

    static function script() { Template::partial(self::$path.'header-script'); }

    static function options() { Template::partial(self::$path.'header-option'); }

    static function registerInputPhone2($input) {
        $input[] = ['field' => 'contact_phone2', 'label' => 'Điện thoại 2', 'type'  => 'tel'];
        return $input;
    }

    static function saveInputPhone2($contact, $data) {
        if(isset($data['contact_phone2'])) {
            $contact['contact_phone2'] = Str::clear($data['contact_phone2']);
        }
        return $contact;
    }
}

if(!Admin::is()) {
    add_action('cle_header_desktop', 'ThemeHeaderStyle1_7::render');
    add_action('theme_custom_css_no_tag', 'ThemeHeaderStyle1_7::css');
    add_action('theme_custom_script_no_tag', 'ThemeHeaderStyle1_7::script');
}
else {
    add_action('init', 'ThemeHeaderStyle1_7::navigation');
    add_action('theme_option_setup', 'ThemeHeaderStyle1_7::options', 30);
    add_action('system_contact_input', 'ThemeHeaderStyle1_7::registerInputPhone2', 30);
    add_action('skd_system_cms_contact_save', 'ThemeHeaderStyle1_7::saveInputPhone2', 30, 2);
}