<?php
ThemeOption::addGroup('top-bar', ['position' => 15, 'label' => 'Top Bar', 'icon' => '<i class="fal fa-arrow-to-top"></i>']);
ThemeOption::addField('top-bar', 'top_bar_public', 'switch', ['label' => 'Ẩn/Hiển top bar', 'options' => 1, 'after' => '<div class="builder-col-12 col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_bg_color', 'color', ['label' => 'Màu nền top bar', 'after' => '<div class="builder-col-6 col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_bg_image', 'image', ['label' => 'Hình nền top bar', 'after' => '<div class="builder-col-6 col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_icon_color', 'color', ['label' => 'Màu icon top bar', 'after' => '<div class="builder-col-6 col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_text_color', 'color', ['label' => 'Màu chữ top bar', 'after' => '<div class="builder-col-6 col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_height', 'number', ['label' => 'Chiều cao top bar', 'after' => '<div class="builder-col-12 col-md-4"><div class="form-group group">', 'before' => '</div></div>', 'value' => 40]);


$fonts 	= ['Font mặc định'];
$fonts 	= array_merge($fonts, gets_theme_font());
ThemeOption::addGroupSub('fonts', 'top_bar_font', ['name' => 'Top Bar']);
ThemeOption::addField('fonts','top_bar_font', 'select', ['sub' => 'top_bar_font', 'options' 	=> $fonts, 'after' => '<div class="col-md-6"><label>Font chữ</label><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('fonts','top_bar_font_weight', 'tab', ['sub' => 'top_bar_font', 'options' => ['300' => '300', '400' => '400', '500' => '500', 'bold' => 'Bold'], 'after' => '<div class="col-md-6"><label>Font Weight (in đậm)</label><div class="form-group group">', 'before'=> '</div></div>', 'value' => '400']);
ThemeOption::addField('fonts','top_bar_font_size', 'tab', ['sub' => 'top_bar_font', 'label' => 'Font size', 'options' => ['11' => '11px', '13' => '13px', '15' => '15px', '16' => '16px', '17' => '17px', '18' => '18px', '20' => '20px', '32' => '32px', '42' => '42px'], 'value' => '13']);