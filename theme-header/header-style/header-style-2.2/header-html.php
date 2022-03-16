<!-- header content -->
<div class="header-content">
	<div class="container">
		<div class="row row-flex-center">

			<div class="col-md-3 text-<?php echo option::get('logo_position');?> logo">
				<?php if( is_home() ) {?>
				<h1 style="display: none"><?php echo option::get('general_label');?></h1>
				<?php } ?>
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img(option::get('logo_header'), option::get('general_label'));?>
				</a>
			</div>

			<div class="col-md-6 text-center">
				<div class="slogan"><?php Template::img(option::get('header_slogan'), option::get('general_label'));?></div>
                <p class="address"><?php echo option::get('header_txt');?></p>
			</div>
			
			<div class="col-md-3 text-right">
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
		</div>
	</div>
</div>