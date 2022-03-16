<?php
class widget_videos_style_2 extends widget {

    function __construct() {
        parent::__construct('widget_videos_style_2', 'Videos (Style 2)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['video'];
    }

    function form( $left = [], $right = []) {
        if(!class_exists('video_gallery')) {
            $left[] = ['field' => 'gallery', 'label' =>'Nguồn dữ liệu', 'type' => 'gallery'];
            $this->author = 'SKDSoftware Dev Team';
        }
        parent::form($left, $right);
    }

    function widget() {
        $main =  $this->options->galleries[0]; unset($this->options->galleries[0]);
        ob_start();
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
        <div class="row">
            <div class="col-md-6">
                <div class="main-videos">
                    <div class="video-item" data-aos="fade-right" data-aos-duration="500">
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
            </div>
            <div class="col-md-6">
                <div class="box-content list-videos" style="position: relative">
                    <div id="widget_videos_list_<?= $this->id;?>" class="owl-carousel">
                        <?php foreach ($this->options->galleries as $key => $val): echo $this->item($val); endforeach;?>
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
                                    { breakpoint: 600, settings: { slidesToShow: 3, vertical: false } }
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
        $box = $this->container_box('widget_videos_style_2');
        echo $box['before'];
        echo $content;
        echo $box['after'];
    }

    function item($item) {
        ?>
        <div class="video-item">
            <div class="video-img">
                <a href="<?php echo $item->url;?>" data-fancybox>
                    <?php Template::img($item->image);?>
                    <div class="mfp-video play-now"><i class="icon fa fa-play"></i><span class="ripple"></span></div>
                </a>
            </div>
            <div class="video-title">
                <p class="heading"><a href="<?php echo $item->url;?>" data-fancybox><?php echo $item->title;?></a></p>
                <?php if(!empty($item->excerpt)) {?>
                    <div class="description"><?php echo Str::clear($item->excerpt);?></div>
                <?php }?>
            </div>
        </div>
        <?php
    }

    function css() { include_once('assets/videos-style-2.css'); }

    function default() {
        if($this->name == 'Videos (Style 2)') $this->name = 'VIDEO';
        if(!isset($this->options->box))   $this->options->box = 'container';
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

Widget::add('widget_videos_style_2');
