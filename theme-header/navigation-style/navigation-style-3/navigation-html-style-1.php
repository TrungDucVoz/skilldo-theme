<ul class="menu-vertical__category__nav">
    <?php
    $menuData = ThemeMenu::getData('main-vertical');
    $countHiden = 0;
    foreach ($menuData as $itemLevel1) {
        $icon = '';
        if(!empty($itemLevel1->data['icon'])) {
            $icon = '<div class="icon">'.Template::img($itemLevel1->data['icon'], $itemLevel1->name, ['return' => true]).'</div>';
        }
        $countHiden++;
        ?>
        <li class="nav-item <?php echo ($countHiden >= 8) ? 'nav-hidden' : '';?> <?php echo (!empty($itemLevel1->child) && have_posts($itemLevel1->child)) ? 'dropdown' : '';?>">
            <a href="<?php echo Url::permalink($itemLevel1->slug);?>" class="nav-link">
                <?php echo $icon;?><span><?php echo $itemLevel1->name;?></span>
                <?php if(!empty($itemLevel1->child) && have_posts($itemLevel1->child)) {?><i class="fal fa-chevron-right"></i> <?php } ?>
            </a>
            <?php if(!empty($itemLevel1->child) && have_posts($itemLevel1->child)) {?>
                <div class="sub-menu-dropdown">
                    <div class="sub-menu-dropdown-container">
                        <?php foreach ($itemLevel1->child as $itemLevel2) { ?>
                            <div class="col-inner">
                                <ul class="mega-menu-list">
                                    <li>
                                        <a href="<?php echo Url::permalink($itemLevel2->slug);?>" class="nav-link"><span><?php echo $itemLevel2->name;?></span></a>
                                        <?php if(!empty($itemLevel2->child) && have_posts($itemLevel2->child)) {?>
                                            <ul class="sub-sub-menu">
                                                <?php foreach ($itemLevel2->child as $itemLevel3) { ?>
                                                    <li>
                                                        <a href="<?php echo Url::permalink($itemLevel3->slug);?>" class="nav-link"><span><?php echo $itemLevel3->name;?></span></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </li>
    <?php } ?>
    <?php if($countHiden >= 8) {?>
    <li class="nav-item">
        <a href="#" class="nav-link js_navigation_vertical__show"><span><i class="fal fa-plus"></i> Xem thêm</span></a>
    </li>
    <?php } ?>
</ul>