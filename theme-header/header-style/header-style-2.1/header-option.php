<?php
ThemeOption::addGroupSub('header', 'slogan', ['name' => 'Slogan']);
ThemeOption::addGroupSub('header', 'search', ['name' => 'Tìm kiếm']);

ThemeOption::addField('header', 'header_slogan', 'image', ['sub' => 'slogan', 'label' => 'Ảnh slogan', 'after' => '<div class="builder-col-6 col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_slogan_height', 'number', ['sub' => 'Slogan', 'label' => 'Chiều cao slogan', 'after' => '<div class="builder-col-6 col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_txt', 'text', ['sub' => 'slogan', 'label' => 'Mô tả']);
ThemeOption::addField('header', 'header_txt_color', 'color', ['sub' => 'slogan', 'label' => 'Màu mô tả']);

ThemeOption::addField('header', 'search_border_color', 'color', ['sub' => 'search', 'label' => 'Màu viền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_txt_color', 'color', ['sub' => 'search', 'label' => 'Màu chữ button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);