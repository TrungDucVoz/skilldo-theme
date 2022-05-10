<?php
Class ThemeHeadingStyle1_1 {
    static public function register($heading) {
        $heading['heading-style-1-1'] = ['label' => 'Heading Style 1.1', 'class' => 'ThemeHeadingStyle1_1'];
        return $heading;
    }
    static public function html($name, $options) {
        ?>
        <div class="header-title header-title-style-1-1">
            <?php if(!empty($options['txtTop'])) { ?><p class="header-text-top"><?php echo $options['txtTop'];?></p><?php } ?>
            <p class="header"><?= $name;?></p>
            <?php if(!empty($options['desContent'])) { ?><p class="header-description"><?php echo $options['desContent'];?></p><?php } ?>
            <?php if(!empty($options['image'])) { ?><div class="header-image-bottom"><?php echo Template::img($options['image']);?></div><?php } ?>
        </div>
        <?php
    }
    static public function css($options, $id = '') {
        $txtPosition = (!empty($options['txtPosition'])) ? $options['txtPosition'] : 'center';
        $txtColor = (!empty($options['txtColor'])) ? $options['txtColor'] : '#000';
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
            body <?php echo $id;?> .header-title.header-title-style-1-1 {
                text-align: <?php echo $txtPosition;?>;
                margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-1 .header-text-top {
                margin-bottom: <?php echo $txtTopMargin;?>px;
                color: <?php echo $txtTopColor;?>; font-size:<?php echo $txtTopFontSize;?>px;
                position: relative;
                padding: 0px 0 0px 80px;
                font-weight: 500;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-1 .header-text-top:before {
                position: absolute;
                content: '';
                left: 0;
                top: 13px;
                width: 70px;
                height: 2px;
                background-color: <?php echo $txtTopColor;?>;
                z-index: 10;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-1 .header-image-bottom {
                margin-top: <?php echo $marginBottom;?>px; text-align: <?php echo $txtPosition;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-1 .header-image-bottom img {
                display: inline-block;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-1 .header {
                text-align: <?php echo $txtPosition;?>;
                letter-spacing: 0; padding-bottom: 0; margin: 0;
                position: relative; display: block;
                color:<?php echo $txtColor;?>;
                font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-1-1 .header-description {
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

add_filter('theme_widget_heading', 'ThemeHeadingStyle1_1::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle1_1::register');
