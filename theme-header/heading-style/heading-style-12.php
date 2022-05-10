<?php
Class ThemeHeadingStyle12 {
    static public function register($heading) {
        $heading['heading-style-12'] = ['label' => 'Heading Style 12', 'class' => 'ThemeHeadingStyle12'];
        return $heading;
    }
    static public function html($name, $options) {
        ?>
        <div class="header-title header-title-style-12">
            <?php if(!empty($options['txtTop'])) { ?><p class="header-text-top"><?php echo $options['txtTop'];?></p><?php } ?>
            <p class="header"><?= $name;?></p>
            <div class="header-hr"></div>
            <?php if(!empty($options['desContent'])) { ?><p class="header-description"><?php echo $options['desContent'];?></p><?php } ?>
        </div>
        <?php
    }
    static public function css($options, $id = '') {
        $bgColor        = (!empty($options['brColor'])) ? $options['brColor'] : 'var(--theme-color)';
        $txtColor       = (!empty($options['txtColor'])) ? $options['txtColor'] : '#000';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom']))  ? $options['marginBottom'] : '20';
        $fontSize       = (!empty($options['fontSize'])) ? $options['fontSize'] : '25';
        $font           = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';

        $txtTopColor    = (!empty($options['txtTopColor'])) ? $options['txtTopColor'] : '#000';
        $txtTopMargin   = (isset($options['txtTopMargin']) && is_numeric($options['txtTopMargin'])) ? (int)$options['txtTopMargin'] : '15';
        $txtTopFontSize = (isset($options['txtTopFontSize']) && is_numeric($options['txtTopFontSize'])) ? (int)$options['txtTopFontSize'] : '15';

        $desColor   = (!empty($options['desColor'])) ? $options['desColor'] : '#000';
        $desTopMargin = (isset($options['desTopMargin']) && is_numeric($options['desTopMargin'])) ? (int)$options['desTopMargin'] : '15';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-12 {
                margin-bottom: <?php echo $marginBottom;?>px;
                margin-top: <?php echo $marginTop;?>px;
                margin-left: 0;
                text-align: left;
            }
            body <?php echo $id;?> .header-title.header-title-style-12 .header-text-top {
                margin-bottom: <?php echo $txtTopMargin;?>px;
                color: <?php echo $txtTopColor;?>; font-size:<?php echo $txtTopFontSize;?>px;
            }
            body <?php echo $id;?> .header-title.header-title-style-12 .header {
                font-weight: 700;  margin: 0  0 <?php echo $desTopMargin;?>px 0;
                text-align: left;color:<?php echo $txtColor;?>; line-height: 1.2; font-size:<?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;
                padding: 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-12 .header-hr {
                display: block;position: relative;height: 7px;width: 150px;
                margin-bottom: 0px;
            }
            body <?php echo $id;?> .header-title.header-title-style-12 .header-hr:after,
            body <?php echo $id;?> .header-title.header-title-style-12 .header-hr:before {background-color: <?php echo $bgColor;?>;background-size: 200%;content: "";height: 6px;position: absolute;left: 0;top: 0;border-radius: 15px;}
            body <?php echo $id;?> .header-title.header-title-style-12 .header-hr:after {width: 95px;left: 55px;}
            body <?php echo $id;?> .header-title.header-title-style-12 .header-hr:before {width: 45px;left: auto;}
            body <?php echo $id;?> .header-title.header-title-style-12 .header-description {
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
            ['name' => 'brColor', 'type' => 'color', 'label' => 'Màu gạch dọc & ngang', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="clearfix"></div><div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div><div class="clearfix"></div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 20, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
            ['name' => 'desContent', 'type' => 'textarea', 'label' => 'Nội dung mô tả'],
            ['name' => 'desColor', 'type' => 'color', 'label' => 'Màu chữ mô tả', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'desTopMargin', 'type' => 'number', 'label' => 'Khoảng cách với tiêu đề', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle12::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle12::register');