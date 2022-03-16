<?php
Class Theme_Ajax_Element {
    static public function download($ci, $model) {

		$result['message'] 	= 'Download header không thành công';

		$result['status'] 	= 'error';

		if(InputBuilder::post()) {

			$id 	= InputBuilder::post('id');

			$type 	= InputBuilder::post('type');

			$hd 	= [];

			if($type == 'header') 	$hd = $ci->service_api->get_header_download($id);

			if($type == 'navigation') $hd = $ci->service_api->get_navigation_download($id);

			if($type == 'top-bar') 	$hd = $ci->service_api->get_top_bar_download($id);

			if($type == 'heading') 	$hd = $ci->service_api->get_heading_download($id);

			if(!have_posts($hd) || $hd->status == 'error') {
				echo json_encode($result);
				return false;
			}

            $url = $hd->file;

            $dir = VIEWPATH.$ci->data['template']->name.'/theme-header/'.$type.'-style/';

            $temp_filename = basename( $url );

            $temp_filename = preg_replace( '|\.[^.]*$|', '', $temp_filename );

            $temp_filename  = $dir . $temp_filename . '.zip';

            $headers = getHeaders($url);

            if ($headers['http_code'] === 200) {

                if (download($url, $temp_filename)) {

                    $result['message'] 	= 'Download '.$type.' thành công';

                    $result['status'] 	= 'success';
                }
            }
        }

        echo json_encode($result);
    }
    static public function install($ci, $model) {

        $result['message'] 	= 'Cài đặt header không thành công';

        $result['status'] 	= 'error';

        if(InputBuilder::post()) {

            $id 	= Str::clear(InputBuilder::post('id'));

            $type 	= Str::clear(InputBuilder::post('type'));

            $hd 	= [];

            if($type == 'header') 	$hd = $ci->service_api->get_header($id);

            if($type == 'navigation') $hd = $ci->service_api->get_navigation($id);

            if($type == 'top-bar') 	$hd = $ci->service_api->get_top_bar($id);

            if($type == 'heading') 	$hd = $ci->service_api->get_heading($id);

            if( !have_posts($hd) || $hd->status == 'error' || !have_posts($hd->data) ) {

                echo json_encode($result);

                return false;
            }

            $url = $hd->data->file;

            $dir = 'views/'.$ci->data['template']->name.'/theme-header/'.$type.'-style/';

            $temp_filename = basename( $url );

            $temp_filename = preg_replace( '|\.[^.]*$|', '', $temp_filename );

            $temp_filename  = $dir . $temp_filename . '.zip';

            if( file_exists($temp_filename) ) {

                $zip = new ZipArchive;

                if( $zip->open($temp_filename) === TRUE ) {

                    $zip->extractTo($dir);

                    $zip->close();

                    unlink( $temp_filename );

                    if($type != 'heading') {

                        $header_style = Option::get( 'header_style_install', [] );

                        $header_style[$hd->data->folder] = 1;

                        Option::update( 'header_style_install', $header_style );

                        $result['folder'] 	= $hd->data->folder;
                    }

                    $result['message'] 	= 'Cài đặt element thành công';

                    $result['status'] 	= 'success';
                }

            }
        }

        echo json_encode($result);
    }
    static public function active($ci, $model) {

        $result['message'] 	= 'Kích hoạt element không thành công';

        $result['status'] 	= 'error';

        if(InputBuilder::post()) {

            $type 	= Str::clear(InputBuilder::post('type'));

            $path 	= FCPATH.VIEWPATH.$ci->data['template']->name.'/theme-header/'.$type.'-style';

            if($type == 'heading') {

                $folder = Str::clear(InputBuilder::post('id'));

                $object_type 	= Str::clear(InputBuilder::post('object_type'));
            }
            else {

                $folder = Str::clear(InputBuilder::post('folder'));
            }

            if($type == 'heading') {

                if($object_type == 'sidebar') {
                    Option::update('sidebar_heading_style',  $folder);
                }
                if($object_type == 'widget') {
                    Option::update('widget_heading_style',  $folder);

                    CacheHandler::delete('sidebar_widget_', true);

                    CacheHandler::delete('sidebar_google_speed_', true);
                }
            }
            else {

                $dir 	= $path.'/'.$folder;

                $header_style_active = option::get('header_style_active', array(
                    'header' 		=> [],
                    'navigation' 	=> [],
                    'top-bar' 		=> [],
                ));

                $header_style_active[$type] = array( $folder => $dir );

                Option::update('header_style_active', $header_style_active );
            }

            $result['message'] 	= 'Kích hoạt element thành công';

            $result['status'] 	= 'success';

        }

        echo json_encode($result);
    }
    static public function unActive($ci, $model) {

        $result['message'] 	= 'Tắt header không thành công';

        $result['type'] 	= 'error';

        if(InputBuilder::post()) {

            $type 	= Str::clear(InputBuilder::post('type'));

            if($type == 'heading') {

                $object_type 	= Str::clear(InputBuilder::post('object_type'));

                if($object_type == 'sidebar') {

                    Option::update('sidebar_heading_style',  'none');
                }
                if($object_type == 'widget') {

                    Option::update('widget_heading_style',  'none');

                    CacheHandler::delete('sidebar_widget_', true);

                    CacheHandler::delete('sidebar_google_speed_', true);
                }
            }
            else {

                $folder = Str::clear(InputBuilder::post('folder'));

                $header_style_active = option::get('header_style_active', array(
                    'header' => [],
                    'navigation' => [],
                    'top-bar' => [],
                ));

                if( isset($header_style_active[$type][$folder]) ) unset($header_style_active[$type][$folder]);

                option::update('header_style_active', $header_style_active );
            }

            $result['message'] 	= 'Tắt header thành công';

            $result['type'] 	= 'success';
        }

        echo json_encode($result);
    }
    static public function save($ci, $model) {

        $result['message'] 	= 'Cập nhật dữ liệu không thành công';

        $result['status'] 	= 'error';

        if(InputBuilder::post()) {

            if(InputBuilder::post('layout')) {

                $layout 				= InputBuilder::post('layout');

                $layout_home            = Str::clear($layout['home-layout']);

                $layout_page            = Str::clear($layout['page-layout']);

                $layout_post            = Str::clear($layout['post-layout']);

                $layout_post_category   = Str::clear($layout['post-category-layout']);

                $layout_list = theme_layout_list();

                if(!empty($layout_home)) option::update('layout_home', $layout_home );

                if(isset($layout_list[$layout_page])) 			option::update('layout_page', $layout_page );

                if(isset($layout_list[$layout_post]))			option::update('layout_post', $layout_post );

                if(isset($layout_list[$layout_post_category])) 	option::update('layout_post_category', $layout_post_category );

                if(isset($layout['products-category-layout'])) {

                    $layout_products_category   = Str::clear($layout['products-category-layout']);

                    if(isset($layout_list[$layout_products_category])) 	option::update('layout_products_category', $layout_products_category );

                    $layout_products   = Str::clear($layout['products-layout']);

                    Option::update('layout_products', $layout_products );
                }
            }

            if(InputBuilder::post('post_category')) {

                $layout = InputBuilder::post('post_category');

                $post_category = [];

                $post_category['style'] 		= Str::clear($layout['style']);

                if(isset($layout['sidebar'])) $post_category['sidebar'] 		= add_magic_quotes($layout['sidebar']);

                $post_category['horizontal'] 	= add_magic_quotes($layout['horizontal']);

                Option::update('layout_post_category_setting', $post_category );
            }

            if(InputBuilder::post('post')) {

                $layout = InputBuilder::post('post');

                $post = [];

                if(isset($layout['sidebar'])) $post['sidebar'] 		= add_magic_quotes($layout['sidebar']);

                Option::update('layout_post_setting', $post );
            }

            if(InputBuilder::post('banner')) {

                $layout = InputBuilder::post('banner');

                $banner = option::get('layout_banner_setting');

                if(!is_array($banner)) $banner = [];

                $banner['height'] = Str::clear($layout['height']);

                $banner['page']   = Str::clear($layout['page']);

                $banner['post']   = Str::clear($layout['post']);

                $banner['type']   = Str::clear($layout['type']);

                $banner['post_category']   = Str::clear($layout['post_category']);

                if(isset($layout['products_category'])) $banner['products_category']   = Str::clear($layout['products_category']);

                Option::update('layout_banner_setting', $banner );
            }

            $result['message'] 	= 'Cập nhật dữ liệu thành công';

            $result['status'] 	= 'success';
        }

        echo json_encode($result);
    }
}

Ajax::admin('Theme_Ajax_Element::download');
Ajax::admin('Theme_Ajax_Element::install');
Ajax::admin('Theme_Ajax_Element::active');
Ajax::admin('Theme_Ajax_Element::unActive');
Ajax::admin('Theme_Ajax_Element::save');