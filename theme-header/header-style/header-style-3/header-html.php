<!-- header content -->
<div class="header-content">
	<div class="container">
		<div class="row">

			<div class="col-md-3 text-<?php echo option::get('logo_position');?> logo">
				<?php if( is_home() ) {?>
				<h1 style="display: none"><?php echo option::get('general_label');?></h1>
				<?php } ?>
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img($logo, option::get('general_label'));?>
				</a>
			</div>

			<div class="col-md-9">
				<?php do_action('cle_header_navigation');?>
			</div>
		</div>
	</div>
</div>