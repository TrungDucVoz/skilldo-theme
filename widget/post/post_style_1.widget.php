<?php
class widget_post_style_1 extends widget {
    function __construct() {
        parent::__construct('widget_post_style_1', 'Bài viết (style 1)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['post'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'post_cate_id', 'label' =>'Danh mục item', 'type' => 'cate_post_categories'];
        $left[] = ['field' => 'display', 'type' => 'widget_post_style_1::inputDisplay','label' => 'Kiểu hiển thị'];
        $left[] = ['field' => 'per_row', 		'label' =>'Số item trên 1 hàng', 			'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 5]];
        $left[] = ['field' => 'per_row_tablet','label' =>'Số item trên 1 hàng - tablet', 	'type' => 'col', 'value' => 2, 'args' => ['min'=>1, 'max' => 5]];
        $left[] = ['field' => 'per_row_mobile','label' =>'Số item trên 1 hàng - mobile', 	'type' => 'col', 'value' => 1, 'args' => ['min'=>1, 'max' => 5]];
        $right[] = ['field' => 'limit', 'type' => 'number', 'value' => 10, 'label'=> 'Số Item lấy ra', 'note'=>'Để 0 để lấy tất cả',];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_post_style_1 post');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
        <div class="box-content" id="post_style_1_content_<?php echo $this->id;?>">
            <?php
                if($this->options->display['type'] == 0) $this->displayHorizontal($this->options->posts);
                if($this->options->display['type'] == 1) $this->displayList($this->options->posts);
            ?>
        </div>
        <?php
        echo $box['after'];
    }
    function displayHorizontal($posts) {
        ?>
        <div class="arrow_box">
            <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
            <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
        </div>
        <div class="owl-carousel list-post">
            <?php foreach ($posts as $key => $val) { $this->item($val); } ?>
        </div>
        <style>
            .widget_post_style_1 .item {
                margin: 20px;
            }
        </style>
        <script defer>
            $(function(){
                let config = {
                    infinite: true,
                    dots:false,
                    autoplay: true,
                    autoplaySpeed: <?= $this->options->display['time']*1000;?>,
                    speed: <?= $this->options->display['speed']*1000;?>,
                    slidesToShow: <?= $this->options->per_row;?>,
                    slidesToScroll: 1,
                    responsive: [
                        { breakpoint: 1000, settings: { slidesToShow: <?= $this->options->per_row_tablet;?>} },
                        { breakpoint: 600, settings: { slidesToShow: <?= $this->options->per_row_mobile;?>} }
                    ]
                };
                let postList     = $('#post_style_1_content_<?php echo $this->id;?> .list-post');
                let postBtnNext  = $('#post_style_1_content_<?php echo $this->id;?> .next');
                let postBtnPrev  = $('#post_style_1_content_<?php echo $this->id;?> .prev');
                postList.slick(config);
                postBtnNext.click(function() {postList.slick('slickNext');return false;});
                postBtnPrev.click(function() {postList.slick('slickPrev');return false;});
            });
        </script>
        <?php
    }
    function displayList($posts) {
        $this->options->per_row_mobile = ($this->options->per_row_mobile == 5) ? 15 :(12/$this->options->per_row_mobile);
        $this->options->per_row_tablet = ($this->options->per_row_tablet == 5) ? 15 :(12/$this->options->per_row_tablet);
        $this->options->per_row        = ($this->options->per_row == 5) ? 15 : (12/$this->options->per_row);
        ?>
        <div class="list-post row">
            <?php foreach ($posts as $key => $val): ?>
                <div class="col-xs-<?php echo $this->options->per_row_mobile;?> col-sm-<?php echo $this->options->per_row_tablet;?> col-md-<?php echo $this->options->per_row;?> col-lg-<?php echo $this->options->per_row;?>">
                    <?php echo $this->item($val);;?>
                </div>
            <?php endforeach ?>
        </div>
        <?php
    }
    function item($item) {
        ?>
        <div class="item">
            <div class="img" data-aos="fade-top" data-aos-duration="500">
                <a href="<?php echo Url::permalink($item->slug);?>" class="effect-hover-zoom">
                    <?php Template::img($item->image, $item->title);?>
                    <div class="date-box" data-aos="fade-right" data-aos-duration="600">
                        <span><?php echo date("d", strtotime($item->created));?></span>
                        <br> Tháng <?php echo date("m", strtotime($item->created));?>
                    </div>
                </a>
            </div>
            <div class="title" data-aos="fade-up" data-aos-duration="800">
                <p class="header"><a href="<?= Url::permalink($item->slug);?>"><?= $item->title;?></a></p>
                <div class="description"><?php echo Str::limit(Str::clear($item->excerpt), 100);?></div>
            </div>
        </div>
        <?php
    }
    function css() { include_once('assets/post-style-1.css'); }
    function default() {
        if($this->name == 'Bài viết (style 1)') $this->name = 'BLOG';
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(empty($this->options->display)) $this->options->display = [];
        if(!isset($this->options->display['type'])) $this->options->display['type'] = 0;
        if(!isset($this->options->display['margin'])) $this->options->display['margin'] = 15;
        if(!isset($this->options->display['time'])) $this->options->display['time'] = 3;
        if(!isset($this->options->display['speed'])) $this->options->display['speed'] = 0.7;

        if(!isset($this->options->per_row)) $this->options->per_row = 3;
        if(!isset($this->options->per_row_tablet)) $this->options->per_row_tablet = 2;
        if(!isset($this->options->per_row_mobile)) $this->options->per_row_mobile = 1;

        $args = [
            'post_type' => 'post',
            'where'  => [],
            'params' => ['orderby' => 'order, created desc', 'limit'   => (!empty($this->options->limit)) ? $this->options->limit : 50]
        ];
        $this->options->slug = '';
        if(!empty($this->options->post_cate_id)) {
            $args['where_category'] = PostCategory::get($this->options->post_cate_id);
            if(have_posts($args['where_category'])) {
                $this->options->slug = Url::permalink($args['where_category']->slug);
            }
        }
        $this->options->posts = Posts::gets($args);
    }
    static function inputDisplay($param, $value = []) {
        if(!is_array($value)) $value = [];
        if(!isset($value['type']))   $value['type']     = 0;
        if(!isset($value['margin'])) $value['margin']   = 15;
        if(!isset($value['time']))   $value['time']     = 3;
        if(!isset($value['speed']))  $value['speed']    = 0.7;
        $Form = new FormBuilder();
        ob_start();
        ?>
        <div class="row">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs">
                <li class="active" data-tab="#display_slider">
                    <label for="display_type_0">
                        <input class="display_type" id="display_type_0" type="radio" name="display[type]" value="0" <?php echo ($value['type'] == 0) ? 'checked' : '';?>> Sản phẩm chạy ngang
                    </label>
                </li>
                <li data-tab="#display_list">
                    <label for="display_type_1">
                        <input class="display_type" id="display_type_1" type="radio" name="display[type]" value="1" <?php echo ($value['type'] == 1) ? 'checked' : '';?>> Sản phẩm danh sách
                    </label>
                </li>
            </ul>
            <!-- TAB CONTENT -->
            <div class="tab-content">
                <div class="<?php echo ($value['type'] == 0) ? 'active in' : '';?> tab-pane fade" id="display_slider">
                    <?php $Form->add('display[margin]', 'number', ['label' => 'Khoảng cách giữa các sản phẩm', 'value' => 15], $value['margin']);?>
                    <?php $Form->add('display[time]', 'number', ['label' => 'Thời gian tự động chạy', 'value' => 3, 'step'=> '0.01'], $value['time']);?>
                    <?php $Form->add('display[speed]', 'number', ['label' => 'Thời gian hoàn thành chạy', 'value' => 0.7, 'step'=> '0.01'], $value['speed']);?>
                    <?php $Form->html(false);?>
                </div>
                <div class="<?php echo ($value['type'] == 1) ? 'active in' : '';?> tab-pane fade" id="display_list"></div>
            </div>
            <script defer>
                let tab = $('#widget_post_style_1 .tab-content .tab-pane');

                $('#widget_post_style_1 .nav-tabs li .display_type').click(function () {
                    let idTab = $(this).closest('li').attr('data-tab');
                    tab.removeClass('active');
                    tab.removeClass('in');
                    $(idTab).addClass('active');
                    $(idTab).addClass('in');
                });
            </script>
        </div>
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

Widget::add('widget_post_style_1');
