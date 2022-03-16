<?php
function theme_layout_list( $layout_key = '' ) {

    $layout = array(
        'layout-full-width' => array(
            'label' => 'Full Width',
            'image' => 'layout/layout-full.png',
            'template' => 'template-full-width',
        ),
        'layout-full-width-banner' => array(
            'label'    => 'Full Width Banner',
            'image'    => 'layout/layout-full-banner.png',
            'template' => 'template-full-width',
            'banner'   => 'full-width'
        ),
        'layout-sidebar-left' => array(
            'label'     => 'Sidebar Left',
            'image'     => 'layout/layout-sidebar-left.png',
            'template'  => 'template-sidebar-left',
            'sidebar'   => 'left'
        ),
        'layout-sidebar-left-banner-1' => array(
            'label'     => 'Sidebar Left #1',
            'image'     => 'layout/layout-sidebar-left-banner-1.png',
            'template'  => 'template-sidebar-left',
            'banner'    => 'in-content',
            'sidebar'   => 'left'
        ),
        'layout-sidebar-left-banner-2' => array(
            'label' => 'Sidebar Left #2',
            'image' => 'layout/layout-sidebar-left-banner-2.png',
            'template' => 'template-sidebar-left',
            'banner'    => 'full-width',
            'sidebar'   => 'left'
        ),
        'layout-sidebar-right' => array(
            'label' => 'Sidebar Right',
            'image' => 'layout/layout-sidebar-right.png',
            'template' => 'template-sidebar-right',
            'sidebar'   => 'right'
        ),
        'layout-sidebar-right-banner-1' => array(
            'label' => 'Sidebar Right #1',
            'image' => 'layout/layout-sidebar-right-banner-1.png',
            'template' => 'template-sidebar-right',
            'banner'    => 'in-content',
            'sidebar'   => 'right'
        ),
        'layout-sidebar-right-banner-2' => array(
            'label' => 'Sidebar Right #2',
            'image' => 'layout/layout-sidebar-right-banner-2.png',
            'template' => 'template-sidebar-right',
            'banner'    => 'full-width',
            'sidebar'   => 'right'
        ),
    );

    if($layout_key != '' && isset($layout[$layout_key])) return $layout[$layout_key];

    return $layout;
}

function get_theme_layout() {

    $layout = '';

    if( Template::isPage('page_detail'))    $layout = option::get('layout_page', 'layout-full-width-banner');

    if( Template::isPage('post_detail'))    $layout = option::get('layout_post', 'layout-sidebar-right-banner-2');

    if( Template::isPage('post_index'))     $layout = option::get('layout_post_category', 'layout-sidebar-right-banner-2');

    if( Template::isPage('products_index')) $layout = option::get('layout_products_category', 'layout-sidebar-right-banner-2');

    $layout_data = theme_layout_list($layout);

    if(!Admin::is()) {

        if($layout == 'layout-full-width-banner' || $layout == 'layout-sidebar-left-banner-2' || $layout == 'layout-sidebar-right-banner-2' ) {

            $setting = get_theme_layout_setting();

            if(!empty($setting['banner'])) {

                $layout_data['banner'] = $setting['banner'];
            }
        }
    }

    return $layout_data;
}

function get_theme_layout_setting( $key = '' ) {

    if($key == '') {
        if( Template::isPage('post_index'))      $key = 'post_category';
        if( Template::isPage('post_detail'))     $key = 'post';
        if( Template::isPage('products_index'))  $key = 'products_category';
    }

    $setting['post_category'] = array(
        'style' => 'vertical',
        'sidebar' => array(
            'new' => array(
                'toggle' => 1,
                'title'  => 'Tin tức mới',
                'data'   => 'post-category-current',
                'limit'  => 5,
            ),
            'hot' => array(
                'toggle' => 1,
                'title'  => 'Tin tức nổi bật',
                'data'   => 'post-category-current',
                'limit'  => 5,
            ),
            'sidebar' => array(
                'toggle' => 0,
                'data'   => '',
            ),
            'sub' => array(
                'toggle' => 1,
                'data'   => 'post-category-current',
                'limit'  => 5,
                'status' => 'new',
            ),
        ),
        'horizontal' => array(
            'category_row_count'        => 2,
            'category_row_count_tablet' => 2,
            'category_row_count_mobile' => 1,
        )
    );

    $setting['post'] = array(
        'sidebar' => array(
            'new' => array(
                'toggle' => 1,
                'title'  => 'Tin tức mới',
                'data'   => 'post-category-current',
                'limit'  => 5,
            ),
            'hot' => array(
                'toggle' => 1,
                'title'  => 'Tin tức nổi bật',
                'data'   => 'post-category-current',
                'limit'  => 5,
            ),
            'related' => array(
                'toggle' => 1,
                'title'  => 'Tin tức liên quan',
                'limit'  => 5,
            ),
            'sidebar' => array(
                'toggle' => 0,
                'data'   => '',
            ),
            'sub' => array(
                'toggle' => 1,
                'data'   => 'post-category-current',
                'limit'  => 5,
                'status' => 'new',
            ),
        ),
    );

    $setting['products_category'] = [];

    $setting['banner'] = array(
        'height'            => 200,
        'type'              => 'center',
        'page'              => 'full-width',
        'post'              => 'full-width',
        'post_category'     => 'full-width',
        'products_category' => 'full-width',
    );

    if( $key == '' ) return [];

    $setting_layout = array_merge($setting[$key], option::get('layout_'.$key.'_setting', $setting[$key]));

    if($key != 'banner') {
        $banner = array_merge($setting['banner'], option::get('layout_banner_setting', $setting['banner']));
        $setting_layout['banner'] = $banner[$key];
    }

    return $setting_layout;
}

include 'theme-setting-sidebar.php';

if( Admin::is() && (Admin::isRoot() || Auth::hasCap('builder')) && cms_uslg_license() !== false) {

    include 'theme-layout-ajax.php';

    AdminMenu::addSub('theme', 'theme-layout', 'Theme Layout', 'plugins?page=theme-layout&type=layout', ['callback' => 'theme_layout']);

    function theme_layout() {

        $ci =& get_instance();

        $ci->load->helper('directory');

        $type = InputBuilder::get('type');

        $type_object = InputBuilder::get('object');

        $type_object = (!empty($type_object)) ? $type_object : 'layout';

        if($type == 'header' || $type == 'navigation' || $type == 'top-bar') {

            $path 		= FCPATH.VIEWPATH.$ci->data['template']->name.'/theme-header/'.$type.'-style';

            $url        = base_url(VIEWPATH.$ci->data['template']->name.'/theme-header/'.$type.'-style');

            $header_style_active 	= Option::get('header_style_active', []);

            if($type == 'header') {
                $service 	= $ci->service_api->gets_header();
            }

            if($type == 'top-bar') {
                $service 	= $ci->service_api->gets_top_bar();
            }

            if($type == 'navigation') {
                $service 	= $ci->service_api->gets_navigation();
            }


            $dir = directory_map( $path, true );

            if(isset($service->status) && $service->status == 'success') {

                $service = $service->data;

                $temp = [];

                foreach ($service as $value) {
                    $temp[$value->folder] = ['id' => $value->id, 'title' => $value->title, 'image' => $value->image, 'folder' => $value->folder];
                }

                $service = $temp;
            }
            else $service = [];

            if(have_posts($dir)) {

                $temp = [];

                foreach ($dir as $value) {
                    $temp[$value] = ['id' => 0, 'title' => $value, 'image' => $url.'/'.$value.'/'.$value.'.png', 'folder' => $value];
                }

                $dir = $temp;
            }

            $header_data = array_merge($dir, $service);

            ksort($header_data);
        }

        if($type == 'heading') {

            $headingSidebarActive = Option::get('sidebar_heading_style', 'none');

            $headingWidgetActive = Option::get('widget_heading_style', 'none');

            $headingService 	= $ci->service_api->gets_heading();

            $headingWidgets = [];

            $headingSidebar = [];

            if(isset($headingService->status) && $headingService->status == 'success') {

                $headingDownload = array_merge(ThemeSidebar::registerHeading(), ThemeWidget::registerHeading());

                $headingService = $headingService->data;

                foreach ($headingService as $value) {

                    $temp = [
                        'id' => $value->id,
                        'name' => $value->name,
                        'image' => $value->image,
                        'slug' => $value->slug,
                        'download' => (!empty($headingDownload[$value->slug])) ? false : true,
                    ];

                    if(in_array('sidebar', $value->tags) !== false) {
                        $headingSidebar[$value->slug] = $temp;
                    }
                    if(in_array('widget', $value->tags) !== false) {
                        $headingWidgets[$value->slug] = $temp;
                    }
                }
            }
        }

        include_once 'html/theme_layout_html.php';
    }
}

$headerStyleActive = Option::get('header_style_active', []);

if(have_posts($headerStyleActive)) {
    foreach ($headerStyleActive as $type => $list_dir) {

        if(!have_posts($list_dir)) continue;

        $path = FCPATH. VIEWPATH . get_instance()->data['template']->name.'/theme-header/';

        $pathChild = FCPATH. VIEWPATH . get_instance()->data['template']->name.'/theme-child/theme-header/';

        foreach ($list_dir as $key_dir => $dir) {

            if(file_exists($pathChild.$type.'-style/'.$key_dir.'/'.$type.'.php')) {
                include_once $pathChild.$type.'-style/'.$key_dir.'/'.$type.'.php';
            }
            else if(file_exists($path.$type.'-style/'.$key_dir.'/'.$type.'.php')) {
                include_once $path.$type.'-style/'.$key_dir.'/'.$type.'.php';
            }

            if(file_exists($pathChild.$type.'-style/'.$key_dir.'/'.$type.'-function.php')) {
                include_once $pathChild.$type.'-style/'.$key_dir.'/'.$type.'-function.php';
            }
            else if(file_exists($path.$type.'-style/'.$key_dir.'/'.$type.'-function.php')) {
                include_once $path.$type.'-style/'.$key_dir.'/'.$type.'-function.php';
            }
        }
    }
}

$directoryHeading = Path::theme().'theme-header/heading-style/';

$directoryHeadingChild = Path::theme().'theme-child/theme-header/heading-style/';

foreach (glob($directoryHeading.'*.php') as $filename) {

    $filename = str_replace($directoryHeading, '', $filename);

    if(file_exists($directoryHeadingChild.$filename)) {
        include_once directoryHeadingChild.$filename;
    }
    else if(file_exists($directoryHeading.$filename)) {
        include_once $directoryHeading.$filename;
    }
}