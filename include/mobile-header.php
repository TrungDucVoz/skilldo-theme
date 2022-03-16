<?php echo Option::get('body_script'); ?>
<!-- MOBILE -->
<div class="header-mobile hidden-md hidden-lg">
	<div class="container">
		<div class="row">
			<div class="col-xs-4">
                <a href="#menu" class="btn-menu-mobile"><i class="fal fa-bars"></i></a>
            </div>
			<div class="col-xs-4 logo text-center">
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img(option::get('logo_header'), option::get('general_label'));?>
				</a>
			</div>
			<div class="col-xs-4">
				<a class="js_btn_panel__sidebar btn-search-mobile" href="#search-sidebar"><i class="fal fa-search"></i></a>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<!-- <div class="search">
		<form class="navbar-form form-search" action="search" method="get" role="search" style="margin:0;padding:0;">
			<div class="form-group" style="margin:0;padding:0;width: calc( 100% - 50px);float:left;">
				<input class="form-control search-field" type="text" value="" name="keyword" placeholder="<?php echo __('Tìm kiếm', 'theme_timkiem');?>" style="width: 100%;">
				<input type="hidden" value="products" name="type">
			</div>
			<button type="submit" class="btn btn-search btn-default" style="width:50px;float:left;"><i class="fa fa-search" aria-hidden="true"></i></button>
		</form>
	</div> -->
</div>
<?php
$mobile_category_icon = Option::get('mobile_category_icon');
if(!empty($mobile_category_icon)) {
    Template::partial('include/mobile-category-icon');
}
Template::partial('include/mobile-search');
Template::partial('include/mobile-menu');
if(class_exists('sicommerce_cart')) {
    Template::partial('include/mobile-cart');
    Template::partial('include/mobile-navigation');
}