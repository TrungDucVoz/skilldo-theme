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
				<h1 style="display: none"><?php echo option::get('general_label');?></h1>
				<?php } ?>
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img($logo, option::get('general_label'));?>
				</a>
			</div>
			
			<div class="col-md-4 text-right">
				<div class="box-social row-flex-center"style="justify-content: right; gap: 10px;">
				<?php 
					$social = get_theme_social();
					foreach ($social as $key => $field) {
						if(empty(option::get('header_'.$field['field'].'_icon'))) continue; ?>
						<a href="<?php echo get_option($field['field']);?>" class="effect-filter">
							<?php Template::img(option::get('header_'.$field['field'].'_icon'), $field['label']);?>
						</a>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>