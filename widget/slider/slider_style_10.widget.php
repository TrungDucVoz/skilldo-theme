<?php
class widget_slider_style_10 extends widget {
    function __construct() {
        parent::__construct('widget_slider_style_10', 'Slider 10', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', [$this, 'css'], 10);
        $this->tags = ['slider'];
        $this->author = 'SKDSoftware Dev Team';
        $this->heading = false;
    }
    function form( $left = [], $right = []) {
        $sliders = Gallery::gets(['where' => ['object_type' => 'slider']]);
        $options = [];
        foreach ($sliders as $key => $val) { $options[$val->id] = $val->name; }
        $left[] = ['field' => 'gallery', 'label' =>'Nguồn slider', 'type' => 'select', 'options' => $options];
        $left[] = [
            'field' => 'ratio_width', 'label' => 'Tỉ lệ hiển thị rộng (width)', 'type'  => 'number', 'value' => 3, 'step'  => 0.1,
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'ratio_height', 'label' => 'Tỉ lệ hiển thị cao (Height)', 'type'  => 'number', 'value' => 1, 'step'  => 0.1,
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $left[] = ['field' => 'item', 'type' => 'widget_slider_style_10::inputItem', 'arg' => ['number' => 1]];
        $right[] = ['field' => 'post_cate_id', 'label' =>'Danh mục bài viết', 'type' => 'cate_post_categories'];
        $right[] = ['field' => 'post_show', 'label' =>'Hiển thị', 'type' => 'number', 'value' => 1];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_slider_style_10');
        echo $box['before']; ?>
        <div class="row-flex-center">
            <div class="slider_content">
                <?php $this->slider(); ?>
            </div>
            <div class="slider_right">
                <div class="slider_post">
                    <div class="slider_post__title"><p class="heading"><?php echo $this->name;?></p></div>
                    <div class="slider_post__list" id="slider_post__list_<?php echo $this->id;?>">
                        <?php foreach ($this->options->posts as $post) { ?>
                        <div class="item-post">
                            <div class="img">
                                <a href="<?php echo Url::permalink($post->slug);?>"><?php Template::img($post->image, $post->title);?></a>
                            </div>
                            <div class="title">
                                <p class="heading"><a href="<?php echo Url::permalink($post->slug);?>"><?php echo $post->title;?></a></p>
                                <div class="date-box">
                                    <p class="day"><i class="fal fa-calendar-alt"></i> <?php echo date("d/m/Y", strtotime($post->created));?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="slider_banner">
                    <?php foreach ($this->options->item as $key => $item) { $this->banner($item, $key); } ?>
                </div>
            </div>
        </div>
        <script defer>
            $(function () {
                $('#slider_post__list_<?php echo $this->id;?>').slick({
                    infinite: true,
                    vertical: true,
                    arrows: false,
                    autoplay: true,
                    slidesToShow: <?php echo $this->options->post_show;?>,
                    slidesToScroll: 1,
                    speed: 1000,
                    autoplaySpeed: 2000,
                    pauseOnHover: 0,
                    dots: false,
                    focusOnSelect: true,
                });

                let wwidth = $(window).width();

                if(wwidth > 768) {
                    let sheight = $('.slider_content').height();
                    let pheight = $('.slider_post').height();
                    sheight = (sheight - pheight - 25) / <?php echo count($this->options->item);?>;
                    $('.slider_right .banner').css('height', sheight + 'px');
                }
                else if(wwidth > 600) {
                    let pheight = $('.slider_post').height();
                    pheight = pheight / <?php echo count($this->options->item);?>;
                    $('.slider_right .banner').css('height', pheight + 'px');
                }
            })
        </script>
        <?php
        echo $box['after'];
    }
    function slider() {
        ?>
        <div class="box-content widget_slider_owlcarousel" style="position: relative">
            <div class="arrow_box" id="slider_btn_<?= $this->id; ?>">
                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
            </div>
            <div id="slider_list_<?= $this->id; ?>" class="slider_list_item owl-carousel">
                <?php if(have_posts($this->options->galleryList)) { foreach ($this->options->galleryList as $key => $val) { $this->item($val); }} ?>
            </div>
            <div id="slider_list_thumb_<?= $this->id; ?>" class="slider_list_thumb owl-carousel">
                <?php if(have_posts($this->options->galleryList)) { foreach ($this->options->galleryList as $key => $val) { $this->thumb($val); }} ?>
            </div>
        </div>
        <script defer>
            $(document).ready(function() {
                let swidth = $('.widget_slider_owlcarousel').width();
                let sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                $('.widget_slider_owlcarousel .slider_list_item .item').css('height',sheight+'px');
                $(window).resize(function () {
                    swidth = $('.widget_slider_owlcarousel').width();
                    sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                    $('.widget_slider_owlcarousel .slider_list_item .item').css('height',sheight+'px');
                });

                let sync1 = $("#slider_list_<?php echo $this->id;?>");

                let sync2 = $("#slider_list_thumb_<?php echo $this->id;?>");

                sync1.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    autoplay: true,
                    asNavFor: "#slider_list_thumb_<?php echo $this->id;?>"
                });

                $('#slider_btn_<?php echo $this->id;?> '+'.next').click(function() {
                    sync1.slick('slickNext'); return false;
                });
                $('#slider_btn_<?php echo $this->id;?> '+' .prev').click(function() {
                    sync1.slick('slickPrev'); return false;
                });

                sync2.slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: "#slider_list_<?php echo $this->id;?>",
                    focusOnSelect: true,
                    loop:true,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                            }
                        }
                    ]
                });
            });
        </script>
        <style>
            .widget_slider_style_2 .slider_list_item .item {
                height: calc(100%*<?php echo $this->options->ratio_height / $this->options->ratio_width; ?>);
            }
        </style>
        <?php
    }
    function item($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item">
            <a aria-label='slide' href="<?php echo $item->url;?>">
                <?php get_img($item->value, $item->name, array('style' => 'cursor:pointer'));?>
            </a>
        </div>
        <?php
    }
    function thumb($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item">
            <p class="heading"><?php echo $item->name;?></p>
        </div>
        <?php
    }
    function banner($item, $key) {
        ?>
        <div class="banner banner<?php echo $key;?> effect-hover-guong effect-hover-zoom" data-aos-duration="1000">
            <a href="<?php echo Url::permalink($item['url']);?>">
                <?php Template::img($item['image'], $item['title']);?>
            </a>
        </div>
        <?php
    }
    function css() {
        include_once 'assets/slider-style-10.css';
    }
    function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->post_cate_id)) $this->options->post_cate_id = 0;
        if(!isset($this->options->post_show)) $this->options->post_show = 1;
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 2;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
        if(!isset($this->options->gallery)) {
            $this->options->galleryList    = [];
            $this->options->galleryList[0] = (object)[
                'id' => 1,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Slider là một thành tố điều khiển đồ họa',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[1] = (object)[
                'id' => 2,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Người dùng có thể cài đặt giá trị',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[2] = (object)[
                'id' => 3,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Bằng cách di chuyển một vật chỉ thị',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[3] = (object)[
                'id' => 4,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Người dùng cũng có thể nhấp vào một điểm trên slider để thay đổi cài đặt',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[4] = (object)[
                'id' => 5,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'The basic slider is horizontal and has a single handle',
                'url'           =>  'https://sikido.vn',
            ];
        }
        else {
            $this->options->galleryList = Gallery::getsItem($this->options->gallery);
        }
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/400x200',
                'title'         =>  'bằng cách di chuyển một vật chỉ thị',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[1] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/400x200',
                'title'         =>  'bằng cách di chuyển một vật chỉ thị',
                'url'           =>  'https://sikido.vn',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['url'])) $value['url'] = '';
            }
        }

        $args = [
            'post_type' => 'post',
            'params' => ['orderby' => 'order, created desc', 'limit'   => 20]
        ];
        if(!empty($this->options->post_cate_id)) {
            $category = PostCategory::get($this->options->post_cate_id);
            if(have_posts($category)) {
                $args['where_category'] = $category;
            }
        }
        $this->options->posts = Posts::gets($args);
    }
    static function inputItem($param, $value = []) {
        if(!have_posts($value)) $value = [];
        $value_default = array( 'image' => '', 'title' => '', 'url' => '', 'animate' => '');
        //Số Lượng item
        $number = (isset($param->arg['number'])) ? (int)$param->arg['number'] : 1;
        $output = '';
        $Form = new FormBuilder();
        for ( $i = 0; $i <= $number; $i++ ) {
            if(!isset($value[$i]) || !is_array($value[$i])) $value[$i] = [];
            $value[$i] = array_merge($value_default, $value[$i]);
            $output .= '<label for="name" class="control-label">Item '.($i+1).'</label>';
            $output .= '<div class="stote_wg_item">';
            $Form->add($param->field.'['.$i.'][image]', 'image', [ 'label' => 'Hình ảnh',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['image']);
            $Form->add($param->field.'['.$i.'][title]', 'text', [ 'label' => 'Tiêu đề',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['title']);
            $Form->add($param->field.'['.$i.'][url]', 'text', ['label' => 'Liên kết',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['url']);
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}

Widget::add('widget_slider_style_10');