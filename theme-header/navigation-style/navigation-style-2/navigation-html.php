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
                            <?php $type = Option::get('nav_v_type', 'style2');?>
                            <?php
                                if(empty($type) || $type == 'style1') include_once 'navigation-html-style-1.php';
                                if($type == 'style2') include_once 'navigation-html-style-2.php';
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
<?php if( is_home() ) {?>
<section class="section-vertical">
	<div class="container">
		<div class="row">
            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm vertical-menu">
            </div>
			<div class="col-lg-9 col-md-8 vertical-slider">
				<?php sidebar::render('home-slider');?>
			</div>
		</div>
	</div>
</section>
<?php } ?>