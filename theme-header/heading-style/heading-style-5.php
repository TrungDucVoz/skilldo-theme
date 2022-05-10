<?php
Class ThemeHeadingStyle5 {
    static public function register($heading) {
        $heading['heading-style-5'] = ['label' => 'Heading Style 5', 'class' => 'ThemeHeadingStyle5'];
        return $heading;
    }
    static public function html($name, $options) {
        ?>
        <div class="header-title header-title-style-5">
            <p class="header"><?= $name;?></p>
            <?php if(!empty($options['desContent'])) { ?><p class="header-description"><?php echo $options['desContent'];?></p><?php } ?>
        </div>
        <?php
    }
    static public function css($options, $id = '') {
        $bgColor        = (!empty($options['brColor'])) ? $options['brColor'] : 'var(--theme-color)';
        $txtColor       = (!empty($options['txtColor'])) ? $options['txtColor'] : '#000';
        $marginTop      = (isset($options['marginTop']) && is_numeric($options['marginTop'])) ? $options['marginTop'] : '30';
        $marginBottom   = (isset($options['marginBottom']) && is_numeric($options['marginBottom'])) ? $options['marginBottom'] : '20';
        $fontSize       = (!empty($options['fontSize'])) ? $options['fontSize'] : '20';
        $font           = (!empty($options['font'])) ? $options['font'] : 'var(--font-header)';
        ?>
        <style>
            body <?php echo $id;?> .header-title.header-title-style-5 {
                margin: <?php echo $marginTop;?>px 0 <?php echo $marginBottom;?>px 0;
            }
            body <?php echo $id;?> .header-title.header-title-style-5 .header {
                font-weight: bold; display: flex;align-items: center;
                text-transform: uppercase;font-size:<?php echo $fontSize;?>px; line-height: <?php echo $fontSize;?>px;
                font-family: <?php echo $font;?>;
                text-align: left; color:<?php echo $txtColor;?>;
            }
            body <?php echo $id;?> .header-title.header-title-style-5 .header-description{
                text-align: left; color:#000;
                margin-top:20px;
            }
            body <?php echo $id;?> .header-title.header-title-style-5 .header:before {
                content: '';
                width: 5px;
                height: 25px;
                background: <?php echo $bgColor;?>;
                margin-right: 10px;
                display: inline-block;
                border: 0;
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
            ['name' => 'desContent', 'type' => 'textarea', 'label' => 'Nội dung mô tả'],
            ['name' => 'fontSize', 'type' => 'tab', 'label' => 'Font size tiêu đề', 'value' => 20, 'options' => ['10' => '10px', '14' => '14px', '15' => '15px', '16' => '16px', '18' => '18px', '20' => '20px', '25' => '25px', '30' => '30px', '42' => '42px']],
            ['name' => 'font', 'type' => 'select', 'label' => 'Font chữ', 'value' => '', 'options' => $fonts],
        ];
        return $Form;
    }
}

add_filter('theme_widget_heading', 'ThemeHeadingStyle5::register');
add_filter('theme_sidebar_heading', 'ThemeHeadingStyle5::register');