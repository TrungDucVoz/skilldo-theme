<?php
Class ThemeHeadingStyle9 {
    static public function register($heading) {
        $heading['heading-style-9'] = ['label' => 'Heading Style 9', 'class' => 'ThemeHeadingStyle9'];
        return $heading;
    }
    static public function html($name) { ?><div class="header-title header-title-style-9"><p class="header"><?= $name;?></p></div><?php }
    static public function css($options, $id = '') {
        $brColor = (!empty($options['brColor'])) ? $options['brColor'] : 'var(--theme-color)';
        $txtColor = (!empty($options['txtColor'])) ? $options['txtColor'] : '#fff';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom']))  ? $options['marginBottom'] : '20';
        $fontSize   = (!empty($options['fontSize'])) ? $options['fontSize'] : '25';
        $font   = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-9 {
                position: relative; text-align: left;margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-9:before {
                content: '';height: 2px;width: 100%;position: absolute;top: 0;left: 0;background: <?php echo $brColor;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-9 .header {
                font-size:<?php echo $fontSize;?>px; line-height: 35px;
                font-family: <?php echo $font;?>;
                color: <?php echo $txtColor;?>;font-weight: bold;margin: 0;padding: 5px 12px 5px 10px;position: relative;display: inline-block;letter-spacing: normal;background: <?php echo $brColor;?>;text-align: center;
            }
            body <?php echo $id;?> .header-title.header-title-style-9 .header:after {
                content: '';position: absolute;top: 0;width: 0;right: -35px;height: 0;border-style: solid;border-width: 0 0 45px 35px;border-color: transparent transparent transparent <?php echo $brColor;?>;
            }
        </style>
        <?php
    }
    static public function form() {
        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $Form = [
            ['name' => 'brColor', 'type' => 'color', 'label' => 'Màu nền tiêu đề', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 25, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle9::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle9::register');