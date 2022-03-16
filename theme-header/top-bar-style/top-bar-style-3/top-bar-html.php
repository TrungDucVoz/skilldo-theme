<div class="top-bar" id="top-bar">
	<div class="container">
		<div class="row row-flex-center">
			<div class="col-md-6 hotline">
				<span><?php echo option::get('top_bar_text');?></span>
			</div>
			<div class="col-md-6 navigation-top-bar">
				<nav class="navbar navbar-default" role="navigation">
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right row-flex-center">
							<?php echo ThemeMenu::render(array( 'theme_location' => 'top-bar', 'walker' => 'store_nav_menu_vertical'));?>
							<li><a href="tel:<?php echo option::get('contact_phone');?>">HOTLINE: <?php echo option::get('contact_phone');?></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav>
			</div>
		</div>
	</div>
</div>