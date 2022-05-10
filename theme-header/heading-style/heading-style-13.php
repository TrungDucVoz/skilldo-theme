<?php
Class ThemeHeadingStyle13 {
    static public function register($heading) {
        $heading['heading-style-13'] = ['label' => 'Heading Style 13', 'class' => 'ThemeHeadingStyle13'];
        return $heading;
    }
    static public function html($name) {
        ?><div class="header-title header-title-style-13"><p class="header"><?= $name;?></p><div class="header-hr"></div></div><?php
    }
    static public function css($options, $id = '') {
        $bgColor    = (!empty($options['bgColor'])) ? $options['bgColor'] : 'var(--theme-color)';
        $txtColor    = (!empty($options['txtColor'])) ? $options['txtColor'] : '#fff';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom']))  ? $options['marginBottom'] : '20';
        $fontSize   = (!empty($options['fontSize'])) ? $options['fontSize'] : '18';
        $font   = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-13 {
                border-bottom: 2px solid <?php echo $bgColor;?>;text-align: left;margin-bottom: <?php echo $marginBottom;?>px;margin-top: <?php echo $marginTop;?>px;
            }
            body <?php echo $id;?> .header-title.header-title-style-13 .header {
                margin: 0;padding: 10px 20px;text-align: left;color: <?php echo $txtColor;?>;background-color: <?php echo $bgColor;?>;font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;text-transform: uppercase;display: inline-block;position: relative;
            }
            body <?php echo $id;?> .header-title.header-title-style-13 .header::after {
                content: '';position: absolute;z-index: 999;border-bottom: 20px solid <?php echo $bgColor;?>;border-right: 25px solid transparent;right: -25px;top: 0;
            }
        </style>
        <?php
    }
    static public function form() {
        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $Form = [
            ['name' => 'bgColor', 'type' => 'color', 'label' => 'Màu nền tiêu đề', 'after' => '<div class="clearfix"></div><div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div><div class="clearfix"></div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 18, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle13::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle13::register');