<?php
include_once (file_exists(Path::theme('theme-child/theme-setting/menu.php'))) ? Path::theme('theme-child/theme-setting/menu.php') : 'menu.php';
include_once (file_exists(Path::theme('theme-child/theme-setting/theme-ajax.php'))) ? Path::theme('theme-child/theme-setting/theme-ajax.php') : 'theme-ajax.php';
include_once (file_exists(Path::theme('theme-child/theme-setting/theme-form.php'))) ? Path::theme('theme-child/theme-setting/theme-form.php') : 'theme-form.php';
include_once (file_exists(Path::theme('theme-child/theme-setting/theme-option.php'))) ? Path::theme('theme-child/theme-setting/theme-option.php') : 'theme-option.php';
include_once (file_exists(Path::theme('theme-child/theme-setting/theme-style.php'))) ? Path::theme('theme-child/theme-setting/theme-style.php') : 'theme-style.php';
include_once (file_exists(Path::theme('theme-child/theme-setting/theme-sidebar.php'))) ? Path::theme('theme-child/theme-setting/theme-sidebar.php') : 'theme-sidebar.php';
function theme_custom_css($tag_style = true, $return = false) {
    ob_start();
    include_once (file_exists(Path::theme('theme-child/theme-setting/theme-custom-css.php'))) ? Path::theme('theme-child/theme-setting/theme-custom-css.php') : 'theme-custom-css.php';
    do_action('theme_custom_css_no_tag');
    $css = ob_get_contents();
    ob_end_clean();
    if($tag_style === false) {
        return (String)Str::of($css)
            ->replace('<style type="text/css">', '')
            ->replace('<style type=\'text/css\'>', '')
            ->replace('<style>', '')
            ->replace('</style>', '');
    }
    if($return == true) return $css;
    echo $css;
}
function theme_custom_css_minify() {
    $theme_custom_css_minify = CacheHandler::get('theme_custom_css_minify');
    if(DEBUG_LOG == true || DEBUG == true) {
        $theme_custom_css_minify = '';
    }
    if(!empty($theme_custom_css_minify)) {
        $css = $theme_custom_css_minify;
    }
    else {
        $ci = &get_instance();
        $ci->load->library('skd_minify');
        $css = $ci->skd_minify->_minify(theme_custom_css(false, true));
        CacheHandler::save('theme_custom_css_minify', $css, 365*24*60*60);//Lưu cache 1 năm
    }
    echo '<style '.((Template::isAmp()) ? 'amp-custom' : 'type="text/css"').'>'.$css.'</style>';
}
add_action('cle_header', 'theme_custom_css_minify', 999);
function theme_custom_script($tag_script = true, $return = false) {
    ob_start();
    include_once (file_exists(Path::theme('theme-child/theme-setting/theme-custom-script.php'))) ? Path::theme('theme-child/theme-setting/theme-custom-script.php') : 'theme-custom-script.php';
    do_action('theme_custom_script_no_tag');
    $script = ob_get_contents();
    ob_end_clean();
    if($tag_script === false) {
        return (String)Str::of($script)
            ->replace('<script type="text/javascript">', '')
            ->replace('<script type="text/javascript" defer>', '')
            ->replace('<script type="text/javascript" async>', '')
            ->replace('<script defer type="text/javascript">', '')
            ->replace('<script async type="text/javascript">', '')
            ->replace('<script type=\'text/javascript\'>', '')
            ->replace('<script type=\'text/javascript\' defer>', '')
            ->replace('<script type=\'text/javascript\' async>', '')
            ->replace('<script defer type=\'text/javascript\'>', '')
            ->replace('<script async type=\'text/javascript\'>', '')
            ->replace('<script>', '')
            ->replace('<script defer>', '')
            ->replace('<script async>', '')
            ->replace('</script>', '');
    }
    if($return == true) return $script;
    echo $script;
}
if (!Device::isGoogleSpeed()) {
    function header_script() {
        echo Option::get('header_script');
    }
    add_action('cle_header', 'header_script');
    function footer_script() {
        echo Option::get('footer_script');
    }
    add_action('cle_footer', 'footer_script');
}