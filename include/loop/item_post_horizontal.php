<div class="item item-post-horizontal wow animated fadeIn">
	<div class="img">
		<a href="<?= Url::permalink($val->slug);?>"><?= Template::img($val->image, $val->title, ['lazy' => 'default']);?></a>
	</div>
	<div class="title">
        <div class="post-info">
            <?= date("d/m/Y", strtotime($val->created));?> | Đăng bởi admin
        </div>
        <h3 class="header"><a href="<?= Url::permalink($val->slug);?>"><?= $val->title;?></a></h3>
        <div class="description"><a href="<?= Url::permalink($val->slug);?>"><?= str_word_cut(Str::clear($val->excerpt), 30);?></a></div>
	</div>
</div>