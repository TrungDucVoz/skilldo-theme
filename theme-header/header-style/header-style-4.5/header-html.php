<!-- header content -->
<div class="header-content">
    <div class="container">
        <div class="row row-flex-center">
            <div class="col-md-5">
                <?php do_action('cle_header_navigation');?>
            </div>

            <div class="col-md-2 text-<?php echo $logoPosition;?> logo">
                <?php if( is_home() ) {?>
                    <h1 style="display: none"><?php echo Option::get('general_label');?></h1>
                <?php } ?>
                <a href="<?php echo Url::base();?>" title="<?php echo Option::get('general_label');?>">
                    <?php Template::img($logo, Option::get('general_label'));?>
                </a>
            </div>

            <div class="col-md-5 text-right row-flex-center row-flex-gap">
                <a class="btn-search js_btn_panel__sidebar row-flex-center" href="#search-sidebar"><i class="fal fa-search"></i> <span>Tìm kiếm</span></a>
                <div class="cart-top">
                    <a href="gio-hang" class="btn-cart-top">
                        <?php Template::img($iconCart,'Giỏ hàng');?>
                        <span class="wcmc-total-items"><?= (function_exists('SCart::totalQty')) ? (class_exists('SCart')) ? SCart::totalQty() : 0 : 0;?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>