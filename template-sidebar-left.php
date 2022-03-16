<?php /**
Layout-name: Template slider left
*/?>
<?php $layout = get_theme_layout(); ?>
<!DOCTYPE html>
<html lang="<?= Language::current();?>" <?php do_action('in_tag_html');?>>
	<?php Template::partial('include/head'); ?>
	<body <?php do_action('in_tag_body');?>>
		<?php Template::partial('include/mobile-header'); ?>
		<div id="td-outer-wrap">
			<div class="warper warper-<?php echo $this->template->class;?>">
                <?php Template::partial('include/top'); ?>
				<?php if(isset($layout['banner']) && $layout['banner'] == 'full-width') {
					Template::partial('include/banner');
				} ?>
				<div class="container">
					<?php if(isset($layout['banner']) && $layout['banner'] == 'in-container') {
						Template::partial('include/banner');
					} ?>
					<div class="row">
						<div class="col-md-push-3 col-md-9">
							<?php $this->template->render_view(); ?>
						</div>
						<div class="col-md-pull-9 col-md-3 sidebar">
							<?php Template::partial('include/sidebar');?>
						</div>
					</div>
				</div>
			</div>
			<?php Template::partial('include/footer'); ?>
		</div>
	</body>
</html>