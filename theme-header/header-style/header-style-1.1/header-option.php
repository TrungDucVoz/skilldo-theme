<?php
ThemeOption::addGroupSub('header', 'search', ['name' => 'Tìm kiếm']);
ThemeOption::addGroupSub('header', 'icon', ['name' => 'Giỏ hàng & Account']);

ThemeOption::addField('header', 'search_border_color', 'color', ['sub' => 'search', 'label' => 'Màu viền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_txt_color', 'color', ['sub' => 'search', 'label' => 'Màu chữ button search', 'after' => '<div class="col-md-3"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addField('header', 'header_icon_cart', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon giỏ hàng</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_account', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon account</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_txt_color', 'color', ['sub' => 'icon', 'label' => 'Màu text icon']);
