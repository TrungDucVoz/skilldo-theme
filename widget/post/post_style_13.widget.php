<?php
class widget_post_style_13 extends widget {

    function __construct() {
        parent::__construct('widget_post_style_13', 'Bài viết (style 13)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['post', 'video'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {
        $left[] = ['field' => 'titleNew', 'label' =>'Tiêu đề tin tức', 'type' => 'text'];
        $left[] = ['field' => 'post_cate_id', 'label' =>'Danh mục item', 'type' => 'cate_post_categories'];
        $left[] = ['field' => 'postTextColor', 'label' =>'Màu chữ blog', 'type' => 'color'];
        $left[] = ['field' => 'postHeadingColor', 'label' =>'Màu chữ tiêu đề blog', 'type' => 'color'];
        $left[] = ['field' => 'postDesColor', 'label' =>'Màu chữ mô tả blog', 'type' => 'color'];
        $right[] = ['field' => 'video_img',  'label' =>'Ảnh đại diện video', 'type' => 'image'];
        $right[] = ['field' => 'video_url',  'label' =>'Liên kết youtube', 'type' => 'url'];
        parent::form($left, $right);
    }

    function widget() {
        $box = $this->container_box('widget_post_style_13 post');
        echo $box['before'];
        if(have_posts($this->options->posts)) { ?>
            <div class="row">
                <div class="col-md-6 video">
                    <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                    <div class="video-section-outer">
                        <div class="video-section">
                            <a href="<?php echo $this->options->video_url;?>" data-fancybox>
                                <?php Template::img($this->options->video_img);?>
                                <div class="mfp-video play-now">
                                    <i class="icon fa fa-play"></i>
                                    <span class="ripple"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 post-list">
                    <?php ThemeWidget::heading($this->options->titleNew, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                    <div class="post-list-items">
                        <?php foreach ($this->options->posts as $key => $val) { $this->item($val); } ?>
                    </div>
                </div>
            </div>
            <style>
                :root {
                    --post13-txt-color:<?php echo (!empty($this->options->postTextColor)) ? $this->options->postTextColor : '#000';?>;
                    --post13-heading-color:<?php echo (!empty($this->options->postHeadingColor)) ? $this->options->postHeadingColor : '#000';?>;
                    --post13-des-color:<?php echo (!empty($this->options->postDesColor)) ? $this->options->postDesColor : '#687385';?>;
                }
            </style>
            <script>
                $(function () {
                    let window_width = $(document).width();
                    if(window_width > 768) {
                        let widget_id = '<?php echo $this->id;?>';
                        let widget_height = $('.js_widget_post_style_13_'+widget_id+' .post-list-items').height();
                        $('.js_widget_post_style_13_'+widget_id+' .video-section img').css('height', widget_height+'px');
                    }
                });
            </script>
        <?php }
        echo $box['after'];
    }

    function item($item) {
        ?>
        <div class="item">
            <a href="<?= Url::permalink($item->slug);?>">
                <div class="img effect-hover-zoom" data-aos="fade-top" data-aos-duration="500">
                    <?php Template::img($item->image, $item->title);?>
                </div>
                <div class="title" data-aos="fade-up" data-aos-duration="800">
                    <p class="time"><i class="fad fa-calendar"></i> <?= date('d/m/Y', strtotime($item->created));?></p>
                    <p class="header"><?= $item->title;?></p>
                    <div class="description"><?php echo Str::limit(Str::clear($item->excerpt), 200);?></div>
                    <p><b>Xem thêm</b></p>
                </div>
            </a>
        </div>
        <?php
    }

    function css() { include_once('assets/post-style-13.css'); }

    function default() {
        if($this->name == 'Bài viết (style 13)') $this->name = 'VIDEO';
        if(!isset($this->options->titleNew))   $this->options->titleNew = 'BLOG';
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->video_img)) $this->options->video_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500';
        if(!isset($this->options->video_url)) $this->options->video_url = '';

        $args = [
            'post_type' => 'post',
            'where'  => [],
            'params' => ['orderby' => 'order, created desc', 'limit'   => 3]
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
}

Widget::add('widget_post_style_13');
