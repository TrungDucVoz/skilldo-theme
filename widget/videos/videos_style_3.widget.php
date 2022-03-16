<?php
class widget_videos_style_3 extends widget {

    function __construct() {
        parent::__construct('widget_videos_style_3', 'Videos (Style 3)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['video', 'post'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {
        $left[] = ['field' => 'post_cate_id', 'label' =>'Danh mục item', 'type' => 'cate_post_categories'];
        $right[] = ['field' => 'title2', 'label' =>'Tiêu đề phải', 'type' => 'text'];
        if(!class_exists('video_gallery')) {
            $left[] = ['field' => 'gallery', 'label' =>'Nguồn dữ liệu', 'type' => 'gallery'];
        }
        parent::form($left, $right);
    }

    function widget() {
        $main       =  $this->options->galleries[0];
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-6 post-box post-list">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="box-content">
                    <div id="widget_post_list_<?= $this->id;?>" class="owl-carousel">
                        <?php foreach ($this->options->posts as $key => $val) { $this->itemPost($val); } ?>
                    </div>
                </div>
                <script defer>
                    $(function(){
                        let config = {
                            infinite: true,
                            vertical: true,
                            verticalScrolling: true,
                            dots:false,
                            autoplay: true,
                            autoplaySpeed: 3000,
                            speed: 700,
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            responsive: [
                                { breakpoint: 1000, settings: { slidesToShow: 3 } },
                                { breakpoint: 600, settings: { slidesToShow: 3} }
                            ]
                        };
                        let id = <?= $this->id;?>;
                        let sliderList = $("#widget_post_list_"+id);
                        sliderList.slick(config);
                    });
                </script>
            </div>
            <div class="col-md-6">
                <div class="header-title"><h3 class="header"><?= $this->options->title2;?></h3></div>
                <?php ThemeWidget::heading($this->options->title2, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="main-videos">
                    <div class="video-section-outer" data-aos="fade-right" data-aos-duration="500">
                        <div class="video-img">
                            <a href="<?php echo $main->url;?>" data-fancybox>
                                <?php Template::img($main->image);?>
                                <div class="mfp-video play-now"><i class="icon fa fa-play"></i><span class="ripple"></span></div>
                            </a>
                        </div>
                        <div class="video-title">
                            <p class="heading"><a href="<?php echo $main->url;?>" data-fancybox><?php echo $main->title;?></a></p>
                        </div>
                    </div>
                </div>
                <div class="box-content list-videos" style="position: relative">
                    <div id="widget_videos_list_<?= $this->id;?>" class="owl-carousel">
                        <?php foreach ($this->options->galleries as $key => $val):
                            echo $this->item($val);
                        endforeach;?>
                    </div>
                    <script defer>
                        $(function(){
                            let config = {
                                infinite: true,
                                // vertical: true,
                                // verticalScrolling: true,
                                dots:false,
                                autoplay: true,
                                autoplaySpeed: 3000,
                                speed: 700,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                responsive: [
                                    { breakpoint: 1000, settings: { slidesToShow: 3 } },
                                    { breakpoint: 600, settings: { slidesToShow: 3} }
                                ]
                            };
                            let id = <?= $this->id;?>;
                            let sliderList = $("#widget_videos_list_"+id);
                            sliderList.slick(config);
                        });
                    </script>
                </div>
            </div>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        $box = $this->container_box('widget_videos_style_3', $this->options);
        echo $box['before'];
        echo $content;
        echo $box['after'];
    }

    function item($item) {
        ?>
        <div class="video-section-outer">
            <div class="video-img">
                <a href="<?php echo $item->url;?>" data-fancybox>
                    <?php Template::img($item->image);?>
                    <div class="mfp-video play-now"><i class="icon fa fa-play"></i><span class="ripple"></span></div>
                </a>
            </div>
            <div class="video-title">
                <p class="heading"><a href="<?php echo $item->url;?>" data-fancybox><?php echo $item->title;?></a></p>
                <?php if(!empty($item->excerpt)) {?>
                <!--  <div class="description">--><?php //echo Str::clear($item->excerpt);?><!--</div>-->
                <?php }?>
            </div>
        </div>
        <?php
    }

    function itemPost($item) {
        ?>
        <div class="item">
            <div class="img">
                <a href="<?php echo Url::permalink($item->slug);?>" class="effect-hover-zoom">
                    <?php Template::img($item->image, $item->title);?>
                    <div class="date-box" data-aos="fade-right" data-aos-duration="600">
                        <span><?php echo date("d", strtotime($item->created));?></span>
                        <br> Tháng <?php echo date("m", strtotime($item->created));?>
                    </div>
                </a>
            </div>
            <div class="title">
                <a href="<?= Url::permalink($item->slug);?>">
                    <p class="header"><?= $item->title;?></p>
                    <div class="description"><?php echo Str::limit(Str::clear($item->excerpt), 200);?></div>
                </a>
            </div>
        </div>
        <?php
    }

    function css() { include_once('assets/videos-style-3.css'); }

    function default() {
        if($this->name == 'Videos (Style 3)') $this->name = 'BLOG';
        if(!isset($this->options->title2)) $this->options->title2 = 'VIDEO';
        if(!isset($this->options->box))   $this->options->box = 'container';
        $args = [
            'post_type' => 'post',
            'where'     => [],
            'params'    => ['orderby' => 'order, created desc', 'limit'   => (!empty($this->options->limit)) ? $this->options->limit : 50]
        ];
        $this->options->slug = '';
        if(!empty($this->options->post_cate_id)) {
            $args['where_category'] = PostCategory::get($this->options->post_cate_id);
            if(have_posts($args['where_category'])) {
                $this->options->slug = Url::permalink($args['where_category']->slug);
            }
        }
        $this->options->posts = Posts::gets($args);

        if (!class_exists('video_gallery') && !isset($this->options->gallery)) {
            $galleries = [
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'SEO Services',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Web Design',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Social Engagement',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Content Marketing',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Collect Ideas',
                    'excerpt' => 'Nulla vitae elit libero pharetra augue dapibus. Vivamus sagittis lacus vel augue laoreet.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'organize our business projects',
                    'excerpt' => 'Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.'
                ],
            ];
        }
        else {
            if(empty($this->options->gallery)) {
                $galleries =  Posts::gets(['post_type' => 'video-gallery', 'params' => ['limit' => 20]]);
                foreach ($galleries as &$item) {
                    $item->url = Posts::getMeta($item->id, 'video_url', true);
                }
            }
            else {
                $galleries =  Gallery::getsItem((isset($this->options->gallery->gallery)) ? $this->options->gallery->gallery : []);
                foreach ($galleries as &$item) {
                    if ($item->type == 'youtube') {
                        $item->url      = $item->value;
                        $item->image    = Template::imgLink($item->value);
                    }
                    if ($item->type == 'image') {
                        $item->url      = Gallery::getItemMeta($item->id, 'url', true);
                        $item->image    = $item->value;
                    }
                    $item->title    = Gallery::getItemMeta($item->id, 'title', true);
                }
            }
        }

        $this->options->galleries = $galleries;
    }
}

Widget::add('widget_videos_style_3');
