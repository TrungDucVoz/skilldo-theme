<?php
class widget_slider_style_13 extends widget {
    function __construct() {
        parent::__construct('widget_slider_style_13', 'Slider 13',['container' => true, 'position' => 'right']);
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
            'out-slider' => 'Dưới slider', 'in-slider' => 'Trong slider'
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

        $right[] = [
            'field' => 'orderTxtColor', 'label' => 'Màu chữ mua hàng', 'type'  => 'color',
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $right[] = [
            'field' => 'orderTxtBg', 'label' => 'Màu nền mua hàng', 'type'  => 'color',
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $right[] = [
            'field' => 'orderNumber', 'label' => 'Số lượng hiển thị', 'type'  => 'number',
            'after' => '<div class="col-md-12 form-group group">', 'before'=> '</div>', 'value' => 5
        ];
        $left[] = ['field' => 'itemCustomer', 'type' => 'repeater', 'label' => 'Items', 'fields' => [
            ['name' => 'title', 'type' => 'text', 'label' => __('Tiêu đề')],
        ]];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_slider_style_13');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="slider-left col-md-3 col-sm-4 col-xs-12 hidden-xs">
                <?php $this->customerOrder();?>
            </div>
            <div class="slider-center col-md-9 col-sm-8 col-xs-12">
                <div class="slider-top slider_content <?php echo (!empty($this->options->sliderTxtType)) ? $this->options->sliderTxtType : 'in-slider';?>">
                    <?php if(have_posts($this->options->galleryList)) $this->slider(); ?>
                </div>
            </div>
        </div>
        <style>
            .js_widget_slider_style_13_<?php echo $this->id;?>.widget_slider_style_13 {
                --slider-thumb-color:<?php echo (!empty($this->options->sliderTxtColor)) ? $this->options->sliderTxtColor : '#fff';?>;
                --slider-thumb-color-active:<?php echo (!empty($this->options->sliderTxtActive)) ? $this->options->sliderTxtActive : 'var(--theme-color)';?>;
                --slider-thumb-bg:<?php echo (!empty($this->options->sliderTxtBg)) ? $this->options->sliderTxtBg : 'rgba(0,0,0,0.5)';?>;
                --slider-order-bg:<?php echo (!empty($this->options->orderTxtBg)) ? $this->options->orderTxtBg : 'var(--theme-color)';?>;
                --slider-order-color:<?php echo (!empty($this->options->orderTxtColor)) ? $this->options->orderTxtColor : '#fff';?>;
            }
        </style>
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
    function customerOrder() {
        ?>
        <div class="slider-customer-order">
            <div class="heading"><h3><?php echo $this->name;?></h3></div>
            <div class="customer-order--content">
                <?php foreach ($this->options->itemCustomer as $key => $val): ?>
                    <div class="item-order">
                        <div class="title">
                            <div class="text"><?= Str::limit(Str::clear($val['title']), 150); ?></div>
                            <div class="time"><span><?php echo date('d/m/Y');?></span></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.customer-order--content').slick({
                    infinite: true,
                    vertical: true,
                    arrows: false,
                    autoplay: true,
                    slidesToShow: <?php echo $this->options->orderNumber;?>,
                    slidesToScroll: 1,
                    speed: 1000,
                    autoplaySpeed: 2000,
                    pauseOnHover: 0,
                    dots: false,
                    focusOnSelect: true,
                    responsive: [
                        { breakpoint: 1000, settings: { slidesToShow: 3 }},
                    ]
                });
            });
        </script>
        <?php
    }
    function css() { include_once 'assets/slider-style-13.css'; }
    function default() {
        if(empty($this->name) || $this->name == 'Slider 13') $this->name = 'DANH SÁCH KHÁCH HÀNG VỪA ĐẶT HÀNG';
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 2;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
        if(!isset($this->options->orderNumber)) $this->options->orderNumber = 5;
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

        if(empty($this->options->itemCustomer)) {
            $this->options->itemCustomer    = [];
            $this->options->itemCustomer[0] = ['title' =>  'Anh Cao Tiến Đạt vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[1] = ['title' =>  'Anh Nguyễn Trung Hiếu vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[2] = ['title' =>  'Chị Đỗ Thị Mỹ Linh vừa đặt lịch tư vấn',];
            $this->options->itemCustomer[3] = ['title' =>  'Chị Nguyễn Thị Thanh Trúc vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[4] = ['title' =>  'Chị Trần Thị Hà Vy vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[5] = ['title' =>  'Anh Nguyên Thanh Long vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[6] = ['title' =>  'Chị Như Quỳnh vừa đặt hàng sản phẩm',];
        }
        else{
            foreach ($this->options->itemCustomer as $key => $value) {
                if(!isset($value['title'])) $value['title'] = '';
            }
        }
    }
}

Widget::add('widget_slider_style_13');