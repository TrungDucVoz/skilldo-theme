<?php
Class ThemeHeadingStyle8 {
    static public function register($heading) {
        $heading['heading-style-8'] = ['label' => 'Heading Style 8', 'class' => 'ThemeHeadingStyle8'];
        return $heading;
    }
    static public function html($name, $options) {
        ?><div class="header-title header-title-style-8">
        <?php if(!empty($options['txtTop'])) { ?><p class="header-text-top"><?php echo $options['txtTop'];?></p><?php } ?>
        <p class="header"><span><?= $name;?></span></p>
        <?php if(!empty($options['desContent'])) { ?><p class="header-description"><?php echo $options['desContent'];?></p><?php } ?>
        </div><?php
    }
    static public function css($options, $id = '') {
        $txtTopColor    = (!empty($options['txtTopColor'])) ? $options['txtTopColor'] : '#000';
        $txtTopMargin   = (isset($options['txtTopMargin']) && is_numeric($options['txtTopMargin'])) ? (int)$options['txtTopMargin'] : '15';
        $txtTopFontSize = (isset($options['txtTopFontSize']) && is_numeric($options['txtTopFontSize'])) ? (int)$options['txtTopFontSize'] : '15';

        $brColor = (!empty($options['brColor'])) ? $options['brColor'] : 'var(--theme-color)';
        $txtColor = (!empty($options['txtColor'])) ? $options['txtColor'] : '#000';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom']))  ? $options['marginBottom'] : '20';
        $fontSize   = (!empty($options['fontSize'])) ? $options['fontSize'] : '25';
        $font       = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';
        $desColor   = (!empty($options['desColor'])) ? $options['desColor'] : '#000';
        $desTopMargin = (isset($options['desTopMargin']) && is_numeric($options['desTopMargin'])) ? $options['desTopMargin'] : '15';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-8 {
                position: relative;text-align: center;margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-8 .header-text-top {
                margin-bottom: <?php echo $txtTopMargin;?>px;
                color: <?php echo $txtTopColor;?>; font-size:<?php echo $txtTopFontSize;?>px;
            }
            body <?php echo $id;?> .header-title.header-title-style-8 .header {
                text-align: center;
                letter-spacing: 0;
                position: relative;display: flex; align-items: center; justify-content: center;
            }
            body <?php echo $id;?> .header-title.header-title-style-8 .header span {
                flex: none;
                color: <?php echo $txtColor;?>;
                font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;padding-right: 10px;padding-left: 10px;
            }
            body <?php echo $id;?> .header-title.header-title-style-8 .header:before,
            body <?php echo $id;?> .header-title.header-title-style-8 .header:after {
                content: "";
                width: 30%;
                height: 2px;position: relative; background: <?php echo $brColor;?>;border: 0; z-index: 1;
            }
            body <?php echo $id;?> .header-title.header-title-style-8 .header:before {left: 0;}
            body <?php echo $id;?> .header-title.header-title-style-8 .header:after {right: 0;}
            body <?php echo $id;?> .header-title.header-title-style-8 .header-description {
                color: <?php echo $desColor;?>;margin-top: <?php echo $desTopMargin;?>px;
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

            ['name' => 'brColor', 'type' => 'color', 'label' => 'Màu gạch ngang', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 25, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
            ['name' => 'desContent', 'type' => 'textarea', 'label' => 'Nội dung mô tả'],
            ['name' => 'desColor', 'type' => 'color', 'label' => 'Màu chữ mô tả', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'desTopMargin', 'type' => 'number', 'label' => 'Khoảng cách với tiêu đề', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle8::register');