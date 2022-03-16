<?php
class widget_videos_style_4 extends widget {

    function __construct() {
        parent::__construct('widget_videos_style_4', 'Videos (Style 4)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['video', 'post'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {
        $right[] = ['field' => 'title2', 'label' =>'Tiêu đề phải', 'type' => 'text'];
        if(!class_exists('video_gallery')) {
            $left[] = ['field' => 'gallery', 'label' =>'Nguồn dữ liệu', 'type' => 'gallery'];
        }

        $left[] = ['field' => 'time', 'label' =>'Time tự động chạy feedback', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'speed', 'label' =>'Time hoàn thành chạy feedback', 'type' => 'number', 'value' => 3, 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];

        parent::form($left, $right);
    }

    function widget() {
        $main       =  $this->options->galleries[0];
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-6 post-box post-list">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
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
                                slidesToShow: 4,
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
            <div class="col-md-6">
                <?php ThemeWidget::heading($this->options->title2, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="box-content">
                    <div class="arrow_box" id="feedback_btn_<?= $this->id;?>">
                        <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                        <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                    </div>
                    <div id="feedback_list_<?= $this->id;?>" class="owl-carousel">
                        <?php foreach ($this->options->feeds as $key => $val) { $this->itemFeed($val); } ?>
                    </div>
                </div>
                <script defer>
                    $(function(){
                        let config = {
                            items 				:1,
                            margin				:30,
                            autoplayTimeout		:<?= ($this->options->speed+$this->options->time)*1000;?>,
                            autoplaySpeed 		:<?= $this->options->speed*1000;?>,
                            loop				:true, autoplay:true, autoplayHoverPause:true,
                            responsive 			:{ 0:{ items:1 },  500:{ items:1 },  1000:{ items:1 } }
                        };
                        let ol = $("#feedback_list_<?php echo $this->id;?>").owlCarousel(config);
                        $('#feedback_btn_<?php echo $this->id;?> '+'.next').click(function() {
                            ol.trigger('next.owl.carousel', [1000]);
                        });
                        $('#feedback_btn_<?php echo $this->id;?> '+' .prev').click(function() {
                            ol.trigger('prev.owl.carousel', [1000]);
                        });
                    });
                </script>
            </div>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        $box = $this->container_box('widget_videos_style_4', $this->options);
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
            </div>
        </div>
        <?php
    }

    function itemFeed($item) {
        ?>
        <div class="feedback-item">
            <div class="item">
                <div class="feedback-content"><?php echo Str::clear($item->excerpt);?></div>
                <div class="feedback-info text-center">
                    <div style="display: inline-block">
                        <div class="avatar" data-aos="fade-top" data-aos-duration="500">
                            <?php Template::img($item->image, $item->title);?>
                        </div>
                        <div class="title" data-aos="fade-up" data-aos-duration="800">
                            <p class="feedback-name"><?= $item->title;?></p>
                            <p class="feedback-office"><?= $item->content;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    function css() { include_once('assets/videos-style-4.css'); }

    function default() {
        if($this->name == 'Videos (Style 4)') $this->name = 'VIDEO';
        if(!isset($this->options->title2)) $this->options->title2 = 'Ý KIẾN KHÁCH HÀNG';
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->speed)) $this->options->speed = 3;
        if(!isset($this->options->time))  $this->options->time = 2;
        if(Plugin::isActive('customer-feedback')) {
            $args = [
                'post_type' => FEEDBACK_POST_TYPE,
                'where'     => ['public'  => 0],
                'params'    => ['orderby' => 'order, created desc', 'limit' => 20]
            ];
            $this->options->feeds = Posts::gets($args);
        }
        else {
            $this->options->feeds = [
                (object)[
                    'id'        => 1,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Hoàng Thùy Yến',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Nhân sự',
                ],
                (object)[
                    'id'        => 2,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Cao Yến Vy',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                ],
                (object)[
                    'id'        => 3,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'NGuyễn Văn Cường',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                ],
            ];
        }

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

Widget::add('widget_videos_style_4');
