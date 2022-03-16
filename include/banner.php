<?php
	$banner_setting  = get_theme_layout_setting('banner');

	$breadcrumb = Template::breadcrumb();

	$image_banner = Template::imgLink(option::get('banner_img'));

	$name = '';

	if(Template::isMethod('index')) {
		if(isset($category) && have_posts($category)) {
			$name = $category->name;
		}
        else if(isset($brand) && have_posts($brand)) {
            $name = $brand->name;
        }
        else if(is_page('products_index')) {
			$name = __('Sản phẩm');
		}
	}
	else {
		if(isset($object) && have_posts($object)) {
			$name = $object->title;
		}
	}
?>

<div class="box-bg-top box-bg-<?php echo $banner_setting['type'];?>">
	<div class="parallax box-bg-title" style="background:url(<?php echo $image_banner;?>);background-size: cover;">
		<div class="container title">
			<h1 class="header animated fadeInDown"><?= $name;?></h1>
			<div class="animated fadeInUp breadcrumb-box"><?php echo Breadcrumb($breadcrumb);?></div>
		</div>
	</div>
</div>

<style type="text/css">
	.box-bg-top {
		min-height: <?php echo $banner_setting['height'];?>px; position: relative; text-align: center;
		margin-bottom:10px;
        overflow: hidden;
	}
    .container>.box-bg-top>.container { width:100%;}
	.box-bg-top .box-bg-title {
	    background-color: rgba(0,0,0,0.5); text-align: center;
	    height: 130%; width: 100%;
	    position: absolute; left: 0; top: 0; color: #fff;
	}
    .box-bg-top .box-bg-title:after {
        content:'';
        background-color: rgba(0,0,0,0.5); text-align: center;
        height: 130%; width: 100%;
        position: absolute; left: 0; top: 0; color: #fff;

    }
	.box-bg-top .box-bg-title .title {
	    position: relative;  top: 30%; transform: translateY(-30%); z-index: 1;
	}
	.box-bg-top .box-bg-title .title h1.header { text-align: center; font-size: 40px; color:#fff; }
	.box-bg-top .btn-breadcrumb>.btn{ border:0; border-radius:0;background-color:transparent;color:#fff; }

    .box-bg-top.box-bg-left .box-bg-title .title h1.header,
    .box-bg-top.box-bg-left .box-bg-title .title .breadcrumb-box{
        text-align: left;
    }

    .box-bg-top.box-bg-right .box-bg-title .title h1.header,
    .box-bg-top.box-bg-right .box-bg-title .title .breadcrumb-box{
        text-align: right;
    }

	.warper { padding-top: 0px;}
</style>