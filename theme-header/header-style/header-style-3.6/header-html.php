<!-- header content -->
<div class="header-content">
	<div class="container">
		<div class="row row-flex-center">
			<div class="col-md-2 text-<?php echo Option::get('logo_position');?> logo">
				<?php if( is_home() ) {?>
				<h1 style="display: none"><?php echo option::get('general_label');?></h1>
				<?php } ?>
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img($logo, option::get('general_label'));?>
				</a>
			</div>
			<div class="col-md-7">
				<?php do_action('cle_header_navigation');?>
			</div>
			<div class="col-md-3 text-center row-flex-center" style="justify-content: right">
                <div>
                    <div style="display: flex; gap: 5px;">
                        <a href="tel:<?php echo Option::get('contact_phone');?>" class="hotline"><i class="far fa-phone-alt"></i> <?php echo Option::get('contact_phone');?></a>
                        <a class="btn-search js_btn_panel__sidebar" href="#search-sidebar"><i class="fal fa-search"></i></a>
                    </div>
                    <div class="text-left header-right-text"><a href="<?php echo $textUrl;?>"><?php echo $text;?></a></div>
                </div>
			</div>
		</div>
	</div>
</div>