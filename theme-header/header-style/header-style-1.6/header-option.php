<?php
ThemeOption::addGroupSub('header', 'search', ['name' => 'Tìm kiếm']);
ThemeOption::addGroupSub('header', 'item', ['name' => 'Header Item']);
ThemeOption::addGroupSub('header', 'icon', ['name' => 'Giỏ hàng & Hotline']);

ThemeOption::addField('header', 'search_border_color', 'color', ['sub' => 'search', 'label' => 'Màu viền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_txt_color', 'color', ['sub' => 'search', 'label' => 'Màu chữ button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addField('header', 'header_item_title_color', 'color', ['sub' => 'item', 'label' => 'Màu chữ tiêu đề item', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item_description_color', 'color', ['sub' => 'item', 'label' => 'Màu chữ mô tả item', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item', 'ThemeHeaderStyle1_6::inputItem', ['sub' => 'item', 'number' => 0]);

ThemeOption::addField('header', 'header_icon_cart', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon giỏ hàng</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_hotline', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon hotline</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'hotline_color_heading', 'color', ['sub' => 'icon', 'label' => 'Màu chữ hotline', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'hotline_color_phone', 'color', ['sub' => 'icon', 'label' => 'Màu số điện thoại', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
