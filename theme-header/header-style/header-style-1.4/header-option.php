<?php
ThemeOption::addGroupSub('header', 'item', ['name' => 'Item']);
ThemeOption::addField('header', 'header_item_title_color', 'color', ['sub' => 'item', 'label' => 'Màu chữ tiêu đề item', 'after' => '<div class="clearfix"></div><div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item_description_color', 'color', ['sub' => 'item', 'label' => 'Màu chữ mô tả item', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_item', 'ThemeHeaderStyle1_4::inputItem', ['sub' => 'item', 'number' => 2]);
