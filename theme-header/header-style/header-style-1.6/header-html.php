<!-- header content -->
<div class="header-content hidden-xs hidden-sm">
	<div class="container">
		<div class="row row-flex-center">
			<div class="col-md-3 text-<?php echo option::get('logo_position');?> logo">
				<?php if( is_home() ) {?>
				<h1 style="display: none"><?php echo option::get('general_label');?></h1>
				<?php } ?>
				<a href="<?php echo Url::base();?>" title="<?php echo option::get('general_label');?>">
					<?php Template::img(option::get('logo_header'), option::get('general_label'));?>
				</a>
			</div>
			<div class="col-md-4">
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
			<div class="col-md-5 text-center row-flex-center row-flex-gap">

				<div class="hotline">
					<div class="hotline__icon">
						<?php Template::img(option::get('header_icon_hotline'), 'Hotline:'.option::get('contact_phone'));?>
					</div>
					<div class="hotline__title">
						<a href="tel:<?php echo option::get('contact_phone');?>">
							<p>HOTLINE</p>
                            <p class="hotline__phone"><?php echo option::get('contact_phone');?></p>
						</a>
					</div>
				</div>

                <?php $listItem = Option::get('header_item');?>
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
                            <div class="img"><a href="<?php echo $item['url'];?>"><?php Template::img($item['image'], $item['title']);?></a></div>
                            <div class="title">
                                <p class="heading"><a href="<?php echo $item['url'];?>"><?php echo $item['title'];?></a></p>
                                <p class="description"><?php echo $item['description'];?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php } ?>

                <div class="cart-top">
                    <div class="cart-top__icon">
                        <a href="gio-hang"><?php Template::img(option::get('header_icon_cart'), 'Giỏ hàng');?></a>
                    </div>
                    <div class="cart-top__title">
                        <a href="gio-hang">
                            <p><b>Giỏ hàng</b></p>
                            <p><span class="wcmc-total-items"><?= SCart::totalQty();?></span> sản phẩm</p>
                        </a>
                    </div>
                </div>
				
			</div>
		</div>
	</div>
</div>