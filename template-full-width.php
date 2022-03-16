<?php /**
Layout-name: Template Full Width
*/?>
<?php $layout = get_theme_layout();?>
<!DOCTYPE html>
<html lang="<?= Language::current();?>" <?php do_action('in_tag_html');?>>
	<?php Template::partial('include/head'); ?>
	<body class="" <?php do_action('in_tag_body');?> style="height: auto">
        <?php Template::partial('include/mobile-header'); ?>
		<div id="td-outer-wrap">
			<div class="warper">
                <?php Template::partial('include/top'); ?>
				<?php if(isset($layout['banner']) && $layout['banner'] == 'full-width') {
					Template::partial('include/banner');
				} ?>
				<?php if(is_page('products_detail')) {?>
					<?php echo '<div class="products-breadcrumb"><div class="container">'.Breadcrumb(Template::breadcrumb()).'</div></div>';?>
				<?php } ?>
				<div class="container">
				<?php if(isset($layout['banner']) && $layout['banner'] == 'in-container') {
					Template::partial('include/banner');
				} ?>
				<?php $this->template->render_view(); ?>
				</div>
			</div>
			<?php Template::partial('include/footer'); ?>
		</div>
	</body>
</html>