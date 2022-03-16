<?php
ThemeOption::addGroupSub('header', 'top-bar', ['name' => 'Top Bar']);
ThemeOption::addField('header','top_bar_public', 'switch', ['sub' => 'top-bar',
    'label'  => 'Hiển Thị Top Bar', 'options' 	=> 1,
    'after' => '<div class="col-md-4"><div class="form-group group">', 'before'=> '</div></div>'
]);
ThemeOption::addField('header','top_bar_text', 'text', [
    'sub' => 'top-bar',
    'label'     => 'Câu welcome top bar',
    'after' => '<div class="col-md-8"><div class="form-group group">', 'before'=> '</div></div>'
]);
ThemeOption::addField('header','top_bar_bg_color', 'color', ['sub' => 'top-bar', 'label' => 'Màu nền top bar', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('header','top_bar_bg_image', 'image', ['sub' => 'top-bar', 'label' => 'Hình nền top bar', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('header','top_bar_text_color', 'color', ['sub' => 'top-bar', 'label' => 'Màu chữ top bar', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before'=> '</div></div>']);