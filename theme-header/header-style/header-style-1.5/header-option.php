<?php
ThemeOption::addGroupSub('header', 'search', ['name' => 'Tìm kiếm']);
ThemeOption::addGroupSub('header', 'item', ['name' => 'Header Item']);
ThemeOption::addGroupSub('header', 'icon', ['name' => 'Giỏ hàng']);

ThemeOption::addField('header', 'search_border_color', 'color', ['sub' => 'search', 'label' => 'Màu viền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_txt_color', 'color', ['sub' => 'search', 'label' => 'Màu chữ button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addField('header', 'header_item_title_color', 'color', ['sub' => 'item', 'label' => 'Màu chữ tiêu đề item', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item_bg_color', 'color', ['sub' => 'item', 'label' => 'Màu nền item', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item', 'ThemeHeaderStyle1_5::inputItem', ['sub' => 'item', 'number' => 1]);