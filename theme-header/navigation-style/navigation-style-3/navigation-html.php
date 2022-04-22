<div class="navigation hidden-xs">
	<div class="container">
        <div class="row row-flex-center">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 vertical-menu">
                <div class="menu-vertical <?php echo (!is_home()) ? 'no-home' : '';?>" style="z-index:53">
                    <div class="bg-vertical"></div>
                    <h4 class="menu-vertical__header">
                        <i class="fal fa-bars"></i>
                        <span><?php echo option::get('nav_vh_text', 'Danh mục sản phẩm');?></span>
                    </h4>
                    <div class="menu-vertical__content">
                        <div class="menu-vertical__category">
                            <?php $type = Option::get('nav_v_type', 'style2');
                            if(empty($type) || $type == 'style1') {
                                Template::partial(ThemeNavigationStyle3::$path.'navigation-html-style-1');
                            }
                            if($type == 'style2') {
                                Template::partial(ThemeNavigationStyle3::$path.'navigation-html-style-2');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 header-list-item" style="padding-left: 0;">
                <?php $listItem = Option::get('navigation_item');?>
                <?php if(!empty($listItem)) {?>
                <?php foreach ($listItem as $key => $item): ?>
                    <?php
                    $current = Language::current();
                    if(Language::hasMulti() && Language::default() != $current) {
                        if(isset($item['title_'.$current])) $item['title'] = $item['title_'.$current];
                        if(isset($item['description_'.$current])) $item['description'] = $item['description_'.$current];
                    }
                    ?>
                    <div class="item item<?php echo $key;?>">
                        <div class="img"><?php Template::img($item['image'], $item['title']);?></div>
                        <div class="title">
                            <p class="heading"><?php echo $item['title'];?></p>
                            <p class="description"><?php echo $item['description'];?></p>
                        </div>
                    </div>
                <?php endforeach ?>
                <?php } ?>
            </div>
        </div>
	</div>
</div>
<?php if( is_home() ) {?>
<section class="section-vertical">
	<div class="container">
		<div class="row">
            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm vertical-menu"></div>
			<div class="col-lg-9 col-md-8 vertical-slider">
				<?php sidebar::render('home-slider');?>
			</div>
		</div>
	</div>
</section>
<?php } ?>