<?php
ThemeOption::addGroupSub('header', 'hotline', ['name' => 'hotline']);
ThemeOption::addField('header', 'header_icon_hotline', 'image', ['sub' => 'hotline', 'label' => 'Icon Hotline']);
ThemeOption::addField('header', 'header_hotline_color_heading', 'color', ['sub' => 'hotline', 'label' => 'Màu chữ hotline', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
ThemeOption::addField('header', 'header_hotline_color_phone', 'color', ['sub' => 'hotline', 'label' => 'Màu chữ số điện thoại', 'after' => '<div class="col-md-6"><div class="form-group group">', 'before' => '</div></div>']);
