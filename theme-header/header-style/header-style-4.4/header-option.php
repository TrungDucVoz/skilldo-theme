<?php
ThemeOption::addGroupSub('header', 'hotline', ['name' => 'Hotline']);
ThemeOption::addGroupSub('header', 'social', ['name' => 'Mạng Xã Hội']);
ThemeOption::addField('header', 'header_icon_hotline', 'image', ['sub' => 'hotline', 'label' => 'Icon Hotline']);
ThemeOption::addField('header', 'hotline_color_heading', 'color', ['sub' => 'hotline', 'label' => 'Màu chữ hotline', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'hotline_color_phone', 'color', ['sub' => 'hotline', 'label' => 'Màu số điện thoại', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);

$list_social = get_theme_social();
foreach ($list_social as $key => $field) {
    ThemeOption::addField('header', 'header_'.$field['field'].'_icon', 'image', ['sub' => 'social', 'label' => 'Icon '.$field['label'],]);
}
