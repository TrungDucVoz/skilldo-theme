<?php
$layout 		= get_theme_layout();
// $layout_setting = get_theme_layout_setting();
if(isset($layout['banner'])) {
	if($layout['banner'] == 'in-content') Template::partial('include/banner');
}
else {
	$breadcrumb = Template::breadcrumb();
	echo Breadcrumb($breadcrumb);?>
	<h1 class="header text-left"><?= $object->title;?></h1>
	<style>
		h1.header { text-align:left;}
		.btn-breadcrumb a.btn.btn-default { color: #000;    line-height: 37px; }
	</style>
	<?php
}
?>
<div class="object-detail">
	<?php if(have_posts($object)) {?>
		<div class="info" style="overflow: hidden;">
			<div class="pull-left">
				<div class="block"> <span class="post-time"> <i class="far fa-calendar"></i> <?php echo date('d/m/Y', strtotime($object->created));?></span> </div>
				<?php if( isset($category->name) ) : ?>
				<div class="block"> <span class="post-time"> <i class="fas fa-file-alt"></i> <?php echo $category->name;?></span> </div>
				<?php endif;?>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="excerpt"><?php echo $object->excerpt;?></div>
		<!-- content -->
		<div class="object-detail-content">
			<?php the_content();?>
		</div>
		
		<div class="td-post-sharing td-post-sharing-bottom td-with-like">
			<span class="td-post-share-title">Chia sẻ</span>
            <div class="td-default-sharing">
	            <a class="td-social-sharing-buttons td-social-facebook" href="http://www.facebook.com/sharer.php?u=<?= Url::current();?>" onclick="window.open(this.href, 'mywin','left=50%,top=50%,width=600,height=350,toolbar=0'); return false;">
                    <i class="fab fa-facebook-f"></i>
                </a>
	            <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=<?php echo $object->title;?>&amp;url=<?= Url::current();?>" onclick="window.open(this.href, 'mywin','left=50%,top=50%,width=600,height=350,toolbar=0'); return false;">
                    <i class="fab fa-twitter"></i>
                </a>
	            <a class="td-social-sharing-buttons td-social-pinterest" href="http://pinterest.com/pin/create/button/?url=<?= Url::current();?>&amp;media=<?php echo Template::imgLink($object->image);?>&amp;description=<?php echo Str::clear($object->excerpt);?>&amp;" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
                    <i class="fab fa-pinterest-p"></i>
                </a>
			</div>
		</div>

		<?php 
			$args = array(
				'where' => array('public' => 1, 'trash' => 0, 'post_type' => $object->post_type),
				'params' => array( 'limit' => 6 ),
				'related' => $object->id
			);

			// Get visble related products then sort them at random.
			$args['related_post'] = Posts::gets( $args );
		?>
		<div class="related_post post">
			<h3 class="header text-left" style="text-align: left;">BÀI VIẾT LIÊN QUAN</h3>
			<div class="row">
				<?php foreach ($args['related_post'] as $key => $related): Template::partial('include/loop/item_post', ['val' => $related]); ?>
				<?php endforeach ?>
			</div>
		</div>
	<?php } ?>
</div>

<style type="text/css">
    .object-detail { max-width: 1000px; margin: 0 auto;}
	.btn-breadcrumb .btn-default {
	    border: 0;
	    padding: 0 5px;
	}
	.btn-breadcrumb span { float: left; }
	.btn-breadcrumb .btn{ border:0; border-radius:0;background-color:transparent; }

	.td-post-sharing-bottom {
		border: 1px solid #ededed;
		padding: 10px 26px;
		margin-bottom: 40px;
		margin-top: 40px;
	}
	.td-post-share-title {
		font-weight: 700;
		font-size: 14px;
		position: relative;
		margin-right: 20px;
		vertical-align: middle;
	}
	.td-default-sharing {
		display: inline-block;
		vertical-align: middle;
	}
	.td-social-sharing-buttons {
		font-size: 11px;
		color: #fff;
		margin-right: 10px;
		text-align: center;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        height: 32px; line-height: 32px;
        width: 32px;
        display: inline-block;
	}
    .td-social-sharing-buttons:hover {color: #fff;}
	.td-social-sharing-buttons img { height:30px!important;}

	[class*="td-icon-"] {
		line-height: 1;
		text-align: center;
		display: inline-block;
	}

	.td-social-facebook .td-icon-facebook {
		font-size: 14px;
		position: relative;
		top: 1px;
	}
	.td-social-zalo {
		padding-top:0!important;
	}

	.td-social-facebook {
		background-color: #516eab;
	}

	.td-social-twitter {
		background-color: #29c5f6;
	}
	.td-social-pinterest {
		background-color: #ca212a;
		margin-right: 0;
	}
</style>