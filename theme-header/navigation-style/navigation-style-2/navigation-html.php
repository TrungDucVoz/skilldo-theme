<?php $navMarginTop = (int)Option::get('nav_vh_margin_top');?>
<div class="navigation hidden-xs">
	<div class="container">
        <div class="row row-flex-center">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 vertical-menu">
                <div class="menu-vertical <?php echo (is_home() && empty($navMarginTop)) ? '' : 'no-home';?>" style="z-index:53">
                    <div class="bg-vertical"></div>
                    <h4 class="menu-vertical__header">
                        <i class="fal fa-bars"></i>
                        <span><?php echo Option::get('nav_vh_text', 'Danh mục sản phẩm');?></span>
                    </h4>
                    <div class="menu-vertical__content">
                        <div class="menu-vertical__category">
                            <?php $type = Option::get('nav_v_type', 'style2');
                            if(empty($type) || $type == 'style1') {
                                Template::partial(ThemeNavigationStyle2::$path.'navigation-html-style-1');
                            }
                            if($type == 'style2') {
                                Template::partial(ThemeNavigationStyle2::$path.'navigation-html-style-2');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 horizontal-menu" style="padding-left: 0;">
                <nav class="navbar" role="navigation">
                    <div class="collapse navbar-collapse" id="navbar-main" data-hover="dropdown" data-animations="fadeInUp fadeInRight fadeInUp fadeInLeft" aria-expanded="true">
                        <ul class="nav navbar-nav <?php echo option::get('nav_position');?>">
                            <?php echo ThemeMenu::render(['theme_location' => 'main-nav', 'walker' => 'store_bootstrap_nav_menu']);?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
	</div>
</div>
<?php if(is_home()) {?>
<section class="section-vertical" style="--nav-hv-margin-top:<?php echo $navMarginTop;?>px">
	<div class="container">
		<div class="row">
            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm vertical-menu">
                <?php if(!empty($navMarginTop)) {?>
                <div class="menu-vertical menu-vertical-home">
                    <div class="menu-vertical__content">
                        <div class="menu-vertical__category">
                            <?php
                            if(empty($type) || $type == 'style1') {
                                Template::partial(ThemeNavigationStyle2::$path.'navigation-html-style-1');
                            }
                            if($type == 'style2') {
                                Template::partial(ThemeNavigationStyle2::$path.'navigation-html-style-2');
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
			<div class="col-lg-9 col-md-8 vertical-slider">
				<?php sidebar::render('home-slider');?>
			</div>
		</div>
	</div>
</section>
<?php } ?>