<!-- header content -->
<div class="header-content">
	<div class="container">
		<div class="row row-flex-center">
			<div class="col-md-4">
				<div class="hotline">
					<div class="hotline__icon">
						<?php Template::img(option::get('header_icon_hotline'), 'Hotline:'.option::get('contact_phone'));?>
					</div>
					<div class="hotline__title">
						<a href="tel:<?php echo option::get('contact_phone');?>">
							<p>Hotline: <span class="hotline__phone"><?php echo option::get('contact_phone');?></span></p>
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 text-<?php echo option::get('logo_position');?> logo">
				<?php if( is_home() ) {?>
				<h1 style="display: none"><?php echo option::get('general_label');?></h1>
				<?php } ?>
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img(option::get('logo_header'), option::get('general_label'));?>
				</a>
			</div>
			
			<div class="col-md-4 text-right row-flex-center row-flex-gap">
                <a class="btn-search js_btn_panel__sidebar" href="#search-sidebar"><i class="fal fa-search"></i></a>
				<div class="cart-top">
					<a href="gio-hang" class="btn-cart-top">
						<?php Template::img(option::get('header_icon_cart'),'Giỏ hàng');?>
						<span class="wcmc-total-items"><?= SCart::totalQty();?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>