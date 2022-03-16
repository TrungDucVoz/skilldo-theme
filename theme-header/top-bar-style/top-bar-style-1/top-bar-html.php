<div class="top-bar" id="top-bar">
	<div class="container">
		<div class="row row-flex-center">
			<div class="col-md-6">
				<i class="fal fa-envelope"></i> <?php echo option::get('contact_mail');?>  |
				<a href="tel:<?php echo Option::get('contact_phone');?>"><i class="fal fa-phone"></i> <?php echo Option::get('contact_phone');?></a>
			</div>
			<div class="col-md-6 text-right">
				<div class="social-icon">
                    <?php 
                        $social = get_theme_social();
                        foreach ($social as $key => $field) {
                            if(empty(Option::get('top_bar_'.$field['field'].'_icon'))) continue; ?>
                            <a href="<?php echo Option::get($field['field']);?>" class="effect-filter">
                                <?php Template::img(option::get('top_bar_'.$field['field'].'_icon'), $field['label']);?>
                            </a>
                        <?php }
                    ?>
				</div>
			</div>
		</div>
	</div>
</div>