<?php

ThemeOption::addGroupSub('header', 'top-bar', ['name' => 'Top Bar']);
ThemeOption::addGroupSub('header', 'top-bar-social', ['name' => 'Top Bar MXH']);
ThemeOption::addField('header', 'top_bar_public', 'switch', ['sub' => 'top-bar', 'label' => 'Hiển Thị Top Bar', 'options' => 1, 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'top_bar_bg_color', 'color', ['sub' => 'top-bar', 'label' => 'Màu nền top bar', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'top_bar_bg_image', 'image', ['sub' => 'top-bar', 'label' => 'Hình nền top bar', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'top_bar_text_color', 'color', ['sub' => 'top-bar', 'label' => 'Màu chữ top bar', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);

$list_social = get_theme_social();
foreach ($list_social as $key => $field) {
    ThemeOption::addField('header', 'top_bar_'.$field['field'].'_icon', 'image', [
        'sub' => 'top-bar-social',
        'label' => 'Icon '.$field['label'],
        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
    ]);
}

