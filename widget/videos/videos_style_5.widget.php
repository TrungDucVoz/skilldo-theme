<?php
class widget_videos_style_5 extends widget {

    function __construct() {
        parent::__construct('widget_videos_style_5', 'Videos (Style 5)', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['video', 'post'];
        $this->author = 'Ngọc Diệp';
    }

    function form( $left = [], $right = []) {
        if(!class_exists('video_gallery')) {
            $left[] = ['field' => 'gallery', 'label' =>'Nguồn dữ liệu', 'type' => 'gallery', 'note' => 'Lấy từ thư viện'];
        }
        parent::form($left, $right);
    }

    function widget() {
        ob_start();
        if(version_compare(get_instance()->data['template']->version, '2.7.1') < 0) {
            ?>
            <link rel="stylesheet" href="https://unpkg.com/swiper@8.0.7/swiper-bundle.min.css">
            <script src="https://unpkg.com/swiper@8.0.7/swiper-bundle.min.js"></script>
            <?php
        }
        ?>
        <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
        <div class="swiper-container" id="video-list-content-<?php echo $this->id;?>">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-wrapper">
                <?php
                if(have_posts($this->options->galleries)) {
                    foreach ($this->options->galleries as $key => $val):
                        echo $this->item($val);
                    endforeach;
                }
                ?>
            </div>
        </div>
        <style>
            .js_widget_videos_style_5_<?php echo $this->id;?>:before {
                position: absolute;
                content: '';
                width: 100%;
                height: 100%;
                background-color: <?php echo $this->options->bg_color ?>;
                top: 0; left: 0; opacity: 0.92;
            }
        </style>
        <script>
            $(function(){
                let swiper = new Swiper("#video-list-content-<?php echo $this->id ?>", {
                    effect: "coverflow",
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: "auto",
                    spaceBetween: 30,
                    coverflowEffect: {
                        rotate: 50,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: true,
                        scale:0.8
                    },
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        $box = $this->container_box('widget_videos_style_5', $this->options);
        echo $box['before'];
        echo $content;
        echo $box['after'];
    }

    function item($item) {
        ?>
        <div class="swiper-slide">
            <div class="video-section-outer">
                <div class="video-section">
                    <a href="<?php echo $item->url;?>" data-fancybox>
                        <?php Template::img($item->image);?>
                        <div class="mfp-video play-now">
                            <i class="icon fa fa-play"></i>
                            <span class="ripple"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }

    function css() { include_once('assets/videos-style-5.css'); }

    function default() {
        if($this->name == 'Videos (Style 5)') $this->name = 'VIDEO';
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(empty($this->options->widgetBackground['color'])) {
            $this->options->widgetBackground['color'] = '#171B31';
        }
        if(empty($this->options->box_size['padding'])) {
            $this->options->box_size['padding']['top'] = '100';
            $this->options->box_size['padding']['bottom'] = '100';
            $this->options->box_size['padding']['left'] = '0';
            $this->options->box_size['padding']['right'] = '0';
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
                if(have_posts($galleries)) {
                    foreach ($galleries as &$item) {
                        $item->url = Posts::getMeta($item->id, 'video_url', true);
                    }
                }
            }
            else {
                $galleries =  Gallery::getsItem((isset($this->options->gallery->gallery)) ? $this->options->gallery->gallery : []);
                if(have_posts($galleries)) {
                    foreach ($galleries as &$item) {
                        if ($item->type == 'youtube') {
                            $item->url = $item->value;
                            $item->image = Template::imgLink($item->value);
                        }
                        if ($item->type == 'image') {
                            $item->url = Gallery::getItemMeta($item->id, 'url', true);
                            $item->image = $item->value;
                        }
                        $item->title = Gallery::getItemMeta($item->id, 'title', true);
                    }
                }
            }
        }
        $this->options->galleries = $galleries;
    }
}

Widget::add('widget_videos_style_5');
