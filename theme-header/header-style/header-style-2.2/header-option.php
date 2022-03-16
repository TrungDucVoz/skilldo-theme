<?php
ThemeOption::addGroupSub('header', 'slogan', ['name' => 'Slogan']);
ThemeOption::addField('header', 'header_slogan', 'image', ['sub' => 'slogan', 'label' => 'Ảnh slogan', 'after' => '<div class="builder-col-6 col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_slogan_height', 'number', ['sub' => 'Slogan', 'label' => 'Chiều cao slogan', 'after' => '<div class="builder-col-6 col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_txt', 'text', ['sub' => 'slogan', 'label' => 'Mô tả']);
ThemeOption::addField('header', 'header_txt_color', 'color', ['sub' => 'slogan', 'label' => 'Màu mô tả']);

ThemeOption::addField('header', 'header_icon_hotline', 'image', ['label' => 'Icon Hotline', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_color', 'color', ['label' => 'Icon color', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);