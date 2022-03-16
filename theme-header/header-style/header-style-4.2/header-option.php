<?php
ThemeOption::addGroupSub('header', 'icon', ['name' => 'Tìm kiếm & Giỏ hàng & Hotline']);

ThemeOption::addField('header', 'search_icon_color', 'color', ['sub' => 'icon', 'label' => 'Màu icon tìm kiếm']);
ThemeOption::addField('header', 'header_icon_cart', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon giỏ hàng</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_hotline', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon hotline</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'hotline_color_heading', 'color', ['sub' => 'icon', 'label' => 'Màu chữ hotline', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'hotline_color_phone', 'color', ['sub' => 'icon', 'label' => 'Màu số điện thoại', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
