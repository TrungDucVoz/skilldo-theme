<!-- header content -->
<div class="header-content">
	<div class="container">
		<div class="row row-flex-center">
			<div class="col-md-4">
				<div class="hotline">
					<div class="hotline__icon">
						<?php Template::img($iconPhone, 'Hotline:'.option::get('contact_phone'));?>
					</div>
					<div class="hotline__title">
						<a href="tel:<?php echo $phone;?>">
							<p>Hotline: <span class="hotline__phone"><?php echo $phone;?></span></p>
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 text-<?php echo $logoPosition;?> logo">
				<?php if( is_home() ) {?>
				<h1 style="display: none"><?php echo Option::get('general_label');?></h1>
				<?php } ?>
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img($logo, Option::get('general_label'));?>
				</a>
			</div>
			
			<div class="col-md-4 text-right row-flex-center row-flex-gap">
                <a class="btn-search js_btn_panel__sidebar" href="#search-sidebar"><i class="fal fa-search"></i></a>
				<div class="cart-top">
					<a href="gio-hang" class="btn-cart-top">
						<?php Template::img($iconCart,'Giỏ hàng');?>
						<span class="wcmc-total-items"><?= (class_exists('SCart')) ? SCart::totalQty() : 0;?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>