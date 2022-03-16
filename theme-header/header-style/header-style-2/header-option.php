<?php
ThemeOption::addGroupSub('header', 'slogan', ['name' => 'Slogan']);
ThemeOption::addGroupSub('header', 'social', ['name' => 'Mạng xã hội']);

ThemeOption::addField('header', 'header_slogan', 'image', ['sub' => 'slogan', 'label' => 'Ảnh slogan', 'after' => '<div class="builder-col-6 col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_slogan_height', 'number', ['sub' => 'Slogan', 'label' => 'Chiều cao slogan', 'after' => '<div class="builder-col-6 col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_txt', 'text', ['sub' => 'slogan', 'label' => 'Mô tả']);
ThemeOption::addField('header', 'header_txt_color', 'color', ['sub' => 'slogan', 'label' => 'Màu mô tả']);
$list_social = get_theme_social();
foreach ($list_social as $key => $field) {
    ThemeOption::addField('header', 'header_'.$field['field'].'_icon', 'image', ['sub' => 'social', 'label' => 'Icon '.$field['label'], 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
}
