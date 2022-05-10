<?php
Class ThemeHeadingStyle3 {
    static public function register($heading) {
        $heading['heading-style-3'] = ['label' => 'Heading Style 3', 'class' => 'ThemeHeadingStyle3'];
        return $heading;
    }
    static public function html($name) {
        ?><div class="header-title header-title-style-3"><p class="header"><?= $name;?></p></div><?php
    }
    static public function css($options, $id = '') {
        $bgColor1 = (!empty($options['bgColor1'])) ? $options['bgColor1'] : '#bb0d0d';
        $bgColor2 = (!empty($options['bgColor2'])) ? $options['bgColor2'] : 'var(--theme-color)';
        $txtColor = (!empty($options['txtColor'])) ? $options['txtColor'] : '#fff';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom']))  ? $options['marginBottom'] : '20';
        $fontSize   = (!empty($options['fontSize'])) ? $options['fontSize'] : '20';
        $font   = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-3 {
                text-align: left;margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-3 .header {
                background: <?php echo $bgColor2?>;
                color:<?php echo $txtColor;?>;font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;
                font-weight: 700;border-radius: 0px;position: relative;padding: 12px 12px 12px 70px;margin-bottom: 0;text-transform: uppercase;display: inline-block;
            }
            body <?php echo $id;?> .header-title.header-title-style-3 .header:before {
                content: "";
                display: inline-block;width: 60px;position: absolute;height: 100%;
                background-color: <?php echo $bgColor1;?>;top: 0;left: 0;clip-path: polygon(0 0, 100% 0, 85% 100%, 0 100%);border: 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-3 .header:after {
                content: "\f005";font-family: "Font Awesome 5 Pro", serif;position: absolute;top: 10px;left: 15px;
            }
        </style>
        <?php
    }
    static public function form() {
        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $Form = [
            ['name' => 'bgColor1', 'type' => 'color', 'label' => 'Màu nền 1', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'bgColor2', 'type' => 'color', 'label' => 'Màu nền 2', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 20, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle3::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle3::register');