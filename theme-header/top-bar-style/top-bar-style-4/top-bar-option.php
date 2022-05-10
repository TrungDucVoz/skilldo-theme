<?php
ThemeOption::addGroup('top-bar', ['position' => 15, 'label' => 'Top Bar', 'icon' => '<i class="fal fa-arrow-to-top"></i>']);
ThemeOption::addField('top-bar','top_bar_public', 'switch', ['label' => 'Ẩn/Hiển top bar', 'options' => 1, 'after' => '<div class="builder-col-12 col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('top-bar','top_bar_text', 'text', ['label' => 'Câu welcome top bar', 'after' => '<div class="col-md-8"><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('top-bar','top_bar_bg_color', 'color', ['label' => 'Màu nền top bar', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('top-bar','top_bar_bg_image', 'image', ['label' => 'Hình nền top bar', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before'=> '</div></div>']);
ThemeOption::addField('top-bar','top_bar_text_color', 'color', ['label' => 'Màu chữ top bar', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before'=> '</div></div>']);
