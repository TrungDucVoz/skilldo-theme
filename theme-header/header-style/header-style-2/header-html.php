<!-- header content -->
<div class="header-content">
	<div class="container">
		<div class="row">

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
				<div class="box-social">
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