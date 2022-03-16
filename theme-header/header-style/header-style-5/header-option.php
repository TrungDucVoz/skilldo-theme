<?php
ThemeOption::addGroupSub('header', 'search', ['name' => 'Tìm kiếm']);
ThemeOption::addGroupSub('header', 'icon', ['name' => 'Giỏ hàng']);

ThemeOption::addField('header', 'search_border_color', 'color', ['sub' => 'search', 'label' => 'Màu viền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_txt_color', 'color', ['sub' => 'search', 'label' => 'Màu chữ button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addField('header', 'header_icon_cart', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon giỏ hàng</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_color', 'color', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Màu chữ</label><div class="form-group group">', 'before' => '</div></div>']);



ThemeOption::addGroup('nav-header', ['label' => 'Navigation header', 'icon' => '<i class="fa fa-bars"></i>', 'position' => 30]);

ThemeOption::addField('nav-header', 'nav_header_position', 'tab', ['value' => 'left', 'options' => ['navbar-left' => 'Canh Trái', 'navbar-center' => 'Canh Giửa', 'navbar-right' => 'Canh Phải'], 'after' => '<div class="col-md-6 builder-col-12"><label>Vị trí menu</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_padding', 'text', ['value' => '10px', 'after' => '<div class="col-md-6 builder-col-12"><label>Navigation Padding</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_bg_color', 'color', ['after' => '<div class="col-md-6"><label>Màu nền Navigation</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_bg_color_hover', 'color', ['after' => '<div class="col-md-6"><label>Màu nền Navigation (hover)</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_text_color', 'color', ['after' => '<div class="col-md-6"><label>Màu chữ Navigation</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_text_color_hover', 'color', ['after' => '<div class="col-md-6"><label>Màu chữ Navigation (hover)</label><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addGroupSub('nav-header', 'nav_header_sub', ['name' => 'Navigation con']);
ThemeOption::addField('nav-header', 'nav_header_sub_bg_color', 'color', ['sub' => 'nav_header_sub', 'after' => '<div class="col-md-6"><label>Màu nền menu con</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_sub_bg_color_hover', 'color', ['sub' => 'nav_header_sub', 'after' => '<div class="col-md-6"><label>Màu nền menu con (hover)</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_sub_text_color', 'color', ['sub' => 'nav_header_sub', 'after' => '<div class="col-md-6"><label>Màu chữ menu con</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('nav-header', 'nav_header_sub_text_color_hover', 'color', ['sub' => 'nav_header_sub', 'after' => '<div class="col-md-6"><label>Màu chữ menu con (hover)</label><div class="form-group group">', 'before' => '</div></div>']);

$fonts = ['Font mặc định'];
$fonts = array_merge($fonts, gets_theme_font());
ThemeOption::addGroupSub('fonts', 'nav_header_font', ['name' => 'Navigation Header']);
ThemeOption::addField('fonts', 'nav_header_font', 'select', ['sub' => 'nav_header_font', 'options' => $fonts, 'after' => '<div class="col-md-6"><label>Font chữ</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('fonts', 'nav_header_font_weight', 'tab', ['sub' => 'nav_header_font', 'options' => ['300' => '300', '400' => '400', '500' => '500', 'bold' => 'Bold'], 'after' => '<div class="col-md-6"><label>Font Weight (in đậm)</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('fonts', 'nav_header_font_size', 'tab', ['sub' => 'nav_header_font', 'label' => 'Font size', 'value' => 18, 'options' => ['11' => '11px', '13' => '13px', '15' => '15px', '16' => '16px', '17' => '17px', '18' => '18px', '20' => '20px', '32' => '32px', '42' => '42px']]);