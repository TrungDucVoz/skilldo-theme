<div class="top-bar" id="top-bar">
	<div class="container">
		<div class="row row-flex-center">
			<div class="col-md-4 hotline">
				<a href="tel:<?php echo option::get('contact_phone');?>"><i class="fas fa-phone-alt"></i>  HOTLINE <?php echo option::get('contact_phone');?></a>
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-4 text-right" style="justify-content: right">
                <div class="group-account" style="justify-content: right">
                    <?php if( !Auth::check() ) {?>
                        <span class="account-icon"><i class="fal fa-user"></i></span>
                        <span class="account-name">Tài khoản</span> <i class="fal fa-chevron-down"></i>
                        <div class="account-popup">
                            <a class="btn btn-effect-default btn-theme" href="<?php echo Url::login();?>"><?php echo __('Đăng nhập');?></a>
                            <a class="btn btn-effect-default btn-theme" href="<?php echo Url::register();?>"><?php echo __('Đăng ký');?></a>
                        </div>
                    <?php } else { ?>
                        <?php $user = Auth::user();?>
                        <span class="account-icon"><i class="fal fa-user"></i></span>
                        <span class="account-name">Xin chào, <?php echo (!empty($user->lastname))? ' '.$user->lastname:'';?> </span>
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