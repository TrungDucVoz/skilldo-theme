<?php
ThemeOption::addField('nav','nav_position', 'tab', ['value'     => 'left', 'options' 	=> ['navbar-left' => 'Canh Trái', 'navbar-center' => 'Canh Giửa', 'navbar-right' => 'Canh Phải'], 'after' => '<div class="col-md-6 builder-col-12"><label>Vị trí menu</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','nav_padding', 'text', ['value'     => '10px', 'after' => '<div class="col-md-6 builder-col-12"><label>Navigation Padding</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','nav_bg_color', 'color', ['after' => '<div class="col-md-6"><label>Màu nền Navigation</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','nav_bg_color_hover', 'color', ['after' => '<div class="col-md-6"><label>Màu nền Navigation (hover)</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','nav_text_color', 'color', ['after' => '<div class="col-md-6"><label>Màu chữ Navigation</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','nav_text_color_hover', 'color', ['after' => '<div class="col-md-6"><label>Màu chữ Navigation (hover)</label><div class="form-group group">', 'before'=> '</div></div>']);


ThemeOption::addGroupSub('nav', 'navsub', ['name' => 'Navigation con']);
ThemeOption::addField('nav','navsub_bg_color', 'color', ['sub' => 'navsub', 'after' => '<div class="col-md-6"><label>Màu nền menu con</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','navsub_bg_color_hover', 'color', ['sub' => 'navsub', 'after' => '<div class="col-md-6"><label>Màu nền menu con (hover)</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','navsub_text_color', 'color', ['sub' => 'navsub', 'after' => '<div class="col-md-6"><label>Màu chữ menu con</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('nav','navsub_text_color_hover', 'color', ['sub' => 'navsub', 'after' => '<div class="col-md-6"><label>Màu chữ menu con (hover)</label><div class="form-group group">', 'before'=> '</div></div>']);

ThemeOption::addGroupSub('nav', 'nav_vh_header', ['name' => 'Navigation dọc - Tiêu đề']);
ThemeOption::addField('nav', 'nav_vh_text', 'text', ['sub' => 'nav_vh_header', 'label' => 'Tiêu đề', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addField('nav','nav_vh_text_color','color', ['sub' => 'nav_vh_header', 'label' => 'Màu chử tiêu đề', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav','nav_vh_bg','color', ['sub' => 'nav_vh_header', 'label' => 'Màu nền tiêu đề', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addGroupSub('nav', 'nav_vh_menu', ['name' => 'Navigation dọc - menu']);
ThemeOption::addField('nav','nav_v_bg', 'color', ['sub' => 'nav_vh_menu', 'label' => 'Màu nền', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav','nav_v_bg_hover', 'color', ['sub' => 'nav_vh_menu', 'label' => 'Màu nền khi trỏ chuột', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav','nav_v_text_color','color', ['sub' => 'nav_vh_menu', 'label' => 'Màu chử', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav','nav_v_text_color_hover','color', ['sub' => 'nav_vh_menu', 'label' => 'Màu chữ khi trỏ chuột', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav','nav_v_type', 'select-img', [
    'sub' => 'nav_vh_menu',
    'label' => 'Hiển thị',
    'options' => [
        'style1' => [ 'label' => 'Loại 1', 'img' => Path::theme('theme-header/navigation-style/navigation-style-3/images/menu-navigation-style-1.png')],
        'style2' => [ 'label' => 'Loại 2', 'img' => Path::theme('theme-header/navigation-style/navigation-style-3/images/menu-navigation-style-2.png')],
    ]
]);


$fonts 	= ['Font mặc định'];
$fonts 	= array_merge($fonts, gets_theme_font());
ThemeOption::addGroupSub('fonts', 'nav_font', ['name' => 'Navigation']);
ThemeOption::addField('fonts','nav_font', 'select', ['sub' => 'nav_font', 'options' 	=> $fonts, 'after' => '<div class="col-md-6"><label>Font chữ</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('fonts','nav_font_weight', 'tab', ['sub' => 'nav_font', 'options' => ['300' => '300', '400' => '400', '500' => '500', 'bold' => 'Bold'], 'after' => '<div class="col-md-6"><label>Font Weight (in đậm)</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('fonts','nav_font_size', 'tab', ['sub' => 'nav_font', 'label' => 'Font size', 'value' => 18, 'options' => ['11' => '11px', '13' => '13px', '15' => '15px', '16' => '16px', '17' => '17px', '18' => '18px', '20' => '20px', '32' => '32px', '42' => '42px']]);
