<?php
Class ThemeHeadingStyle1_3 {
    static public function register($heading) {
        $heading['heading-style-1-3'] = ['label' => 'Heading Style 1.3', 'class' => 'ThemeHeadingStyle1_3'];
        return $heading;
    }
    static public function html($name, $options) {
        $txtPosition = (!empty($options['txtPosition'])) ? $options['txtPosition'] : 'center';
        ?>
        <div class="header-title header-title-style-1-3">
            <?php if(!empty($options['txtTop'])) { ?>
                <p class="header-text-top">
                    <?php if($txtPosition == 'left' || $txtPosition == 'center') { ?>
                    <span class="icon-box-left">
                        <span class="color-one"></span>
                        <span class="color-two"></span>
                        <span class="color-three"></span>
                    </span>
                    <?php } ?>
                    <?php echo $options['txtTop'];?>
                    <?php if($txtPosition == 'right' || $txtPosition == 'center') { ?>
                        <span class="icon-box-right">
                        <span class="color-one"></span>
                        <span class="color-two"></span>
                        <span class="color-three"></span>
                    </span>
                    <?php } ?>
                </p>
            <?php } ?>
            <p class="header"><?= $name;?></p>
            <?php if(!empty($options['desContent'])) { ?><p class="header-description"><?php echo $options['desContent'];?></p><?php } ?>
            <?php if(!empty($options['image'])) { ?><div class="header-image-bottom"><?php echo Template::img($options['image']);?></div><?php } ?>
        </div>
        <?php
    }
    static public function css($options, $id = '') {
        $txtPosition = (!empty($options['txtPosition'])) ? $options['txtPosition'] : 'center';
        $txtColor = (!empty($options['txtColor'])) ? $options['txtColor'] : '#000';
        $txtColorIcon1 = (!empty($options['txtTopColorIcon1'])) ? $options['txtTopColorIcon1'] : '#E5E7FF';
        $txtColorIcon2 = (!empty($options['txtTopColorIcon2'])) ? $options['txtTopColorIcon2'] : '#ff9d00';
        $txtColorIcon3 = (!empty($options['txtTopColorIcon3'])) ? $options['txtTopColorIcon3'] : '#0016ff';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom']))  ? $options['marginBottom'] : '20';
        $fontSize   = (!empty($options['fontSize'])) ? $options['fontSize'] : '30';
        $font   = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';

        $txtTopColor    = (!empty($options['txtTopColor'])) ? $options['txtTopColor'] : '#000';
        $txtTopMargin   = (isset($options['txtTopMargin']) && is_numeric($options['txtTopMargin'])) ? (int)$options['txtTopMargin'] : '15';
        $txtTopFontSize = (isset($options['txtTopFontSize']) && is_numeric($options['txtTopFontSize'])) ? (int)$options['txtTopFontSize'] : '15';

        $desColor   = (!empty($options['desColor'])) ? $options['desColor'] : '#000';
        $desTopMargin = (isset($options['desTopMargin']) && is_numeric($options['desTopMargin'])) ? (int)$options['desTopMargin'] : '15';

        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-1-3 {
                text-align: <?php echo $txtPosition;?>;
                margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top {
                margin-bottom: <?php echo $txtTopMargin;?>px;
                color: <?php echo $txtTopColor;?>; font-size:<?php echo $txtTopFontSize;?>px;
                position: relative;
                padding: 6px 60px 0 60px;
                font-weight: bold;
                display: inline-block;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-left {
                position: absolute;
                left: 0px;
                top: 0px;
                width: 38px;
                height: 35px;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-right {
                position: absolute;
                right: 0px;
                top: 0px;
                width: 38px;
                height: 35px;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-left .color-one {
                position: absolute;
                left: 8px;
                top: 6px;
                width: 30px;
                height: 30px;
                background-color: <?php echo $txtColorIcon1;?>
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-left .color-two {
                position: absolute;
                left: 0px;
                top: 0px;
                width: 20px;
                height: 20px;
                background-color: <?php echo $txtColorIcon2;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-left .color-three {
                position: absolute;
                left: 13px;
                top: 13px;
                width: 10px;
                height: 10px;
                background-color: <?php echo $txtColorIcon3;?>;
            }

            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-right .color-one {
                position: absolute;
                left: 8px;
                top: 6px;
                width: 30px;
                height: 30px;
                background-color: <?php echo $txtColorIcon1;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-right .color-two {
                position: absolute;
                left: 0px;
                top: 0px;
                width: 20px;
                height: 20px;
                background-color: <?php echo $txtColorIcon2;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-text-top .icon-box-right .color-three {
                position: absolute;
                left: 13px;
                top: 13px;
                width: 10px;
                height: 10px;
                background-color: <?php echo $txtColorIcon3;?>;
            }

            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-image-bottom {
                margin-top: <?php echo $marginBottom;?>px; text-align: <?php echo $txtPosition;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-image-bottom img {
                display: inline-block;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header {
                text-align: <?php echo $txtPosition;?>;
                letter-spacing: 0; padding-bottom: 0; margin: 0;
                position: relative; display: block;
                color:<?php echo $txtColor;?>;
                font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-3 .header-description {
                color: <?php echo $desColor;?>;margin-top: <?php echo $desTopMargin;?>px; margin-bottom: 0;
            }
        </style>
        <?php
    }
    static public function form() {
        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $Form = [
            ['name' => 'txtTop', 'type' => 'text', 'label' => 'Top text', 'after' => '<div class="builder-col-12 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtTopColor', 'type' => 'color', 'label' => 'Màu top text', 'after' => '<div class="builder-col-6 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtTopMargin', 'type' => 'number', 'label' => 'Khoảng cách với tiêu đề', 'after' => '<div class="builder-col-6 col-md-4 form-group group">', 'before'=> '</div>'],

            ['name' => 'txtTopColorIcon1', 'type' => 'color', 'label' => 'Màu top box 1', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>', 'value' => '#E5E7FF'],
            ['name' => 'txtTopColorIcon2', 'type' => 'color', 'label' => 'Màu top box 2', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>', 'value' => '#ff9d00'],
            ['name' => 'txtTopColorIcon3', 'type' => 'color', 'label' => 'Màu top box 3', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>', 'value' => '#0016ff'],

            ['name' => 'txtTopFontSize', 'type' => 'tab', 'label' => 'Font size top text', 'value' => 15, 'options' => ['11' => '11px', '13' => '13px', '15' => '15px', '16' => '16px', '17' => '17px', '18' => '18px', '20' => '20px', '30' => '30px', '42' => '42px']],
            ['name' => 'txtPosition', 'type' => 'tab', 'label' => 'Vị trí', 'options' => ['left' => 'Trái', 'center' => 'Giữa', 'right' => 'Phải'], 'after' => '<div class="col-md-12 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="builder-col-6 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="builder-col-6 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 25, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
            ['name' => 'image', 'type' => 'image', 'label' => 'Ảnh dưới tiêu đề', 'value' => ''],
            ['name' => 'desContent', 'type' => 'textarea', 'label' => 'Nội dung mô tả'],
            ['name' => 'desColor', 'type' => 'color', 'label' => 'Màu chữ mô tả', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'desTopMargin', 'type' => 'number', 'label' => 'Khoảng cách với tiêu đề', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle1_3::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle1_3::register');

