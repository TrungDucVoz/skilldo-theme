<?php do_action( 'before_products_index' );?>
<?php
	$layout 		= get_theme_layout();

	if(isset($layout['banner'])) {
		if($layout['banner'] == 'in-content') Template::partial('include/banner');
	}
	else {
		if(isset($category) && have_posts($category)) {
			$name = $category->name;
		}
		else if(isset($brand) && have_posts($brand)) {
		    $name = $brand->name;
        }
		else $name = __('Sản phẩm');

		$breadcrumb = Template::breadcrumb();

		echo Breadcrumb($breadcrumb);?>
		<h1 class="header text-left"><?= $name;?></h1>
		<style>
			h1.header { text-align:left;}
			.btn-breadcrumb a.btn.btn-default {color: #000; line-height: 37px;}
			.btn-breadcrumb span:first-child a { padding-left:0;}
		</style>
		<?php
	}
?>
<?php
	/**
	 * content_products_index
	 *
	 * @Hook  woocommerce_products_index - 10
	 */
	do_action( 'content_products_index' );
?>

<?php do_action( 'after_products_index' );?>