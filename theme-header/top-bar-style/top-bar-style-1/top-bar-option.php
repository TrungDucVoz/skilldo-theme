<?php
ThemeOption::addGroup('top-bar', ['position' => 15, 'label' => 'Top Bar', 'icon' => '<i class="fal fa-arrow-to-top"></i>']);
ThemeOption::addGroupSub('top-bar', 'top-bar-social', ['name' => 'Top Bar MXH']);
ThemeOption::addField('top-bar', 'top_bar_public', 'switch', ['label' => 'Hiển Thị Top Bar', 'options' => 1, 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_bg_color', 'color', ['label' => 'Màu nền top bar', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_bg_image', 'image', ['label' => 'Hình nền top bar', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar', 'top_bar_text_color', 'color', ['label' => 'Màu chữ top bar', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);

$list_social = get_theme_social();
foreach ($list_social as $key => $field) {
    ThemeOption::addField('top-bar', 'top_bar_'.$field['field'].'_icon', 'image', [
        'sub' => 'top-bar-social',
        'label' => 'Icon '.$field['label'],
        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
    ]);
}

