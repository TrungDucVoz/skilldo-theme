<?php
Class ThemeHeadingStyle2 {
    static public function register($heading) {
        $heading['heading-style-2'] = ['label' => 'Heading Style 2', 'class' => 'ThemeHeadingStyle2'];
        return $heading;
    }
    static public function html($name) {
        ?>
        <div class="header-title header-title-style-2">
            <?php if(!empty($options['desContent'])) { ?><p class="header-description"><?php echo $options['desContent'];?></p><?php } ?>
            <p class="header"><?= $name;?></p>
        </div>
        <?php
    }
    static public function css($options, $id = '') {
        $brColor1 = (!empty($options['brColor1'])) ? $options['brColor1'] : 'var(--theme-color)';
        $brColor2 = (!empty($options['brColor2'])) ? $options['brColor2'] : '#ebebeb';
        $txtColor = (!empty($options['txtColor'])) ? $options['txtColor'] : '#000';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom'])) ? $options['marginBottom'] : '20';
        $fontSize   = (!empty($options['fontSize'])) ? $options['fontSize'] : '20';
        $font   = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-2 .header {
                text-align: left;
                letter-spacing: 0;
                border-bottom: 1px solid <?php echo $brColor2;?>;
                padding-bottom: 15px;position: relative;display: block;
                margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
                color:<?php echo $txtColor;?>;
                font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;font-family: <?php echo $font;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-2 .header:before {
                content: "";
                width: 70px;
                bottom: -2px;
                height: 3px;
                position: absolute;
                background: <?php echo $brColor1;?>;
                left: 0;
                border: 0;
            }
        </style>
        <?php
    }
    static public function form() {
        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $Form = [
            ['name' => 'brColor1', 'type' => 'color', 'label' => 'Màu gạch chân 1', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'brColor2', 'type' => 'color', 'label' => 'Màu gạch chân 2', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 20, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
        ];
        return $Form;
    }
}
add_filter('theme_widget_heading', 'ThemeHeadingStyle2::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle2::register');
