<?php
class widget_slider_style_14 extends widget {
    function __construct() {
        parent::__construct('widget_slider_style_14', 'Slider 14',['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', [$this, 'css'], 10);
        $this->tags = ['slider'];
        $this->author = 'SKDSoftware Dev Team';
        $this->heading = false;
    }
    function form($left = [], $right = []) {

        $options = [];
        $sliders = Gallery::gets(['where' => ['object_type' => 'slider']]);
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
        $left[] = ['field' => 'sliderTxtType', 'type' => 'select', 'label' => 'Kiểu tiêu đề slider', 'options' => [
            'out-slider' => 'Dưới slider', 'in-slider' => 'Trong slider', 'thumb-hidden' => 'Tắt tiêu đề'
        ], 'value' => 'in-slider'];
        $left[] = [
            'field' => 'sliderTxtBg', 'label' => 'Màu nền thumb', 'type'  => 'color',
            'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'sliderTxtColor', 'label' => 'Màu chữ thumb', 'type'  => 'color',
            'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'sliderTxtActive', 'label' => 'Màu chữ thumb (active)', 'type'  => 'color',
            'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'
        ];

        $left[] = ['field' => 'item', 'type' => 'widget_slider_style_14::inputBanner', 'arg' => ['number' => 3]];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_slider_style_14');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="slider-center col-md-8 col-sm-8 col-xs-12">
                <div class="slider-top slider_content <?php echo (!empty($this->options->sliderTxtType)) ? $this->options->sliderTxtType : 'in-slider';?>">
                    <?php if(have_posts($this->options->galleryList)) $this->slider(); ?>
                </div>
            </div>
            <div class="slider-banner col-md-4 col-sm-4 col-xs-12">
                <?php foreach ($this->options->item as $key => $item) { $this->banner($item, $key); } ?>
            </div>
        </div>
        <style>
            .js_widget_slider_style_14_<?php echo $this->id;?> {
                --slider-thumb-color:<?php echo (!empty($this->options->sliderTxtColor)) ? $this->options->sliderTxtColor : '#fff';?>;
                --slider-thumb-color-active:<?php echo (!empty($this->options->sliderTxtActive)) ? $this->options->sliderTxtActive : 'var(--theme-color)';?>;
                --slider-thumb-bg:<?php echo (!empty($this->options->sliderTxtBg)) ? $this->options->sliderTxtBg : 'rgba(0,0,0,0.5)';?>;
            }
        </style>
        <script defer>
            $(function () {
                let wwidth = $(window).width();
                if(wwidth > 768) {
                    let sheight = $('.slider_content').height();
                    sheight = sheight / 2 - 6;
                    $('.slider-banner .banner').css('height', sheight + 'px');
                }
            })
        </script>
        <?php
        echo $box['after'];
    }
    function slider() {
        ?>
        <div class="box-content slider_box" style="position: relative">
            <div class="arrow_box" id="slider_btn_<?= $this->id; ?>">
                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
            </div>
            <div id="slider_list_<?= $this->id; ?>" class="slider_list_item owl-carousel">
                <?php foreach ($this->options->galleryList as $key => $val) { $this->item($val); } ?>
            </div>
            <div id="slider_list_thumb_<?= $this->id; ?>" class="slider_list_thumb owl-carousel">
                <?php foreach ($this->options->galleryList as $key => $val) { $this->thumb($val); } ?>
            </div>
        </div>
        <script defer>
            $(document).ready(function() {
                let swidth = $('.slider_box').width();
                let sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                $('.slider_box .slider_list_item .item').css('height',sheight+'px');
                $(window).resize(function () {
                    swidth = $('.slider_box').width();
                    sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                    $('.slider_box .slider_list_item .item').css('height',sheight+'px');
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
        <?php
    }
    function item($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item"><a aria-label='slide' href="<?php echo $item->url;?>"><?php Template::img($item->value, $item->name, array('style' => 'cursor:pointer'));?></a></div>
        <?php
    }
    function thumb($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item"><p class="heading"><?php echo $item->name;?></p></div>
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
    function css() { include_once 'assets/slider-style-14.css'; }
    function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 2;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
        if(!isset($this->options->gallery)) {
            $this->options->galleryList    = [];
            $this->options->galleryList[0] = (object)[
                'id' => 1,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Slider là một thành tố điều khiển đồ họa',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[1] = (object)[
                'id' => 2,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Người dùng có thể cài đặt giá trị',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[2] = (object)[
                'id' => 3,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Bằng cách di chuyển một vật chỉ thị',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[3] = (object)[
                'id' => 4,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Người dùng cũng có thể nhấp vào một điểm trên slider để thay đổi cài đặt',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[4] = (object)[
                'id' => 5,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'The basic slider is horizontal and has a single handle',
                'url'          =>  'https://sikido.vn',
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
            $this->options->item[2] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/400x200',
                'title'         =>  'bằng cách di chuyển một vật chỉ thị',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[3] = [
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

    }
    static function inputBanner($param, $value = []) {
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

Widget::add('widget_slider_style_14');