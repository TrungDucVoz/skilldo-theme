<?php
Class ThemeHeadingStyle7 {
    static public function register($heading) {
        $heading['heading-style-7'] = ['label' => 'Heading Style 7', 'class' => 'ThemeHeadingStyle7'];
        return $heading;
    }
    static public function html($name, $options) {
        ?><div class="header-title header-title-style-7">
        <p class="header"><?= $name;?></p>
        <?php if(!empty($options['desContent'])) { ?><p class="header-description"><?php echo $options['desContent'];?></p><?php } ?>
        </div><?php
    }
    static public function css($options, $id = '') {
        $brColor = (!empty($options['brColor'])) ? $options['brColor'] : 'var(--theme-color)';
        $txtColor = (!empty($options['txtColor'])) ? $options['txtColor'] : '#000';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom']))  ? $options['marginBottom'] : '20';
        $fontSize   = (!empty($options['fontSize'])) ? $options['fontSize'] : '20';
        $font   = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';
        $desColor  = (!empty($options['desColor'])) ? $options['desColor'] : '#000';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-7 {
                position: relative;text-align: left;margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-7 .header {
                text-align: left;letter-spacing: 0;color: <?php echo $txtColor;?>;
                background: #fff;position: relative;display: inline-block;margin: 0 0 10px;font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;padding:0 10px 0 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-7 .header-description {
                color: <?php echo $desColor;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-7:before {
                content: "";width: 100%;top: 12px;height: 3px;position: absolute;background-color: <?php echo $brColor;?>;left: 0;border: 0;
            }
        </style>
        <?php
    }
    static public function form() {
        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $Form = [
            ['name' => 'brColor', 'type' => 'color', 'label' => 'Màu gạch dọc', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'txtColor', 'type' => 'color', 'label' => 'Màu tiêu đề', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginTop', 'type' => 'number', 'label' => 'Margin top heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'marginBottom', 'type' => 'number', 'label' => 'Margin bottom heading', 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 20, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
            ['name' => 'desContent', 'type' => 'textarea', 'label' => 'Nội dung mô tả'],
            ['name' => 'desColor', 'type' => 'color', 'label' => 'Màu chữ mô tả'],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle7::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle7::register');