<?php
ThemeOption::addGroupSub('header', 'search', ['name' => 'Tìm kiếm']);
ThemeOption::addGroupSub('header', 'trending', ['name' => 'Tag Trending']);
ThemeOption::addGroupSub('header', 'item', ['name' => 'Header Item']);
ThemeOption::addGroupSub('header', 'icon', ['name' => 'Giỏ hàng']);

ThemeOption::addField('header', 'search_border_color', 'color', ['sub' => 'search', 'label' => 'Màu viền', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_border_radius', 'number', ['sub' => 'search', 'label' => 'Độ Bo tròn các góc', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>', 'value' => 5]);
ThemeOption::addField('header', 'search_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_bg_color', 'color', ['sub' => 'search', 'label' => 'Màu nền button search', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'search_btn_txt_color', 'color', ['sub' => 'search', 'label' => 'Màu chữ button search', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addField('header', 'header_trending_text', 'text', ['sub' => 'trending', 'label' => 'Chữ trending', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_trending_color', 'color', ['sub' => 'trending', 'label' => 'Màu chữ trending', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_trending_tag', 'color', ['sub' => 'trending', 'label' => 'Màu chữ tag trending', 'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>']);

ThemeOption::addField('header', 'header_item_title_color', 'color', ['sub' => 'item', 'label' => 'Màu chữ tiêu đề item', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item_description_color', 'color', ['sub' => 'item', 'label' => 'Màu chữ mô tả item', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item', 'ThemeHeaderStyle1_8::inputItem', ['sub' => 'item', 'number' => 2]);

ThemeOption::addField('header', 'header_icon_cart', 'image', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Icon giỏ hàng</label><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_icon_color', 'color', ['sub' => 'icon', 'after' => '<div class="col-md-6"><label>Màu chữ</label><div class="form-group group">', 'before' => '</div></div>']);