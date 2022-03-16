<header class="hidden-xs">
	<?php do_action('cle_header_top_bar');?>
	<!-- header content -->
	<div class="header-content">
		<div class="container">
			<div class="row row-flex-center">
				<div class="col-md-2 text-<?php echo option::get('logo_position');?> logo">
					<?php if( is_home() ) {?>
					<h1 style="display: none"><?php echo option::get('general_label');?></h1>
					<?php } ?>
					<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
						<?php Template::img($logo, option::get('general_label'));?>
					</a>
				</div>
				<div class="col-md-10 list-item">
                    <?php if(have_posts($listItem)) {?>
					<?php foreach ($listItem as $key => $item): ?>
                        <?php
                        $current = Language::current();
                        if(Language::hasMulti() && Language::default() != $current) {
                            if(isset($item['title_'.$current])) $item['title'] = $item['title_'.$current];
                            if(isset($item['description_'.$current])) $item['description'] = $item['description_'.$current];
                        }
                        ?>
						<div class="item item<?php echo $key;?>">
							<div class="img"><?php Template::img($item['image'], $item['title']);?></div>
							<div class="title">
								<p class="heading"><?php echo $item['title'];?></p>
								<p class="description"><?php echo $item['description'];?></p>
							</div>
						</div>
					<?php endforeach ?>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('cle_header_navigation');?>
</header>