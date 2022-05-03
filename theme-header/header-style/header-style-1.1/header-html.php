<!-- header content -->
<div class="header-content hidden-xs hidden-sm">
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
			<div class="col-md-6">
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
			<div class="col-md-4 text-right row-flex-center" style="justify-content: right;">
				<div class="cart-top">
					<a href="gio-hang" class="btn-cart-top">
						<div style="position:relative; display:inline-block;">
							<?php Template::img($iconCart,'Giỏ hàng');?>
							<span class="wcmc-total-items"><?= (class_exists('SCart')) ? SCart::totalQty() : 0;?></span>
						</div>
						<span><?php echo __('Giỏ hàng');?></span>
					</a>
				</div>
                <div class="group-account">
                    <?php if( !Auth::check() ) {?>
                        <span class="account-icon"><?php Template::img(option::get('header_icon_account'), 'tài khoản');?></span>
                        <span class="account-name">Tài khoản</span> <i class="fal fa-chevron-down"></i>
                        <div class="account-popup">
                            <a class="btn btn-effect-default btn-theme" href="<?php echo Url::login();?>"><?php echo __('Đăng nhập');?></a>
                            <a class="btn btn-effect-default btn-theme" href="<?php echo Url::register();?>"><?php echo __('Đăng ký');?></a>
                        </div>
                    <?php } else { ?>
                        <?php $user = Auth::user();?>
                        <span class="account-icon"><?php Template::img(option::get('header_icon_account'), 'tài khoản');?></span>
                        <span class="account-name">Xin chào, <?php echo (!empty($user->lastname))? ' '.$user->lastname:'';?> </span> <i class="fal fa-chevron-down"></i>
                        <div class="account-popup">
                            <a class="btn btn-effect-default btn-theme" href="<?php echo my_account_url();?>">Thông Tin</a>
                            <?php if(class_exists('sicommerce_cart')) { ?>
                                <a class="btn btn-effect-default btn-theme" href="<?php echo my_account_url('order/history');?>">Đơn hàng</a>
                            <?php } ?>
                            <a class="btn btn-effect-default btn-theme" href="<?php echo Url::logout();?>"><?php echo __('Đăng xuât');?></a>
                        </div>
                    <?php } ?>
                </div>
			</div>
		</div>
	</div>
</div>