<?php
ThemeOption::addGroupSub('header', 'icon', ['name' => 'Tìm kiếm & Giỏ hàng & Hotline']);

ThemeOption::addField('header', 'search_icon_color', 'color', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Màu icon tìm kiếm</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_cart', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon giỏ hàng</label><div class="form-group group">', 'before' => '</div></div>']);