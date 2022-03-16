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

            <div class="col-md-3">
                <div class="search">
                    <form class="navbar-form form-search" action="search" method="get" role="search" style="margin:0;padding:0;" autocomplete="off">
                        <div class="form-group" style="margin:0;padding:0;">
                            <input class="form-control" type="text" value="" name="keyword" placeholder="Nhập sản phẩm tìm kiếm" id="searchInput">
                            <?php if(class_exists('sicommerce')) { ?><input type="hidden" name="type" value="products"><?php } ?>
                        </div>
                        <button type="submit" class="btn btn-search btn-default"><i class="fal fa-search" aria-hidden="true"></i></button>
                    </form>
                    <div class="live-search-results" style="display: none;">
                        <div class="autocomplete-suggestions">
                            <div class="ttitle"><div class="viewed"><?php echo __('Sản phẩm gợi ý', 'theme_auto_search_title');?></div></div>
                            <div class="product-slider-vertical"></div>
                        </div>
                    </div>
                </div>
            </div>

			<div class="col-md-6">
				<?php do_action('cle_header_navigation');?>
			</div>

			<div class="col-md-1 text-center">
				<a href="gio-hang" class="btn-cart-top">
					<?php Template::img($iconCart,'Giỏ hàng');?>
					<span class="wcmc-total-items"><?= (class_exists('SCart')) ? SCart::totalQty() : 0;?></span>
				</a>
			</div>
		</div>
	</div>
</div>