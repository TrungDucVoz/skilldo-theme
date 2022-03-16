<?php
function _form_wg_box($param, $value = []) {

    $ci =& get_instance();

    $output = '';

    $data = array(
    	array( 'value' => 'full',          'img' => 'box1.png'),
    	array( 'value' => 'container',     'img' => 'box2.png'),
    	array( 'value' => 'in-container',  'img' => 'box3.png'),
    );
    
    $output .= '<div class="wg-container-box">';

    foreach ( $data as $key => $val ) {
    	$output .= '<div class="wg-box-item '.(($val['value'] == $value)?'active':'').'" data-value="'.$val['value'].'">';
	    $output .= get_img_fontend($val['img'],'',array('class'=>'img-responsive'),true);
	    $output .= '</div>';
    }

    $input 	= array('field' => $param->field,  'label' =>'', 'type' => 'hidden');
    $output .= _form($input, $value);

    $output .= '</div>';

    return $output;
}

/**
 * [_form_MENU tạo trình quản lý margin, padding, border]
 * @param  [type] [wg_box]
 * @param  array  $value [description]
 * @return [type]        [description]
 */
function _form_size_box($param, $value = []) {

    $value_default = array( 
        'margin'    => array('top' => 0, 'left' => 0, 'right' => 0, 'bottom' => 0),
        'border'    => array('top' => 0, 'left' => 0, 'right' => 0, 'bottom' => 0),
        'padding'   => array('top' => 0, 'left' => 0, 'right' => 0, 'bottom' => 0),
    );

    if(!is_array($value)) $value = [];

    $value = array_merge($value_default, $value);

    ?>
    <div class="col-md-12">
    <div class="inp_size_box">
        <div class="inp_size_box_margin box-property">
            <div class="title">margin</div>
            <input type="text" name="<?php echo $param->field.'[margin][top]';?>" value="<?php echo $value['margin']['top'];?>" class="margin-top">
            <input type="text" name="<?php echo $param->field.'[margin][left]';?>" value="<?php echo $value['margin']['left'];?>" class="margin-left">
            <input type="text" name="<?php echo $param->field.'[margin][right]';?>" value="<?php echo $value['margin']['right'];?>" class="margin-right">
            <input type="text" name="<?php echo $param->field.'[margin][bottom]';?>" value="<?php echo $value['margin']['bottom'];?>" class="margin-bottom">
        </div>
        <div class="inp_size_box_padding box-property">
            <div class="title">padding</div>
            <input type="text" name="<?php echo $param->field.'[padding][top]';?>" value="<?php echo $value['padding']['top'];?>" class="padding-top">
            <input type="text" name="<?php echo $param->field.'[padding][left]';?>" value="<?php echo $value['padding']['left'];?>" class="padding-left">
            <input type="text" name="<?php echo $param->field.'[padding][right]';?>" value="<?php echo $value['padding']['right'];?>" class="padding-right">
            <input type="text" name="<?php echo $param->field.'[padding][bottom]';?>" value="<?php echo $value['padding']['bottom'];?>" class="padding-bottom">
        </div>
        <div class="inp_size_box_content box-property"><div class="title">content</div></div>
    </div>
    </div>
    <div class="clearfix"> </div>

    <style type="text/css">
        .inp_size_box {
            position: relative;
            width: 100%; height: 200px;
        }

        [class*='inp_size_box_'] {
            position: absolute;
        }
        .inp_size_box_margin {
            width:100%; height:200px;
            border:1px dashed #000;
            background:#f8cb9c;
        }

        .inp_size_box_padding {
            left:35px; top:35px;
            width:calc(100% - 70px); height:130px;
            border:1px dashed #ccc;
            background-color:#c2ddb6;
        }
        .inp_size_box_content {
            left:70px; top:70px;
            width:calc(100% - 136px);
            height:60px; line-height:60px;
            border:1px solid #000;
            background-color:#9fc4e7;
            text-align:center;
        }
        .inp_size_box_content .title {
            float:none;width:100%; text-align:center!important;
        }
        [class*='inp_size_box_'] > input { position: absolute; width:25px; font-size:10px; text-align: center; }
        [class*='inp_size_box_'] > .title { position: absolute; text-align: left; }
        [class*='inp_size_box_'] > input[class*='-top'] { top:5px; left:50%; margin-left:-13px; }
        [class*='inp_size_box_'] > input[class*='-left'] { left:2px; top:50%; margin-top:-13px;}
        [class*='inp_size_box_'] > input[class*='-right'] { right:2px; top:50%; margin-top:-13px;}
        [class*='inp_size_box_'] > input[class*='-bottom'] { bottom:5px; left:50%; margin-left:-13px;}

        .inp_size_box:hover .box-property { background-color: #fff; }
        .inp_size_box_margin:hover { background:#f8cb9c!important; }
        .inp_size_box_border:hover { background:#feedbb!important; }
        .inp_size_box_padding:hover { background:#c2ddb6!important; }
        .inp_size_box_content:hover { background:#9fc4e7!important; }
    </style>
    <?php
}


/**
 * [_form_MENU tạo trình quản lý margin, padding, border]
 * @param  [type] [wg_box]
 * @param  array  $value [description]
 * @return [type]        [description]
 */
function _form_col($param, $value = []) {

    $args        = [];
    $args['min'] = (!empty($param->min)) ? $param->min : 1;
    $args['max'] = (!empty($param->max)) ? $param->max : 12;

    $output = '';
    $output .='<div class="input-cols">';
    $output .='    <div class="input-col-wrap input-col-'.$value.'">';
    for ( $i = $args['min'];  $i <= $args['max'] ; $i++ ) { 
        $output .='<div class="col-item" data-col="'.$i.'">'.$i.'</div>';
    }
    $output .='    </div>';
    $output .='    <input type="range" name="'.$param->field.'" value="'.$value.'" min="'.$args['min'].'" max="'.$args['max'].'" id="'.$param->field.'" class="form-control ">';
    $output .='</div>';
    $output .='<div class="clearfix"></div>';
    return $output;
}

function animate_css_option() {
    $option = [];
    $option['fade']             = 'fade';
    $option['fade-up']          = 'fade up';
    $option['fade-down']        = 'fade down';
    $option['fade-left']        = 'fade left';
    $option['fade-right']       = 'fade right';
    $option['fade-up-right']    = 'fade up right';
    $option['fade-up-left']     = 'fade up left';
    $option['fade-down-right']  = 'fade down right';
    $option['fade-down-left']   = 'fade down left';
    $option['flip-up']          = 'flip up';
    $option['flip-down']        = 'flip down';
    $option['flip-left']        = 'flip left';
    $option['flip-right']       = 'flip right';
    $option['slide-up']         = 'slide up';
    $option['slide-down']       = 'slide down';
    $option['slide-left']       = 'slide left';
    $option['slide-right']      = 'slide right';
    $option['zoom-in']          = 'zoom in';
    $option['zoom-in-up']       = 'zoom in up';
    $option['zoom-in-down']     = 'zoom in down';
    $option['zoom-in-left']     = 'zoom in left';
    $option['zoom-in-right']    = 'zoom in right';
    $option['zoom-out']         = 'zoom out';
    $option['zoom-out-up']      = 'zoom out up';
    $option['zoom-out-down']    = 'zoom out down';
    $option['zoom-out-left']    = 'zoom out left';
    $option['zoom-out-right']   = 'zoom out right';
    $option['top-bottom']       = 'top bottom';
    $option['top-center']       = 'top center';
    $option['top-top']          = 'top top';
    $option['center-bottom']    = 'center bottom';
    $option['center-center']    = 'center center';
    $option['center-top']       = 'center top';
    $option['bottom-bottom']    = 'bottom bottom';
    $option['bottom-center']    = 'bottom center';
    $option['bottom-top']       = 'bottom top';
    $option['linear']           = 'linear';
    $option['ease']             = 'ease';
    $option['ease-in']          = 'ease in';
    $option['ease-out']         = 'ease out';
    $option['ease-in-out']      = 'ease in out';
    $option['ease-in-back']     = 'ease in back';
    $option['ease-out-back']    = 'ease out back';
    $option['ease-in-out-back'] = 'ease in back';
    $option['ease-in-sine']     = 'ease in sine';
    $option['ease-out-sine']    = 'ease out sine';
    $option['ease-in-out-sine'] = 'ease in out sine';
    $option['ease-in-quad']     = 'ease in quad';
    $option['ease-out-quad']    = 'ease out quad';
    $option['ease-in-out-quad'] = 'ease in out quad';
    $option['ease-in-cubic']    = 'ease in cubic';
    $option['ease-out-cubic']   = 'ease out cubic';
    $option['ease-in-out-cubic']= 'ease in out cubic';
    $option['ease-in-quart']    = 'ease in quart';
    $option['ease-out-quart']   = 'ease out quart';
    $option['ease-in-out-quart']= 'ease in out quart';
    return $option;
}
/**
 * [gets_theme_font lấy danh sách font cần sử dụng]
 * @singe  3.0.0
 */
function gets_theme_font() {
    $font_family = Template::fonts();
    $fonts = [];
    if(have_posts($font_family)) {
        foreach ($font_family as $key => $font) {
            $fonts[$font['key']] = $font['label'];
        }
    }

    return $fonts;
}
/**
 * [get_theme_social lấy danh sách mạng xã hội cần sử dụng]
 * @singe  3.0.0
 */
if( !function_exists('get_theme_social') ) {

    function get_theme_social() {

        $socials = [
            array(	
                'label' 	=> 'Facebook Fanpage',
                'note'		=> 'Đường dẫn facebook fanpage',
                'field' 	=> 'social_facebook',
                'type' 		=> 'url',
                'group'     => 'social',
            ),
            array( 	
                'label' 	=> 'Twitter',
                'note'		=> 'Đường dẫn Twitter',
                'field' 	=> 'social_twitter',
                'type' 		=> 'url',
                'group'     => 'social',
            ),
            array( 	
                'label' 	=> 'Youtube',
                'note'		=> 'Đường dẫn kênh youtube',
                'field' 	=> 'social_youtube',
                'type' 		=> 'url',
                'group'     => 'social',
            ),
            array( 	
                'label' 	=> 'Instagram',
                'note'		=> 'Đường dẫn Instagram',
                'field' 	=> 'social_instagram',
                'type' 		=> 'url',
                'group'     => 'social',
            ),
            array( 	
                'label' 	=> 'Pinterest',
                'note'		=> 'Đường dẫn Pinterest',
                'field' 	=> 'social_pinterest',
                'type' 		=> 'url',
                'group'     => 'social',
            ),
            array( 	
                'label' 	=> 'Zalo',
                'note'		=> 'Số điện thoại liên kết Zalo',
                'field' 	=> 'social_zalo',
                'type' 		=> 'text',
                'group'     => 'social',
            ),
        ];

        return $socials;
    }
}
/**
 * [get_theme_social lấy danh sách input seo cần sử dụng]
 * @singe  3.0.0
 */
if( !function_exists('get_theme_seo_input') ) {

    function get_theme_seo_input() {

        $seo_input = array(
            ['label' => 'Favicon', 'field' => 'seo_favicon', 'type' => 'image'],
            ['label' => 'Meta title (shop)', 'field' => 'general_title', 'type' => 'text'],
            ['label' => 'Meta description (Mô tả trang chủ)', 'field' => 'general_description', 'type' => 'textarea'],
            ['label' => 'Meta keyword (Từ khóa trang chủ)', 'field' => 'general_keyword', 'type' => 'textarea'],
            ['label' => 'Google Master key', 'field' => 'seo_google_masterkey', 'type' => 'text'],
			['label' => 'Script Header', 'field' => 'header_script', 'type' => 'code', 'language'  => 'javascript', 'note' => 'Chèn script vào header (google analytic code, google master code..)'],
            ['label' => 'Script Body', 'field' => 'body_script', 'type' => 'code', 'language'  => 'javascript', 'note' => 'Chèn script vào ngay sau thẻ body'],
			['label' => 'Script Footer', 'field' => 'footer_script', 'type' => 'code', 'language' => 'javascript', 'note' => 'Chèn script vào footer (chat code, thống kê code..)'],
		);

        return apply_filters('get_theme_seo_input', $seo_input);
    }
}